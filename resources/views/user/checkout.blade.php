@extends('layouts.app')
<!-- +++++++++++++++++++++++++++++++++++++++++ -->
@section('contents')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home')}}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{route('shop')}}">Shop</a>
                    <a class="breadcrumb-item text-dark" href="{{route('carts')}}">Carts</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
        <!-- Checkout Start -->
        <div class="container-fluid">
            <form action="{{route('order')}}" method="POST">
                @csrf
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Your Address</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>First Name</label>
                                <input class="form-control" name="name" value="{{Auth::user()->name}}" readonly  type="text" placeholder="John">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" name="email"  value="{{Auth::user()->email}}" readonly type="text" placeholder="example@email.com">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No-1</label>
                                <input class="form-control" name="phone_one" type="number" value="{{Auth::user()->phone_one}}" placeholder="09">
                                @error('phone_one')
                                    <small><strong class="text-danger">{{$message}}</strong></small>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No-2</label>
                                <input class="form-control" name="phone_two" type="number" value="{{Auth::user()->phone_two}}" placeholder="09">
                                @error('phone_two')
                                    <small><strong class="text-danger">{{$message}}</strong></small>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Address Line 1</label>
                                <textarea class="form-control" name="address" type="text" rows="4" placeholder="123 Street">{{Auth::user()->address}}</textarea>
                                @error('address')
                                    <small><strong class="text-danger">{{$message}}</strong></small>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <select name="country" class="custom-select">
                                    <option value="myanmar" selected>Myanmar</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <select name="city" class="form-select" aria-label="Default select example">
                                    @php
                                        $cities = ['yangon', 'bago', 'mandalay', 'bagan', 'pwin oo lwin'];
                                    @endphp
                                    @foreach ($cities as $city)
                                        <option value="{{ $city }}" @if ($city == old('city', Auth::user()->city)) selected @endif>
                                            {{ ucfirst($city) }}</option>
                                    @endforeach

                                </select>
                            </div>
                            {{-- <div class="col-md-12 form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="newaccount">
                                    <label class="custom-control-label" for="newaccount">Save Info</label>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="shipto">
                                    <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    {{-- <div class="collapse mb-5" id="shipping-address">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping Address</span></h5>
                        <div class="bg-light p-30">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" value="" placeholder="John">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" placeholder="Doe">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" placeholder="example@email.com">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Mobile No</label>
                                    <input class="form-control" type="text" placeholder="+123 456 789">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Address Line 1</label>
                                    <input class="form-control" type="text" placeholder="123 Street">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Address Line 2</label>
                                    <input class="form-control" type="text" placeholder="123 Street">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Country</label>
                                    <select class="custom-select">
                                        <option selected>United States</option>
                                        <option>Afghanistan</option>
                                        <option>Albania</option>
                                        <option>Algeria</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>City</label>
                                    <input class="form-control" type="text" placeholder="New York">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>State</label>
                                    <input class="form-control" type="text" placeholder="New York">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>ZIP Code</label>
                                    <input class="form-control" type="text" placeholder="123">
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="col-lg-4">
                    @if(session('error'))
                    <strong class="text-danger">{{session('error')}}</strong>
                    @endif
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom">
                            <h6 class="mb-3">Products</h6>
                            @foreach ($carts as $cart)
                            <div class="d-flex justify-content-between">
                                <p class=" pe-2">{{$cart->categories->name}} (x {{$cart->cartQty}})</p>
                                <p class=" text-nowrap">{{$cart->cartQty * $cart->categories->price}} <small>MMK</small></p>
                            </div>
                            @endforeach
                        </div>
                        <div class="border-bottom pt-3 pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6>
                                    @php
                                        $allprice = 0;
                                        for ($i=0; $i < count($carts) ; $i++) {
                                            $allprice += ($carts[$i]->cartQty * $carts[$i]->categories->price) ;
                                        }
                                        $taxAmount = ($allprice /100)* $tax->taxpercent;
                                        echo $allprice;
                                    @endphp
                                    <small>MMK</small>
                                </h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Tax</h6>
                                <h6 class="font-weight-medium">{{$taxAmount}}</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5>{{$allprice + $taxAmount}}</h5>
                                <input name="total_price" type="number" readonly class="d-none" value="{{$allprice + $taxAmount}}">
                            </div>
                            @error('total_price')
                                    <small class="text-danger">
                                        <strong>{{$message}}</strong><br>
                                        <strong>Ther is noting cart. <a href="{{route('shop')}}" class="btn btn-sm btn-primary">shop now</a></strong>
                                    </small>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-5">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                        @error('payment')
                                    <small><strong class="text-danger">{{$message}}</strong></small>
                                @enderror
                        <div class="bg-light p-30">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input"  name="payment" id="paypal" value="paypal">
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input"  name="payment" id="directcheck" value="directcheck">
                                    <label class="custom-control-label" for="directcheck">Direct Check</label>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input"  name="payment" id="banktransfer" value="banktransfer">
                                    <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
        <!-- Checkout End -->
@endsection



@push('scripts')
<script>
    $(document).ready(function() {
        $('.morePage').addClass('active')

    });
</script>
@endpush
