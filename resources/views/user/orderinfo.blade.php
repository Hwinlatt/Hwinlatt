@extends('layouts.app')
@section('contents')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home')}}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{route('shop')}}">Shop</a>
                    <a href="{{ route('myorder') }}" class="breadcrumb-item text-dark">{{ Auth::user()->name }}'s Orders</a>
                    <span class="breadcrumb-item active">{{ $order_info->order_code }}</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order_info->order_items as $item)
                            <tr>
                                <td class="align-middle"><img
                                        src="{{ asset('storage/category/' . $item->category->image) }}"
                                        alt="" style="width: 50px;"></td>
                                <td class="align-middle">{{ $item->category->name }}</td>
                                <td class="align-middle">{{ $item->category->price }} <small>MMK</small></td>
                                <td class="align-middle">x {{ $item->orderQty }}</td>
                                <td class="align-middle">
                                    {{ $item->category->price * $item->orderQty }}
                                    <small>MMK</small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    @if($order_info->remark != NULL)
                        <strong class="@if($order_info->status == '5') text-danger @endif">{{$order_info->remark}}</strong>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>
                                @php
                                    $total = 0;
                                    foreach ($order_info->order_items as $item) {
                                        $total += $item->category->price * $item->orderQty;
                                    }
                                    echo $total;
                                @endphp
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tax</h6>
                            <h6 class="font-weight-medium">
                                {{ $order_info->total_price - $total }}
                            </h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>{{ $order_info->total_price }} <small>MMK</small></h5>
                        </div>
                    </div>
                    @if ($order_info->will_deli_date != null && $order_info->status == 3)
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <button class="btn btn-success w-100 receivedBtn"> Received From Delivery <i class="fa-solid fa-dice-d6"></i></button>
                                <form action="{{route('user#order_received')}}" class="receiveForm" method="POST">
                                    @csrf
                                    <input type="text" class="d-none" name="order_code"
                                        value="{{ $order_info->order_code }}">
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
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
        $('.receivedBtn').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Receive package form Delivery?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#218838',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Received it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Received!',
                        'Your package has been received.',
                        'success'
                    )
                    $('.receiveForm').submit();
                }
            })
        });
    </script>
@endpush
