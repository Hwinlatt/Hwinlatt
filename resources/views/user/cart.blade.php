@extends('layouts.app')

@section('contents')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home')}}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{route('shop')}}">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
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
                            <th>Products</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        @foreach ($carts as $cart)
                            <tr cartId="{{ $cart->id }}">
                                <td class="align-middle"><img
                                        src="{{ asset('storage/category/' . $cart->categories->image) }}"
                                        alt="" style="width: 50px;">{{$cart->categories->name}}</td>
                                <td class="align-middle"><i class="fa-solid fa-square"
                                        style="color:{{ $cart->cartcolor }}"></i></td>
                                <td class="align-middle"><span class="price">{{ $cart->categories->price }}</span> MMK
                                </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control  form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $cart->cartQty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus cartPlus @if($cart->categories->qty == $cart->cartQty && isset($cart)) d-none @endif">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle"><input type="text" size="0" class="sumOneRow input-text"
                                        value="{{ $cart->categories->price * $cart->cartQty }}"> MMK</td>
                                <td class="align-middle"><button class="btn btn-sm remove-cart btn-danger"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <input type="text" class="input-text" value="">
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 class="totalBill">
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tax</h6>
                            <h6 class="font-weight-medium taxAmount"></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 class="allTotal"></h5>
                        </div>
                        <a href="{{ route('chkout') }}"
                            class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed
                            To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            totalBill('.sumOneRow', '.totalBill');
            textAmount();
            $('.morePage').addClass('active');

        })
        let textAmount = () => {
            let percent = parseInt($('.totalBill').html()) / 100;
            $('.taxAmount').html(parseInt('{{ $tax->taxpercent }}') * percent)
            finalTotal()
        }
        let finalTotal = () => {
            $('.allTotal').html(parseInt($('.taxAmount').html()) + (parseInt($('.totalBill').html())));
        }
        $('.quantity button').click(function() {
            let cartRow = $(this).closest('tr');
            let cid = cartRow.attr('cartId');
            let price = parseInt($(this).closest('tr').find('.price').html());
            let cartQty = parseInt($(this).parent().parent().find('input').val())
            if (cartQty + 1  > '@if(isset($cart)){{$cart->categories->qty }}@endif') {
                cartRow.find('.cartPlus').hide()
                }else{
                cartRow.find('.cartPlus').removeClass('d-none')
                cartRow.find('.cartPlus').show()
                }
            $(this).closest('tr').find('.sumOneRow').val(price * cartQty);
            totalBill('.sumOneRow', '.totalBill');
            textAmount();
            let _token = "{{ csrf_token() }}";
            $.ajax({
                type: "POST",
                url: "{{ route('up-cart') }}",
                data: {
                    cartQty,
                    _token,
                    cid
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.remove) {
                        cartRow.remove();
                        Swal.fire({
                            icon: 'info',
                            title: 'Removed itom!',
                            text: response.remove,
                            timer: alertRemoveTime(response.remove) * 1000,
                            timerProgressBar: true,
                        })
                    }
                }
            });
        })
        $('.remove-cart').click(function() {
            let _token = "{{ csrf_token() }}";
            let cartRow = $(this).closest('tr');
            let removeCartId = cartRow.attr('cartId');
            $.ajax({
                type: "POST",
                url: "{{ route('rm-cart') }}",
                data: {
                    removeCartId,
                    _token
                },
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.error,
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '<i class="fa-solid fa-arrow-rotate-right"></i> Refresh'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }
                    if (response.success) {
                        cartRow.remove();
                        Swal.fire({
                            icon: 'success',
                            title: 'Successful',
                            text: response.success,
                            timer: alertRemoveTime(response.success) * 1000,
                            timerProgressBar: true,
                        })
                        totalBill('.sumOneRow', '.totalBill');
                        textAmount();
                    }
                },
                error: function(error) {
                    checkInternet(error);
                }
            });
        })
    </script>
@endpush
