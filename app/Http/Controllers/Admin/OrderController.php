<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orders;
use App\Models\Orderdetails;

class OrderController extends Controller
{
    public function orderlist(){
        $order= new Orders();
        $data['orders']=$order->join('users','orders.user_id','=','users.user_id')->join('delivery','orders.order_id','=','delivery.order_id')->paginate(10);

        return view('admin.orders.orders', compact('data'));
    }
    public function vieworder($id){

    }
    public function updateorder(){

    }
}
