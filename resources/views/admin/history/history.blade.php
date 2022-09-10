@extends('layouts.adminmain')


@section('content')
<div class="row mb-4">
        <div class="m-0">
            <a href="{{ url()->previous()}}" class="btn btn-outline-primary p-2"><i class="fa-solid fa-arrow-left-long"></i> Back</a href="{{ url()->previous()}}">
        </div>
</div>
<div class="row">
    <h4 class="mb-4">Histoy @if(isset($key))/ {{$key}} @endif</h4>
    @if(count($histories) == '0')
    <div class="row d-flex justify-center w-100 text-center">
        <div><img class=" img-fluid w-25" src="{{asset('frontend/img/oops.jpg')}}" alt=""></div>
        <div><h1>There is no History of  {{$key}}!</h1></div>
    </div>
    @endif
    <ul class="">
        @foreach ($histories as $history)
        <li class="list-group-item bg-dark text-light my-1">{{$history->make_user->name .' '.$history->actions}} <small class="float-end text-muted">{{$history->created_at->format('Y-m-d | h:i A')}}</small></li>
        @endforeach
      </ul>
</div>
@endsection

@push('scripts')

@endpush
