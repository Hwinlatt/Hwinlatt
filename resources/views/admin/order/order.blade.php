@extends('layouts.adminmain');

@section('content')
    <div class="row">
        <form class="d-flex row" method="GET" action="{{ route('admin#orders') }}">
            <div class="col-md-6 d-flex">
                <input type="text" name="inputSearchOrder" value="{{ request('inputSearchOrder') }}"
                    class="form-control me-2 rounded text-light" placeholder="Search Order">
                    <select name="filterStatus" id=""  class="bg-black text-light border-0">
                        <option value="all"  class="bg-black text-light border-0">all</option>
                        @foreach ($statuses as $status)
                        <option value="{{$status->id}}" @if(request('filterStatus')==$status->id) selected @endif class="bg-black text-light border-0">{{$status->name}}</option>
                        @endforeach
                    </select>
                <button class="btn btn-outline-primary ms-3">Search</button>
            </div>
            <div class="col-md-6 align-items-center">

            </div>

        </form>
        <div class="table-responsive">
            <h4 class="pt-3 text-center">Orders @if (isset($key))
                    of {{ $key }}
                @endif
            </h4>
            <table class="table">
                <thead>
                    <tr>
                        <th class="position-relative">
                            OID
                            <i class="mdi mdi-filter-variant text-light cursor-pointer"></i>
                            <div class="card filter-box position-fixed d-none" style='width:40rem;'>
                                <div class="card-body  text-wrap text-light">
                                    <i class="mdi mdi-filter text-primary"></i> <small id="oidFilters"></small>
                                    <input type="text" class=" oidFilter w-100 my-1 form-control text-light" autocomplete="none">
                                    <ul class="list-group mt-1" id="oidResult">
                                        <li class="list-group-item">Click Result to add Filter</li>
                                    </ul>
                                </div>
                            </div>
                        </th>
                        <th class="position-relative">
                            Status <i class="mdi mdi-filter-variant text-light cursor-pointer"></i>
                            <div class="card filter-box position-fixed d-none" style='width:200px;'>
                                <div class="card-body   text-wrap text-light ">
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label text-light">
                                            <input type="checkbox" value="all" class="form-check-input  allStatus"
                                                checked>all</label>
                                    </div>
                                    @foreach ($statuses as $status)
                                        <div class="form-check form-check-flat form-check-primary">
                                            <label class="form-check-label text-light">
                                                <input type="checkbox" value="{{ $status->name }}"
                                                    class="form-check-input  subStatus" checked> {{ $status->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <th class="position-relative">
                            UserName <i class="mdi mdi-filter-variant text-light cursor-pointer"></i>
                            <div class="card filter-box position-fixed d-none" style='width:200px;'>
                                <div class="card-body   text-wrap text-light ">

                                </div>
                            </div>
                        </th>
                        <th class="position-relative">
                            Phone {{-- <i class="mdi mdi-filter-variant text-light cursor-pointer"></i> --}}
                            {{-- <div class="card filter-box position-fixed d-none" style='width:200px;'>
                                <div class="card-body   text-wrap text-light ">

                                </div>
                            </div> --}}
                        </th>
                        <th class="position-relative">
                            Total Price {{--  <i class="mdi mdi-filter-variant text-light cursor-pointer"></i> --}}
                            {{-- <div class="card filter-box d-none">
                                <div class="card-body position-fixed w-100 text-wrap text-light ">

                                </div>
                            </div> --}}
                        </th>
                        <th class="position-relative">
                            Ordered Date {{-- <i class="mdi mdi-filter-variant text-light cursor-pointer"></i> --}}
                            {{-- <div class="card filter-box d-none">
                                <div class="card-body position-fixed w-100 text-wrap text-light ">

                                </div>
                            </div> --}}
                        </th>
                        <th class="position-relative">
                             Accepted Date {{--<i class="mdi mdi-filter-variant text-light cursor-pointer"></i> --}}
                            {{-- <div class="card filter-box d-none">
                                <div class="card-body position-fixed w-100 text-wrap text-light ">

                                </div>
                            </div> --}}
                        </th>
                    </tr>
                </thead>
                <tbody id="orderTable">
                    @foreach ($orders as $order)
                        <tr>
                            <td class="text-light"><a href="{{ url('admin/orders/' . $order->order_code) }}"
                                    class="btn btn-link oidBtn @if ($order->status == '5') text-danger @endif"><span
                                        class="oid">{{ $order->order_code }}</span></a>
                            </td>
                            <td class="">
                                <span class="orderStatus">{{ $order->order_status->name }}</span>
                            </td>
                            <td class="text-light">{{ $order->name }}</td>
                            <td class="text-light">{{ $order->phone_one }} , {{ $order->phone_two }}</td>
                            <td class="text-light">{{ $order->total_price }}</td>
                            <td class="text-light">{{ $order->created_at->format('d-m-Y | h:i:s A') }}</td>
                            <td class="text-light me-3">
                                @if ($order->updated_at == $order->created_at)
                                    ---
                                @else
                                    {{ $order->updated_at->format('d-m-Y | h:i:s A') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#order').addClass('active');
            $('.orderList').addClass('active');
        });

        $('.mdi-filter-variant').click(function(e) {
            let filterBox = $(this).parent().find('.filter-box')
            filterBox.toggleClass('d-none');
            if (filterBox.hasClass('d-none')) {
                $(this).removeClass('text-primary').addClass('text-light');
            } else {
                $(this).removeClass('text-light').addClass('text-primary')
            }
        });
        // OID filter

        $('.oidFilter').keyup(function(e) {
            let key = $(this).val();
            $('#oidResult').html('');
            let OidResultArray = [];
            $('.oid').each(function() {
                if ($(this).html().toLowerCase().includes(key.toLowerCase())) {
                    OidResultArray.push($(this).html())
                    $('#oidResult').append(
                        `<li class="list-group-item bg-dark  text-light cursor-pointer">${$(this).html()}</li>`
                    );
                }
            })

            $('li').click(function() {
                let old = $('#oidFilters').html();
                let clValue = $(this).html().toLowerCase();
                let chk = true;
                inFilter = [];
                $('.oidFilter').val(clValue)
                $('#oidFilters span').each(function() {
                    inFilter.push($(this).html().toLowerCase())
                })
                if (inFilter.includes(clValue)) {
                    chk = false;
                }
                if (chk) {
                    if (old == '') {
                        $('#oidFilters').html(
                            `<span title='click to remove filter' class="badge badge-primary m-1 cursor-pointer">${clValue}</span>`)
                        inFilter.push(clValue);
                    } else {
                        $('#oidFilters').html(old +
                            `<span  title='click to remove filter' class="badge badge-primary m-1 cursor-pointer">${clValue}</span>`);
                        inFilter.push(clValue);
                    }
                    filterOid(inFilter);
                }

                $('#oidFilters span').click(function() {
                    $(this).remove();
                    let key = $(this).html().toString()
                    inFilter = $.grep(inFilter, function(value) {
                        return value != key;
                    });
                    filterOid(inFilter);
                    if (inFilter.length == '0') {
                        $('.oid').show();
                    }
                })
            })
        });
        let filterOid = (array) => {
            $('.oid').each(function() {
                if (array.includes($(this).html().toLowerCase())) {
                    $(this).closest('tr').show();
                } else {
                    $(this).closest('tr').hide();
                }
            })
            if (array.length == '0') {
                $('.oid').closest('tr').show();
            }
        }

        //Status Filter
        $('.allStatus').change(function() {
            if ($(this).is(':checked')) {
                $('.subStatus').each(function() {
                    if (!$(this).is(':checked')) {
                        $(this).click();
                    }
                })
            } else {
                $('.subStatus').each(function() {
                    if ($(this).is(':checked')) {
                        $(this).click();
                    }
                })
            }
        })
        $('.subStatus').change(function(e) {
            chkStatus = [];
            $('.subStatus').each(function() {
                if ($(this).is(':checked')) {
                    chkStatus.push($(this).val());
                }
            })
            if (chkStatus.length == '{{ count($statuses) }}') {
                $('.allStatus').attr('checked', true);
                if (!$('.allStatus').is(':checked')) {
                    $('.allStatus').click()
                }
            } else {
                $('.allStatus').removeAttr('checked');
            }
            if (chkStatus.length == '0') {
                if ($('.allStatus').is(':checked')) {
                    $('.allStatus').click();
                }
            }
            $('.orderStatus').each(function() {
                if (chkStatus.includes($(this).html())) {
                    $(this).closest('tr').show();
                } else {
                    $(this).closest('tr').hide();
                }
            })
        });
    </script>
@endpush
