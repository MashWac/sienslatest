@extends('layouts.admin')

@section('content')
<div class="card">
        <div class="card-header">
            <div class="card text-center">
            <div class="card-header">
                {{$data['order']->firstname}}  {{$data['order']->surname}}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$data['order']->town}}, {{$data['order']->address}}</h5>
                <h5 class="card-title">{{$data['order']->order_amount}}</h5>
                <a href="{{url('complete-order/'.$data['order']->order_id)}}" class="btn btn-primary">Mark Delivered</a>
            </div>
            <div class="card-footer text-muted">
                {{$data['order']->created_at}}
            </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                <h3 >List Of Processing Orders</h3>
                <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['orderdets'] as $item)
                    <tr>
                        <td>{{$item->product_name}}</td>
                        <td>{{$item->order_quantity}}</td>
                        <td>{{$item->product_price}}</td>
                        <td>{{$item->subtotal}}</td>
                    </tr>
                    @endforeach

                </tbody>
                </table>
          
        </div>
    </div>
@endsection