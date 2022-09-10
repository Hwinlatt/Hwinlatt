@extends('layouts.adminmain')
@section('content')
<div class="mb-3">
    <a href="{{route('admin#users')}}" class="btn btn-outline-primary p-2"><i class="fa-solid fa-arrow-left-long"></i> Back</a href="{{ url()->previous()}}">
</div>
    <div class="card-body">
        <h4 class="card-title">User Edit / <code>{{ $user->name }}</code></h4>
        <h5 class="text-end">
            <a href="{{ url('admin/history/user/' . $user->id) }}" class="btn btn-link p-2" title="History"><i
                    class="mdi mdi-history fs-3 m-0"></i></a>
        </h5>
        @if (session('status'))
            <code class="text-success">>> {{ session('status') }} </code >
        @endif
        <form class="forms-sample" method="POST" action="{{ route('admin#update_user') }}">
            @csrf
            <input type="text" name="id" class="d-none" value="{{ $user->id }}">
            <div class="row mt-3">
                <div class="form-group col-md-6">
                    <label for="exampleInputName1">Name</label>
                    <input required type="text" class="form-control text-light   @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name', $user->name) }}" id="exampleInputName1" placeholder="Name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Email address</label>
                    <input required type="email" autocomplete="off" name="email"
                        class="form-control text-light @error('email') is-invalid @enderror" id="exampleInputEmail3"
                        placeholder="Email" value="{{ old('email', $user->email) }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_one">Phone 1</label>
                    <input required type="number"
                        class="form-control text-light   @error('phone_one') is-invalid @enderror" name="phone_one"
                        value="{{ old('phone_one', $user->phone_one) }}" id="phone_one" placeholder="Name">
                    @error('phone_one')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_two">Phone 2</label>
                    <input type="number" class="form-control text-light   @error('phone_two') is-invalid @enderror"
                        name="phone_two" value="{{ old('phone_two', $user->phone_two) }}" id="phone_two"
                        placeholder="Name">
                    @error('phone_two')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputPassword4">New Password</label>
                    <input type="text" autocomplete="off" name="password"
                        class="form-control text-light @error('password') is-invalid @enderror" id="exampleInputPassword4"
                        placeholder="Password" value="">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleSelectGender">Gender</label>
                    <div class="d-flex">
                        <div class="form-check me-3">
                            <label class="form-check-label text-light">
                                <input type="radio" @if ('1' == old('gender', $user->gender)) checked @endif
                                    class="form-check-input" name="gender" id="male" value="1"> Male <i
                                    class="input-helper"></i></label>
                        </div>
                        <div class="form-check ">
                            <label class="form-check-label text-light">
                                <input type="radio" @if ('0' == old('gender', $user->gender)) checked @endif
                                    class="form-check-input" name="gender" id="female" value="0"> Female <i
                                    class="input-helper"></i></label>
                        </div>
                    </div>
                    @error('gender')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputCity1">City</label>
                    <select name="city" class="form-control text-light">
                        @php
                            $cities = ['yangon', 'bago', 'mandalay', 'bagan', 'pwin oo lwin'];
                        @endphp
                        @foreach ($cities as $city)
                            <option value="{{ $city }}" @if ($city == old('city', $user->city)) selected @endif>
                                {{ ucfirst($city) }}</option>
                        @endforeach

                    </select>
                    @error('city')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputCity1">User Role</label>
                    <select name="user_role" class="form-control text-light" id="exampleSelectGender">
                        <option value="1" @if ('1' == old('user_role', $user->user_role)) selected @endif>Admin</option>
                        <option value="0" @if ('0' == old('user_role', $user->user_role)) selected @endif>User</option>
                    </select>
                    @error('user_role')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    <label for="exampleTextarea1">Textarea</label>
                    <textarea class="form-control text-light" id="exampleTextarea1" rows="4"></textarea>
                </div> --}}
                <div class="col-md-12 text-end mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <a href="{{route('admin#users')}}" class="btn btn-dark">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('.userList').addClass('active');
    });
</script>
@endpush
