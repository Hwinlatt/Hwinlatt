@extends('layouts.adminmain')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title ">Add to Home Page</h4>
                <form action="{{route('admin#insert_page')}}" class="forms-sample" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="header1">Header</label>
                        <input type="text" value="{{old('header')}}" class="form-control bg-black text-light @error('header') is-invalid @enderror" autocomplete="none"
                            name="header" id="header1" placeholder="Header Name">
                        @error('header')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="text1">Text</label>
                        <textarea class="d-block bg-black text-light w-100 @error('text') is-invalid @enderror" name="text" id="text1"
                            rows="5" placeholder="Enter Text">{{old('text')}}</textarea>
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
                                <option value="{{ $option }}" @if($option == old('place',request('type'))) selected @endif>{{ ucfirst($option) }}</option>
                            @endforeach
                        </select>
                        @error('place')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link1">Link</label>
                        <input type="text" value="{{old('link','http://127.0.0.1:8000/shop/category/tags?tags=')}}" class="form-control bg-black text-light @error('link') is-invalid @enderror" autocomplete="none"
                            name="link" id="link1" placeholder="Link">
                        @error('link')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image1">Image</label>
                        <input type="file"  class="form-control bg-black text-light @error('image') is-invalid @enderror" autocomplete="none"
                            name="image"  id="image1" placeholder="Link">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
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
    </script>
@endpush
