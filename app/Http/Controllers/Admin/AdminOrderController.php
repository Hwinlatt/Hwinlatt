<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminHistory;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::when(request('filterStatus'), function ($e) {

            $this->search($e, request('inputSearchOrder'), request('filterStatus'));
        })->orderBy('created_at', 'asc')->get();
        $statuses = OrderStatus::all();
        return view('admin.order.order', compact('orders', 'statuses'));
    }
    public function order_items($order_code)
    {
        $key = $order_code;
        $orders = Order::where('order_code', $key)->first();
        return view('admin.order.moreOid', compact('orders', 'key'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $order_item = OrderItem::find($id);

        if ($request->type == 'color') {
            $order_item->orderColor = $request->element;
        } elseif ($request->type == 'qty') {
            $order_item->orderQty = $request->element;
        }
        $order_item->save();

        if ($request->type == 'qty') {
            return response()->json([
                'sub_total' => $order_item->orderQty * $order_item->one_price, 'chk' => $order_item->category->qty - $order_item->orderQty,
                'remain' => $order_item->category->qty
            ]);
        }
    }
    public function confirm(Request $request, $id)
    {
        $order = Order::where('order_code', $id)->first();
        $order->total_price = $request->total_price;
        $order->status = 2;

        $items = OrderItem::where('order_code', $id)->get();
        foreach ($items as $item) {
            if ($item->orderQty > $item->category->qty) {
                return back()->with('error', $item->category->name . ' is not enough .Please Check!');
            } elseif ($item->orderQty <= $item->category->qty) {
                $category = Category::find($item->orderCatgory);
                $category->qty -= $item->orderQty;
                if ($category->qty == '0') {
                    $category->available = '0';
                }
                $category->update();
            }
        }
        $order->update();
        $hiAction = '(admin) Accepted order ';
        AdminHistory::add_history('order', $order->order_code, Auth::user()->id, $hiAction);
        return back()->with('success', 'Order Accepted!');
    }
    public function will_deli_date(Request $request)
    {
        $order = Order::where('order_code', $request->order_code)->first();
        $order->will_deli_date = $request->will_deli_date;
        if ($order->will_deli_date == NULL) {
            $hiAction = ' Created ' . $order->order_code . ' will Deli Date at ' . $request->will_deli_date;
        } else {
            $hiAction = ' Updated ' . $order->order_code . ' Deli Date to ' . $request->will_deli_date;
        }
        $order->update();
        AdminHistory::add_history('order', $order->order_code, Auth::user()->id, $hiAction);
        return back()->with('success', $order->order_code . ' changed Delivered Date to ' . $order->will_deli_date);
    }
    public function reject(Request $request)
    {
        $order = Order::where('order_code', $request->order_code)->first();
        $order->status = '5';
        $order->remark = $request->rjtReason;
        $order->update();
        $hiAction = '(admin) is rejected order with reason:' . $order->remark;
        AdminHistory::add_history('order', $order->order_code, Auth::user()->id, $hiAction);
        return back()->with('success', 'Order Rejected!');
    }
    public function delivered(Request $request)
    {
        $order = Order::where('order_code', $request->order_code)->first();
        if ($order->will_deli_date == NULL) {
            return back()->with('error', 'Please Update the Will Deli Date');
        }
        $order->status = '3';
        $order->update();
        $hiAction = 'Changed status  to Delivered';
        AdminHistory::add_history('order', $order->order_code, Auth::user()->id, $hiAction);
        return back()->with('success', 'Changed status to "Delivered');
    }



    private function search($db, $key, $status)
    {
        if ($status != 'all') {
            $db->where('status', $status);
        }
        if ($key != '') {
            $db->where('order_code', 'like', '%' . $key . '%')
            ->orWhere('name', 'like', '%' . $key . '%')
            ->orWhere('email', 'like', '%' . $key . '%')
            ->orWhere('phone_one', 'like', '%' . $key . '%')
            ->orWhere('phone_two', 'like', '%' . $key . '%')
            ->orWhere('phone_two', 'like', '%' . $key . '%')
            ->orWhere('address', 'like', '%' . $key . '%')
            ->orWhere('country', 'like', '%' . $key . '%')
            ->orWhere('city', 'like', '%' . $key . '%')
            ->orWhere('payment', 'like', '%' . $key . '%');
        }
    }
}
