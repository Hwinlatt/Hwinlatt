@extends('layouts.adminmain');

@section('content')
<div class="row mb-4">
    <div class="m-0">
        <a href="{{route('admin#orders')}}" class="btn btn-outline-primary p-2"><i class="fa-solid fa-arrow-left-long"></i> Back</a href="{{ url()->previous()}}">
    </div>
</div>
    <div class="row">
        <div class="table-responsive">
            <h4 class="pt-3 text-center ">Orders @if (isset($orders->order_code))
                    of <span class="badge fw-bold fs-5 bg-primary"> {{ $orders->order_code }}</span>
                @endif
            </h4>
            <div class="float-end mt-5">
                @if ($orders->status == '1')
                    <button class="btn btn-outline-success p-2 orderAcceptBtn" title="accept order">Accept</button>
                    <button class="btn btn-outline-danger p-2 rejectOrderBtn" title="reject order" data-bs-toggle="modal"
                        data-bs-target="#rjtOrdModel">Reject</button>
                @elseif($orders->status == '2')
                    <span class="btn btn-outline-info p-2" disabled title="accept order">Accepted</span>
                    <button class="btn btn-outline-success p-2"
                        onclick="if(confirm('Change to delivered statage?')){$('.deliverFrom').submit()}"
                        title="accept order">Delivered</button>
                    <form action="{{ route('admin#delied') }}" method="POST" class="d-none deliverFrom">
                        @csrf
                        <input type="text" value="{{ $orders->order_code }}" name="order_code">
                    </form>
                @elseif($orders->status == '3')
                    <span class="btn btn-outline-info p-2" disabled title="accept order">Delivered</span>
                    <button class="btn btn-link text-light p-2" title="to received">Received <i
                            class="fa-solid fa-dice-d6"></i></button>
                @elseif($orders->status == '4')
                    <span class="btn btn-outline-success p-2" disabled title="accept order">Done->Close Order</span>
                @elseif($orders->status == '5')
                    <span class="btn btn-outline-danger p-2" disabled title="accept order">Rejected</span>
                @endif
                <a href="{{ url('admin/history/order/' . $orders->order_code) }}" class="btn btn-link p-2"
                    title="History"><i class="mdi mdi-history fs-3 m-0"></i></a>
                <hr>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Qty</th>
                        <th>Sub total</th>
                        <th>ServerCheck</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders->order_items as $items)
                        <tr id={{ $items->id }} class="item">
                            <td class="text-light">{{ $items->category->name }}</td>
                            <td class="text-light"><input type="text" class="input-text color"
                                    value="{{ $items->orderColor }}"></td>
                            <td class="text-light"><input type="text" class="input-text qty" size="5"
                                    value="{{ $items->orderQty }}"></td>
                            <td class="text-light"><input type="text" class="input-text sub_total" size="10"
                                    value="{{ $items->one_price * $items->orderQty }}"> MMK

                            </td>
                            <td class="chkServer">
                                @if ($orders->status == '1')
                                    @if ($items->category->qty == '0')
                                        <span class="badge badge-danger">Out stock</span>
                                    @elseif($items->category->qty < $items->orderQty)
                                        <span class="badge bg-warning text-black">Remain :{{ $items->category->qty }}</span>
                                    @else
                                        <span class="badge bg-success">In stock</span>
                                    @endif
                                @endif
                            </td>
                            <td class="text-light moreBtn">

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="row mt-3 flex-row-reverse">
            <div class="col-md-5 form-group">
                <div class="row align-items-center">
                    <h4 class="col text-end">Total Price</h4>
                    <input type="text" class="form-control allSubTotal text-light col bg-black me-2 text-end" readonly>
                    <span class="col">MMK</span>
                </div>
                <div class="row">
                    <h4 class="col text-end">Tax</h4>
                    <input class="form-control taxAmount text-light bg-black me-2 text-end col" type="text" readonly>
                    <span class="col">MMK</span>
                </div>
                <div class="row">
                    <h4 class="col text-end">Payment</h4>
                    <input class="form-control text-light bg-black me-2 text-end col" value="{{$orders->payment}}" type="text" readonly>
                    <span class="col"></span>
                </div>
                <form action="{{ url('admin/orders/' . $orders->order_code) }}" method="POST" class="ComfirmForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <h4 class="col text-end">All Total</h4>
                        <input class="form-control alltotal text-light bg-black me-2 text-end col" name="total_price"
                            type="text" readonly> <span class="col">MMK</span>
                    </div>
                </form>
                <form action="{{ route('admin#order_willDeliDate') }}" method="POST">
                    @csrf
                    <div class="row">
                        <h4 class="col text-end">Will Deliver</h4>
                        <input type="text" class="d-none" readonly value="{{ $orders->order_code }}" name="order_code">
                        <input class="form-control col text-end text-light bg-black me-2 will_deli_date" required
                            name="will_deli_date" value="{{ $orders->will_deli_date }}" type="date">
                        <div class="col">
                            <button type="submit" class="btn btn-primary rounded"
                                @if ($orders->status != 2) disabled @endif title="Deliver Date"><i
                                    class="mdi mdi-arrow-up-bold m-0"></i></button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6">
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="rjtOrdModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Reject {{ $orders->order_code }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin#order_rjt') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="text" value="{{ $orders->order_code }}" name="order_code" class="d-none">
                        <textarea name="rjtReason" class="w-100 bg-black text-light" placeholder="Please Enter the reject reason"
                            rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.orderList').addClass('active');
            total();
            if (inputRdOny()) {
                inputRdOny();
            }
        });
        let total = () => {
            let allTotal = 0;
            $('.sub_total').each(function() {
                allTotal += parseInt($(this).val());
            })
            $('.allSubTotal').val(parseInt(allTotal));
            $('.taxAmount').val(Math.ceil(parseInt(allTotal) / 100 * `{{ App\Models\Tax::find(1)->taxpercent }}`));
            $('.alltotal').val(parseInt($('.allSubTotal').val()) + parseInt($('.taxAmount').val()))
        }
    </script>

    @if ($orders->status != '1')
        <script>
            let inputRdOny = () => {
                $('input').each(function() {
                    $(this).prop('readonly', true);
                })
                $('.will_deli_date').removeAttr('readonly');

            }
        </script>
    @endif
    @if ($orders->status > 2)
        <script>
            $('.will_deli_date').attr('readonly', true);
        </script>
    @endif
    @if ($orders->status == '1')
        <script>
            $('.orderAcceptBtn').click(function() {
                $('.ComfirmForm').submit();
            })
            $('.item input').keyup(function(e) {
                trow = $(this).closest('tr');
                let id = trow.attr('id');
                let classNames = ['color', 'qty']
                for (let i = 0; i < classNames.length; i++) {
                    if ($(this).hasClass(classNames[i])) {
                        let Value = $(this).val();
                        if ($(this).val() == '') {
                            $(this).css({
                                'outline': '2px solid red'
                            })
                        } else {
                            $(this).css({
                                'outline': 'none'
                            })
                        }
                        chagange(Value, id, classNames[i], trow);
                        break;
                    }

                }
            });

            let chagange = (element, id, type, trow) => {
                let _token = '{{ csrf_token() }}';
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin#order_update') }}",
                    data: {
                        element,
                        _token,
                        id,
                        type
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (toString(response.qty)) {
                            trow.find('.sub_total').val(response.sub_total)
                            if (response.remain == '0') {
                                trow.find('.chkServer').html(
                                    `<span class="badge badge-danger">Out stock</span>`)
                            } else if (response.chk >= 0) {
                                trow.find('.chkServer').html(`<span class="badge bg-success">In stock</span>`)
                            } else if (response.chk < 0) {
                                trow.find('.chkServer').html(
                                    `<span class="badge bg-warning text-black">Remain :${response.remain}</span>`
                                )
                            }
                            total();
                        }
                    }
                });
            }
        </script>
    @endif

@endpush
