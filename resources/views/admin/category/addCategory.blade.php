@extends('layouts.adminmain')
@section('content')
    <div class="card-body">
        <h4 class="card-title text-center">Add Category Form</h4>
        <form class="forms-sample" action="{{ route('admin#insert_category') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" autocomplete="none" value="{{ old('name') }}"
                        class="form-control  text-light @error('name') is-invalid @enderror" name="name" id="name"
                        placeholder="Enter Category Name">
                    @error('name')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="company">Company</label>
                    <input type="text" autocomplete="none" value="{{ old('company') }}"
                        class="form-control text-light @error('company') is-invalid @enderror" name="company" id="company"
                        placeholder="Company">
                    @error('company')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="number" value="{{ old('price') }}"
                        class="form-control text-light @error('price') is-invalid @enderror" name="price" id="price"
                        placeholder="0000MMK">
                    @error('price')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="type">Type</label>
                    <select class="form-control text-light @error('type') is-invalid @enderror" name="type"
                        id="type">

                        @foreach ($category_types as $type)
                            <option @if ($type->type_name == old('type')) selected @endif value="{{ $type->type_name }}">
                                {{ ucfirst($type->type_name) }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label" for="customFile">Image</label>
                    <input type="file" class="form-control text-light @error('image') is-invalid @enderror"
                        name="image" id="customFile" />
                    @error('image')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="color">Colors</label>
                    <input type="text" class="form-control inputColor  text-light @error('color') is-invalid @enderror"
                        name="color" id="color" placeholder="red , green , blue">
                    @error('color')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="color">Choosed Colors</label>
                    <div class="chooseColors">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="qty">Qty</label>
                    <input id="qty" name="qty" type="text"
                        class="form-control text-light @error('qty') is-invalid @enderror"
                        placeholder="Quantity of Category" value="{{ old('qty') }}">
                    @error('qty')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <div class="form-check mb-4">
                        <input class="form-check-input me-2" type="checkbox" name="populer" id="populer" />
                        <label class="form-check-label" for="populer">
                            Populer
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check mb-4">
                        <input class="form-check-input me-2" type="checkbox" name="available" id="available" checked />
                        <label class="form-check-label" for="available">
                            Available
                        </label>
                    </div>
                </div>
                <div class="col-md-12 h-100">
                    <label for="description">Description</label>
                    <small class=" opacity-75 ms-5">use | for enter text . user <> for header</small>
                    <textarea class=" w-100 text-light" style="background: #2A3038" name="description" id="description" rows="10">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="tags">Tags</label>
                    <input id="tags" name="tags" type="text"
                        class="form-control text-light @error('tags') is-invalid @enderror"
                        placeholder="Enter name of promotin tags name by using  ' ,(coma) ' " value="{{ old('tags') }}">
                    @error('tags')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="mt-4">
                    <div class="float-end">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{route('admin#category')}}" class="btn btn-dark">Cancel</a>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.category').addClass('active');
        });
        $('.inputColor').keyup(function(e) {
            $('.chooseColors').html('')
            let colors = $(this).val().split(',');
            if ($(this).val().length == '0') {
                return;
            }
            console.log();
            let squareColors = ''
            for (let i = 0; i < colors.length; i++) {
                squareColors += `<i class="fa-solid fs-2 fa-square" style="color:${colors[i]}"></i>`
            }
            $('.chooseColors').html(squareColors);
        });
    </script>
@endpush
