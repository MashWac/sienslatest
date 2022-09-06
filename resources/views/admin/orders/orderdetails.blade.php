@extends('layouts.admin')

@section('content')
<div class="card">
    @foreach($data['order'] as $things)
        <div class="card-header">
            <div class="card text-center">
            <div class="card-header">
                {{$things->firstname}}  {{$things->surname}}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$things->town}}, {{$things->address}}</h5>
                <h5 class="card-title">{{$things->order_amount}}</h5>
                <a href="{{url('complete-order/'.$things->order_id)}}" class="btn btn-primary">Mark Delivered</a>
            </div>
            <div class="card-footer text-muted">
                {{$things->created_at}}
            </div>
            </div>
        </div>
        @endforeach
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