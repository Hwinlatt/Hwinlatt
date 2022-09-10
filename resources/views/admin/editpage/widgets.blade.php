@extends('layouts.adminmain')
@section('content')
    <div class="row">
        <div style="position: -webkit-sticky;top:300px;"> <h4 class="text-center mb-5">Edit Page</h4></div>
        <div class="col-md-12">

            <h5 class="">PageEdit / Main Slide Shows </h5>
            <div class="row">
                <div class="text-end"><a href="{{ url('admin/editPage/add_widget_page?type=slideShow') }}"
                        class="btn-link fs-6">Add <i class="fa-solid fa-arrow-right m-0"></i></a></div>
            </div>
            <div class="row d-flex justify-content-center">
                @foreach ($slideShows as $slideShow)
                    <div class="col-md-5 m-2">
                        <div class="row position-relative d-flex justify-content-center align-items-center w-100 h-100"
                            style="background: #181B23">
                            <input type="text" value="{{ $slideShow->id }}" class="d-none">
                            <a title="remove widget"
                                class="cross-close-circle bg-danger end-0 top-0 text-light removeWidget">
                                <div><i class="fa-solid fa-xmark m-0"></i></div>
                            </a>
                            <a href="{{url('admin/editPage/edit_widget_page/'.$slideShow->id.'?name='.$slideShow->header)}}"  title="edit widget"
                                class="cross-close-circle bg-primary end-0 bottom-0 text-light">
                                <div><i class="fa-solid fa-pen-to-square"></i></div>
                            </a>
                            <div class="col-md-6 p-0 m-0">
                                <div class="card text-center">
                                    <h5 class="card-header fs-5">{{ $slideShow->header }}</h5>
                                    <div class="card-body p-1">
                                        {{-- <p class="card-text shideShowPreText">{{ Str::limit($slideShow->text, 10, '...') }}</p> --}}
                                        <div class="collapse" id="more{{ $slideShow->id }}">
                                            <div class=" card-text">
                                                <p>{{ $slideShow->text }}</p>
                                            </div>
                                        </div>
                                        <button class="btn btn-link shideShowMoreText" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#more{{ $slideShow->id }}"
                                            aria-expanded="false" aria-controls="collapseExample">
                                            More <i class="fa-solid fa-arrow-down-long"></i>
                                        </button>
                                        <a href="{{ $slideShow->link }}" class="btn btn-outline-secondary d-block">Goto</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-0 ">

                                <a href="{{ asset('storage/homePage/' . $slideShow->image) }}"><img class="w-100 h-100"
                                        src="{{ asset('storage/homePage/' . $slideShow->image) }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <h6>PageEdit/Cards/</h6>
            <div class="text-end"><a href="{{ url('admin/editPage/add_widget_page?type=card') }}"
                    class="btn-link fs-6">Add <i class="fa-solid fa-arrow-right m-0"></i></a></div>
        </div>
        <div class="row d-flex justify-content-center">
            @foreach ($cards as $card)
                <div class="col-md-5 m-2">
                    <div class="row position-relative d-flex justify-content-center align-items-center w-100 h-100"
                        style="background: #181B23">
                        <input type="text" value="{{ $card->id }}" class="d-none">
                        <a title="remove widget" class="cross-close-circle bg-danger end-0 top-0 text-light removeWidget">
                            <div><i class="fa-solid fa-xmark m-0"></i></div>
                        </a>
                        <a href="{{url('admin/editPage/edit_widget_page/'.$card->id.'?name='.$card->header)}}" title="edit widget"
                            class="cross-close-circle bg-primary end-0 bottom-0 text-light">
                            <div><i class="fa-solid fa-pen-to-square"></i></div>
                        </a>
                        <div class="col-md-6 p-0 m-0 ">
                            <div class="card text-center">
                                <h5 class="card-header fs-5">{{ $card->header }}</h5>
                                <div class="card-body p-1">
                                    {{-- <p class="card-text shideShowPreText">{{ Str::limit($card->text, 10, '...') }}</p> --}}
                                    <div class="collapse" id="more{{ $card->id }}">
                                        <div class=" card-text">
                                            <p>{{ $card->text }}</p>
                                        </div>
                                    </div>
                                    <button class="btn btn-link shideShowMoreText" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#more{{ $card->id }}" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        More <i class="fa-solid fa-arrow-down-long"></i>
                                    </button>
                                    <a href="{{ $card->link }}" class="btn btn-outline-secondary d-block">Goto</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-0 ">

                            <a href="{{ asset('storage/homePage/' . $card->image) }}"><img class="w-100 h-100"
                                    src="{{ asset('storage/homePage/' . $card->image) }}" alt=""></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.editPage').addClass('active');
        });
        $('.shideShowMoreText').click(function() {
            $(this).parent().find('.shideShowPreText').toggle();
        });
        $('.removeWidget').click(function(e) {
            e.preventDefault();
            if (confirm("Are you sure to remove this widget?")) {
                let widget = $(this).parent();
                let id = $(this).parent().find('input').val();
                let _token = '{{ csrf_token() }}';
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin#remove_widget_page') }}",
                    data: {
                        id,
                        _token
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            alertBox(response.success, 'success')
                            widget.parent().remove();
                        }
                    }
                });
            }

        });
    </script>
@endpush
