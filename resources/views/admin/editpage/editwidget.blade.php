@extends('layouts.adminmain')

@section('content')
    <div class="row  my-2">
        <div><a href="{{route('admin#edit_page')}}" class="btn btn-outline-primary"><i class="fa-solid fa-arrow-left-long"></i> Back</a ></div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Widget @if(request('name')) to {{request('name')}} @endif</h4>
                <form action="{{route('admin#update_widget_page')}}" class="forms-sample" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <input type="number" class="d-none" readonly name="id" value="{{$widget->id}}">
                    <div class="form-group">
                        <label for="header1">Header</label>
                        <input type="text" value="{{old('header',$widget->header)}}" class="form-control bg-black text-light @error('header') is-invalid @enderror" autocomplete="none"
                            name="header" id="header1" placeholder="Header Name">
                        @error('header')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="text1">Text</label>
                        <textarea class="d-block bg-black text-light w-100 @error('text') is-invalid @enderror" name="text" id="text1"
                            rows="5" placeholder="Enter Text">{{old('text',$widget->text)}}</textarea>
                        @error('text')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Place</label>
                        <select class="form-control bg-black text-light text-light  @error('place') is-invalid @enderror " name="place"
                            id="type">
                            @php
                                $options = ['slideShow', 'card'];
                            @endphp
                            @foreach ($options as $option)
                                <option value="{{ $option }}" @if($option == old('place',$widget->place)) selected @endif>{{ ucfirst($option) }}</option>
                            @endforeach
                        </select>
                        @error('place')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link1">Link</label>
                        <input type="text" value="{{old('link',$widget->link)}}" class="form-control bg-black text-light @error('link') is-invalid @enderror" autocomplete="none"
                            name="link" id="link1" placeholder="Link">
                        @error('link')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image1">Update Image</label>
                        <input type="file"  class="form-control newImage bg-black text-light @error('image') is-invalid @enderror" autocomplete="none"
                            name="image"  id="image1">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <a href="{{asset('storage/homePage/'.$widget->image)}}" class=""><img src="{{asset('storage/homePage/'.$widget->image)}}" class="w-25" alt=""></a>
                        <strong class="text-danger fs-3 oldImgWarning d-none">Old Image will be deleted form server after upload!</strong>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a href="{{route('admin#edit_page')}}" class="btn btn-dark">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.editPage').addClass('active');
        });
        $('.newImage').change(function () {
            $('.oldImgWarning').removeClass('d-none');
        });
    </script>
@endpush
