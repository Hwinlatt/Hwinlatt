@extends('layouts.app')

@section('contents')
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
        @endif
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for ($i = 0; $i < count($slideShows); $i++)
                            <li data-target="#header-carousel" data-slide-to="{{ $i }}"
                                @if ($i == 0) class="active" @endif></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($slideShows as $slideShow)
                            <div class="carousel-item position-relative @if ($loop->first) active @endif"
                                style="height: 430px;">
                                <img class="position-absolute w-100 h-100"
                                    src="{{ asset('storage/homePage/' . $slideShow->image) }}" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                            {{ $slideShow->header }}
                                        </h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">{{ $slideShow->text }}
                                        </p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                            href="{{ $slideShow->link }}">Shop Now</a>
                                        <a class="btn btn-link py-2 px-4 mt-3 animate__animated animate__fadeInUp rounded"
                                            href="{{ asset('storage/homePage/' . $slideShow->image) }}">View Image</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row my-4">
                @foreach ($cards as $card)
                    <div class="col-lg-4">
                        <div class="product-offer mb-30" style="height: 200px;"
                            onclick="window.location = '{{ asset('storage/homePage/' . $card->image) }}'">
                            <img class="img-fluid" src="{{ asset('storage/homePage/' . $card->image) }}" alt="">
                            <div class="offer-text">
                                <h6 class="text-white text-uppercase">{{ $card->header }}</h6>
                                <h3 class="text-white mb-3">{{ $card->text }}</h3>
                                <a href="{{ $card->link }}" class="btn btn-primary">Shop Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3">

            @foreach ($categoryTypes as $catType)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <a class="text-decoration-none" href="{{ url('shop/category/' . $catType->type_name) }}">
                        <div class="cat-item d-flex align-items-center mb-4">
                            <div class="overflow-hidden" style="width: 100px; height: 100px;">
                                <img class="img-fluid w-100 h-100"
                                    src="{{ asset('storage/categoryType/' . $catType->image) }}" alt="">
                            </div>
                            <div class="flex-fill pl-3">
                                <h6>{{ $catType->type_name }}</h6>
                                <small class="text-body">100 Products</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.homeSession').addClass('active');
        });
    </script>
@endpush
