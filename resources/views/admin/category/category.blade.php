@extends('layouts.adminmain')
@section('content')
    @if (session('status'))
        <div class="row alertContainer">
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
                <span class="alertCount float-end badge badge-primary rounded rounded-circle">10</span>
            </div>
        </div>
    @endif

    <div class="row">
        <form class="d-flex col-md-6" method="POST" action="{{ route('admin#category') }}">
            @csrf
            <input type="text" name="inputSearchCategory"
                value="@if (isset($key)) {{ $key }} @endif"
                class="form-control me-2 rounded text-light" placeholder="Search Category">
            <button class="btn btn-outline-primary">Search</button>
        </form>
        <div class="col-md-6 ">
            {{-- <a class="btn btn-primary" href="{{route('admin#add_category')}}">Add</a> --}}
        </div>
        <div class="row">
            <div class="table-responsive">
                <h4 class="pt-3 text-center">Categories @if (isset($key))
                        of {{ $key }}
                    @endif
                </h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Available</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr categoryId={{ $category->id }}>
                                <td class="text-white catName">{{ $category->name }}</td>
                                <td class="text-white">{{ $category->type }}</td>
                                <td class="text-white">{{ $category->price }} MMK</td>
                                <td class="text-white">{{ $category->qty }}</td>
                                <td class="text-white">
                                    @if ($category->available == '1')
                                        <small><span class="badge bg-success">Yes</span></small>
                                    @else
                                        <h6><span class="badge bg-danger">No</span></h6>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/category/edit/' . $category->id) }}"
                                        class="btn btn-outline-primary">Edit</a>
                                    <button class="btn btn-outline-danger delCategory">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>{{ $categories->links('vendor.pagination.bootstrap-5') }}</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
           $('.category').addClass('active');
            if ($('.alertContailer')) {
                let alertTimer = setInterval(() => {
                    $('.alertCount').html(parseInt($('.alertCount').html() - 1));
                    if ($('.alertCount').html() == '0') {
                        $('.alertCount').html('10')
                        $('.alertContainer').hide();
                        clearInterval(alertTimer);
                    }
                }, 1000);
            }
        });
        $('.delCategory').click(function(e) {
            e.preventDefault();
            if (confirm("Are you sure to delete" + $(this).closest('tr').find('.catName').html())) {
                $(this).closest('tr').remove();
                let delId = $(this).closest('tr').attr('categoryId');
                let _token = '{{ csrf_token() }}';
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin#del_category') }}",
                    data: {
                        delId,
                        _token
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            alertBox(response.success, 'success');
                        }
                    }
                });
            }

        });
    </script>
@endpush
