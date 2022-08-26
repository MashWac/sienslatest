<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Bryceandy\Laravel_Pesapal\Facades\Pesapal;
use Bryceandy\Laravel_Pesapal\Payment;
use App\Models\Orders;
use App\Models\Deliveries;
use App\Models\Orderdetails;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;



class IpnController extends Controller 
{
    public function __invoke()
    {
        $delivery =new Deliveries();
        $orders=new Orders();
        $orderdetails=new Orderdetails();
        $product=new Product();
        $category=new Category();
        $transaction = Pesapal::getTransactionDetails(
            request('pesapal_merchant_reference'), request('pesapal_transaction_tracking_id'));

        Payment::modify($transaction);

        if($transaction['status']!='FAILED'){
            $payment = Payment::whereReference(request('pesapal_merchant_reference'))->first();
            $payment_id=$payment['id'];
            $orders->user_id=session('user_id');
            $orders->order_amount=session('payment_total');
            $orders->payment_id=$payment_id;
            $orders->order_status='PROCESSING';
            if($orders->save()){
                $order_id=$orders->order_id;
                foreach(session('delivery') as $item){
                    $delivery->town=$item['town'];
                    $delivery->address=$item['address'];
                    $delivery->order_id=$order_id;
                    $delivery->delivery_status='PENDING';
                    $delivery->save();
                }
                foreach(session('cart') as $item){
                    $orderdetails->order_id=$order_id;
                    $orderdetails->product_id=$item['product_ID'];
                    $orderdetails->product_price=$item['price'];
                    $orderdetails->order_quantity=$item['Quantity'];
                    $orderdetails->order_subtotal=$item['subtotal'];

                    $orderdetails->save();

                    $products= $product->where('product_id',$item['product_ID'])->first();
                    $prodid=$item['product_ID'];
                    $currentquan=$products['stock_available'];
                    $reduce=$item['Quantity'];
                    $newquan=intval($currentquan)-intval($reduce);
                    $edprod=Product::find($prodid);
                    $edprod->stock_available=$newquan;
                    $edprod->update();
                }
            }
            session()->forget('cart');
            session()->forget('delivery');
            session()->forget('payment_total');

            return redirect('home')->with('status',$transaction['status']);
        }
        else{
            return redirect('home')->with('status',$transaction['status']);
        }
        
    }
}