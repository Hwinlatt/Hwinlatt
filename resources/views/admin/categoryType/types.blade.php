@extends('layouts.adminmain')
@section('content')
    <div class="row d-flex justify-content-center">
        @if (isset($type))
            <form action="{{ url('admin/cat_types/edit/' . $type->id) }}" method="POST" enctype="multipart/form-data"
                class="col-md-5 border p-2">
                <h5 class="text-center">Update Form</h5>
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1">Name of type</label>
                    <input type="text" value="{{ old('name', $type->type_name) }}" name="name"
                        class="form-control text-light" placeholder="Enter Type">
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Update Image</label>
                    <input type="file" class="form-control text-light" name="image" id="">
                </div>
                @if (session('success'))
                    >> <code class="text-success">{{ session('success') }}</code>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        >> <code>{{ $error }}</code><br>
                    @endforeach
                @endif
                <div class="text-end">
                    <a href="{{route('admin#cat_types')}}" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit"
                        onclick="return confirm('The all Categories with this type will change to upadate type!')"
                        class="btn btn-outline-primary">Update</button></div>
            </form>
        @else
            <form action="{{ route('admin#add_cat_types') }}" method="POST" enctype="multipart/form-data"
                class="col-md-5 border p-2">
                <h5 class="text-center">Add Form</h5>
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1">Name of type</label>
                    <input type="text" value="{{ old('name') }}" name="name" class="form-control text-light"
                        placeholder="Enter Type">
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Image</label>
                    <input type="file" class="form-control text-light" name="image" id="">
                </div>
                @if (session('success'))
                    >> <code class="text-success">{{ session('success') }}</code>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        >> <code>{{ $error }}</code><br>
                    @endforeach
                @endif
                <div class="text-end"><button type="submit" class="btn btn-outline-primary">Submit</button></div>
            </form>
        @endif
        <div class="card-body">
            <h4 class="card-title">Category Type Table</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image </th>
                            <th> Name </th>
                            <th> created_at </th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody class="text-light">
                        @foreach ($cat_types as $cat_type)
                            <tr>
                                <td class="py-1">
                                    <a href="{{ asset('storage/categoryType/' . $cat_type->image) }}"><img
                                            src="{{ asset('storage/categoryType/' . $cat_type->image) }}"
                                            alt="image"></a>
                                </td>
                                <td>{{ $cat_type->type_name }} </td>
                                <td>{{ $cat_type->created_at->format('d-m-Y | h:i:s A') }}</td>
                                <td><a href="{{ url('admin/cat_types/edit/' . $cat_type->id) }}" class="fs-4"><i
                                            class="mdi mdi-pencil"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.catTypes').addClass('active');
        });
    </script>
@endpush
