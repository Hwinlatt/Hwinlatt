@extends('layouts.app')
@section('contents')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home')}}">Home</a>
                    <span class="breadcrumb-item active">{{Auth::user()->name}}'s Orders</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Your Orders</span></h5>
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Order status</th>
                            <th>Deliver Date</th>
                            <th>Total Price</th>
                            <th>Ordered Date</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($orders as $order)
                        <tr>
                            <td class="align-middle">{{$order->order_code}}</td>
                            <td class="align-middle">
                                <span class="badge badge-{{$order->order_status->color}} w-100 py-2">{{strtoupper($order->order_status->name)}}</span>
                            </td>
                            <td class="align-middle">{{$order->will_deli_date}}</td>
                            <td class="align-middle">{{$order->total_price}} <small>MMK</small></td>
                            <td class="align-middle">{{$order->created_at->format('d-m-Y | h:i:s A')}}</td>
                            <td class="align-middle d-flex">
                                <a href="{{url('user/myorder/'.$order->order_code)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-ellipsis"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.morePage').addClass('active')

    });
</script>
@endpush
