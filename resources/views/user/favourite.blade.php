@extends('layouts.app')
@section('contents')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('shop') }}">Shop</a>
                    <span class="breadcrumb-item active">Favourite</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="FavTableBody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            getFavItems();
        });

        let removeFavLocalStorage = (id) => {
                let favs = JSON.parse(localStorage.getItem('fav'));
                if (favs != null) {
                    favs = favs.filter((e) => e != id);
                    localStorage.setItem('fav',JSON.stringify(favs));
                    getFavCount();
                }
                getFavItems();
            }

        let getFavItems = () => {
            let favs = localStorage.getItem('fav');
            $.ajax({
                type: "GET",
                url: "{{ route('fav_items') }}",
                data: {
                    favs
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    $tableData = '';
                    if (data.length > 0) {
                        for (let i = 0; i < data.length; i++) {
                            $tableData += `<tr>
                        <td class="text-start"><img src="{{ asset('storage/category/`+data[i].image+`') }}" alt="" style="width: 50px;">${data[i].name}</td>
                        <td class="align-middle">${data[i].price}</td>
                        <td class="align-middle">${data[i].type}</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger" onclick="removeFavLocalStorage(${data[i].id})"><i class="fa fa-times"></i></button></td>
                    </tr>`
                        }
                        
                    }else{
                        $tableData = 'The is No Favourite <a class="btn btn-primary my-3" href="{{route("shop")}}">Go to Shop<a>'
                    }
                    $('#FavTableBody').html($tableData);
                }
            });
        }
    </script>
@endpush
