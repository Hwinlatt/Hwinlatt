@extends('layouts.adminmain');
@section('content')
    <div class="card-body">
        <h4 class="card-title text-center">Update Category Form</h4>
        <form class="forms-sample" action="{{ url('admin/category/edit/' . $category->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="row mt-2 mb-3">
                    <div class="col-md-4 p-0 position-relative">
                        <img class="catgoryImg editImg rounded w-100"
                            src="{{ asset('storage/category/' . $category->image) }}" alt="">
                        <label for="imagecategory" class="btn btn-primary position-absolute end-0 bottom-0"><i
                                class="fa-solid fa-pen-to-square"></i> Edit</label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" autocomplete="none" value="{{ old('name', $category->name) }}"
                        class="form-control  text-light @error('name') is-invalid @enderror" name="name" id="name"
                        placeholder="Enter Category Name">
                    @error('name')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="company">Company</label>
                    <input type="text" autocomplete="none" value="{{ old('company', $category->company) }}"
                        class="form-control text-light @error('company') is-invalid @enderror" name="company" id="company"
                        placeholder="Company">
                    @error('company')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="number" value="{{ old('price', $category->price) }}"
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
                        @foreach ($category->category_types() as $type)
                            <option @if ($type->type_name == old('type', $category->type)) selected @endif value="{{ $type->type_name }}">
                                {{ ucfirst($type->type_name) }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label updateImg" for="imagecategory">Update Image</label>
                    <input type="file" class="form-control    text-light @error('image') is-invalid @enderror"
                        name="image" id="imagecategory" />
                    @error('image')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label" for="color">Colors</label>
                    <input type="text" class="form-control inputColor  text-light @error('color') is-invalid @enderror"
                        name="color" value="{{ old('color', $category->colors) }}" id="color"
                        placeholder="red , green , blue">
                    @error('color')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label" for="color">Choosed Colors</label>
                    <div class="chooseColors">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="qty">Qty</label>
                    <input id="qty" name="qty" type="text"
                        class="form-control text-light @error('color') is-invalid @enderror"
                        placeholder="Quantity of Category" value="{{ old('color', $category->qty) }}">
                    @error('qty')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <div class="form-check mb-4">
                        <input class="form-check-input me-2" @if ($category->populer == '1') checked @endif
                            type="checkbox" name="populer" id="populer" />
                        <label class="form-check-label" for="populer">
                            Populer
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check mb-4">
                        <input class="form-check-input me-2" @if ($category->available == '1') checked @endif
                            type="checkbox" name="available" id="available"  />
                        <label class="form-check-label" for="available">
                            Available
                        </label>
                    </div>
                </div>
                <div class="col-md-12 h-100">
                    <label for="description">Description</label>
                    <small class=" opacity-75 ms-5">use | for enter text . user <> for header</small>
                    <textarea class=" w-100 text-light" style="background: #2A3038" name="description" id="description" rows="10">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="tags">Tags</label>
                    <input id="tags" name="tags" type="text"
                        class="form-control text-light @error('tags') is-invalid @enderror"
                        placeholder="Enter name of promotin tags name by using  ' ,(coma) ' " value="{{ old('tags', $category->tags) }}">
                    @error('tags')
                        <small class="text-danger"><span>{{ $message }}</span></small>
                    @enderror
                </div>
                <div class="mt-4">
                    <div class="float-end">
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <button class="btn btn-dark">Cancel</button>
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

            colorInput($('.inputColor'));
            $('.shopSession').addClass('active')
            width = parseInt($('.catgoryImg').outerWidth());
            $('.catgoryImg').css({
                'height': width - 50 + 'px'
            })

        });
        $('.inputColor').keyup(function(e) {
            colorInput($(this));
        });



        let colorInput = (obj) => {
            $('.chooseColors').html('')
            let colors = obj.val().split(',');
            if (obj.val().length == '0') {
                return;
            }
            console.log();
            let squareColors = ''
            for (let i = 0; i < colors.length; i++) {
                squareColors += `<i class="fa-solid fs-2 fa-square" style="color:${colors[i]}"></i>`
            }
            $('.chooseColors').html(squareColors);
        }
    </script>
@endpush
