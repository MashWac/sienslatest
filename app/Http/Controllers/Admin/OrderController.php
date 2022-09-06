<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orders;
use App\Models\PaymentModel;
use App\Models\Orderdetails;
use App\Models\Deliveries;

class OrderController extends Controller
{
    public function orderlist(){
        $order= new Orders();
        $data['orders']=$order->join('users','orders.user_id','=','users.user_id')->join('pesapal_payments','orders.payment_id','=','pesapal_payments.id')->join('delivery','orders.order_id','=','delivery.order_id')->paginate(10);

        return view('admin.orders.orders', compact('data'));
    }
    public function vieworder($id){
        $order=new Orders();
        $orderdets= new Orderdetails();
        $data['order']=$order->where('orders.order_id', $id)->join('users','orders.user_id','=','users.user_id')->join('delivery','orders.order_id','=','delivery.order_id')->get();
        $data['orderdets']=$order->where('orders.order_id',$id)->join('orderdetails', 'orders.order_id','=','orderdetails.order_id')->join('tbl_products', 'orderdetails.product_id','=','tbl_products.product_id')->get();

        return view('admin.orders.orderdetails', compact('data'));
    }
    public function updateorder($id){
        $order=Orders::find($id);
        $delivery=Deliveries::where('order_id',$id)->first();
        $order->order_status='DELIVERED';
        $delivery->delivery_status='DELIVERED';
        $order->update();
        $delivery->update();
        return redirect('orders')->with('status','Order Status Has Been Updated.');
    }
}
