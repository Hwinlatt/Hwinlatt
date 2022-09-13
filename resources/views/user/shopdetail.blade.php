@extends('layouts.app') @section('contents')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('shop') }}">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/category/' . $category->image) }}"
                                alt="Image" />
                        </div>
                        {{-- <div class="carousel-item">
                        <img class="w-100 h-100" src="img/product-2.jpg" alt="Image" />
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="img/product-3.jpg" alt="Image" />
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="img/product-4.jpg" alt="Image" />
                    </div> --}}
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <div class="text-end">
                        <button class="btn btn-outline-dark" title="Add Favourite"
                            onclick="addFavLocalStorage({{ $category->id }})">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                        <button class="btn btn-primary" title="Remove Favourite"
                            onclick="removeFavLocalStorage({{ $category->id }})">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    </div>
                    <h3>{{ $category->name }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">
                        {{ $category->price }} MMK
                    </h3>
                    <p class="mb-4">
                        {{ Str::substr($category->description, 0, 200) }}...
                    </p>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Sizes:</strong>
                        {{-- <form>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-1" name="size" />
                            <label class="custom-control-label" for="size-1">XS</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-2" name="size" />
                            <label class="custom-control-label" for="size-2">S</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-3" name="size" />
                            <label class="custom-control-label" for="size-3">M</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-4" name="size" />
                            <label class="custom-control-label" for="size-4">L</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-5" name="size" />
                            <label class="custom-control-label" for="size-5">XL</label>
                        </div>
                    </form> --}}
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Colors:</strong>
                        <div class="categoryColors">
                            @foreach (explode(',', $category->colors) as $color)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" @if ($loop->first) checked @endif
                                        class="custom-control-input" value="{{ $color }}"
                                        id="color-{{ $loop->index }}" name="color">
                                    <label class="custom-control-label"
                                        for="color-{{ $loop->index }}">{{ ucfirst($color) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Remain Qty:</strong>
                        <span class="">{{ $category->qty }}</span>
                    </div>
                    <div class="d-flex mb-4">
                        @if ($category->available == '1')
                            <span class="badge badge-success">Available</span>
                        @else
                            <span class="badge badge-danger">Out of Stock</span>
                        @endif
                    </div>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        @if ($category->available == '1' && $category->qty > '0')
                            <div class="input-group quantity mr-3" style="width: 130px">
                                <span class="rmNumber d-none">{{ $category->qty }}</span>

                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control bg-secondary border-0 text-center"
                                    value="1" />
                                <div class="input-group-btn">
                                    <button class="btn btn-primary addMoreBtn btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            @if (Auth::user())
                                <button cid="{{ $category->id }}" class="btn btn-primary px-3 addToCart">
                                    <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary px-3"><i
                                        class="fa fa-shopping-cart mr-1"></i> Add To Cart</a>
                            @endif
                        @endif
                    </div>

                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab"
                            href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews
                            ({{ $totalComment }})</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>
                                @php
                                    $details = explode('|', $category->description);
                                    foreach ($details as $detail) {
                                        $tests = explode('<>', $detail);
                                        $echoText = '<b>' . $tests[0] . '</b> >>>';
                                        for ($i = 1; $i < count($tests); $i++) {
                                            $echoText .= $tests[$i];
                                        }
                                        echo $echoText . '<br />';
                                } @endphp </p>
                        </div>
                        <!--Comment Section -->
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">
                                        {{ $totalComment }} reviews
                                    </h4>
                                    <div id="cmtContainer">
                                        <!-- ... -->
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary ratingStarsContainer"></div>
                                    </div>
                                    <form id="insertCommentForm" action="{{ route('insert_Cmt') }}">
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <input class="ratingInput d-none" type="range" min="1" max="5"
                                            class="d-none" value="5" />
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review"
                                                class="btn btn-primary px-3" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Detail End -->
    @endsection @push('scripts')
    <script>
        let _token = '{{ csrf_token() }}';
        let commentAmout = 5;
        $(document).ready(function() {
            $('.shopDetail').addClass('active')
            FavIconChange('{{ $category->id }}');
            ratingStarsChange($('.ratingInput').val());
            getPreviewCommets();
            $('#insertCommentForm').submit(function(e) {
                e.preventDefault();
                cId = '{{ $category->id }}';
                comment = $(this).find('textarea').val();
                rating = $(this).find('.ratingInput').val();
                if ('{{ empty(Auth::user()) }}') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please Login First!',
                        footer: '<a href="{{ route('login') }}">Login Now</a>'
                    })
                    return;
                }
                console.log('submiting');
                $.ajax({
                    type: "POST",
                    url: "{{ route('insert_Cmt') }}",
                    data: {
                        cId,
                        comment,
                        rating,
                        _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.errors) {
                            let errors = "";
                            for (let i = 0; i < data.errors.length; i++) {
                                errors += data.errors[i];
                            }
                            Swal.fire('Error!', errors, 'error')
                        }
                        if (data.success) {
                            Swal.fire('Success', 'Commented successful.', 'success');
                            $('#insertCommentForm textarea').val('');
                            $('#insertCommentForm ratingInput').val(5);
                            ratingStarsChange(5);
                            getPreviewCommets();
                        }
                    }

                });
            });
        });

        //Change Raing Value
        let changeRatingVal = (int) => {
            $('.ratingInput').val(int);
            ratingStarsChange(int);
        }

        //Change Star When Click
        let ratingStarsChange = (int) => {
            $stars = '';
            for (let i = 1; i < 6; i++) {
                if (i <= int) {
                    $stars += `<i onclick="changeRatingVal(${i})" class="fa-solid fa-star"></i>`;
                } else {
                    $stars += `<i onclick="changeRatingVal(${i})" class="far fa-star"></i>`;
                }
            }
            $('.ratingStarsContainer').html($stars);
        }
        //MoreComment Load 
        let moreComment = () => {
            commentAmout += 5;
            getPreviewCommets();
        }
        //Show Less Comments Load
        let showLessComment = () => {
            commentAmout = 5;
            getPreviewCommets();
        }
        //DeleteComment
        let deleteCommet = (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('del_comment') }}",
                        data: {
                            id,
                            _token
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data == '1') {
                                Swal.fire('Success!', 'Comment is successfully deleted', 'success');
                                getPreviewCommets();
                            }
                        }
                    });
                }
            })

        }
        //Get Comment From DataBase
        let getPreviewCommets = () => {
            $('#cmtContainer').load(`{{ route('pre_comments', $category->id) }}?amount=${commentAmout}`)
        }
        let removeFavLocalStorage = (id) => {
            let favs = JSON.parse(localStorage.getItem('fav'));
            if (favs != null) {
                favs = favs.filter((e) => e != id);
                localStoreFavChange(favs);
                Swal.fire('Removed', 'Remove From Favourite Success', 'success')
            }
            FavIconChange('{{ $category->id }}');
        }

        $('.addToCart').click(function(e) {
            e.preventDefault();
            let color = $(".categoryColors input[type='radio']:checked").val();
            let cartQty = $(this).parent().find('input').val();
            let cid = $(this).attr('cid');
            let _token = "{{ csrf_token() }}"
            $.ajax({
                type: "POST",
                url: "{{ route('addToCart') }}",
                data: {
                    color,
                    cartQty,
                    cid,
                    _token
                },
                dataType: "JSON",
                success: function(response) {
                    $('.alertBox span').html('');
                    let Alert = ''
                    if (response.errors) {
                        response.errors.forEach(element => {
                            Alert += element;
                        });
                        Swal.fire({
                            title: 'Error!',
                            text: Alert,
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            timer: alertRemoveTime(Alert) * 1000,
                            timerProgressBar: true,
                        })
                    } else if (response.success) {

                        Swal.fire({
                            title: 'Success!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            timer: alertRemoveTime(response.success) * 1000,
                            timerProgressBar: true,
                        })
                    }


                    let errortexts = $('.alertBox span').html();
                    let time = errortexts.split(' ');
                    alertHide(time)
                }
            });
        });
    </script>
@endpush
