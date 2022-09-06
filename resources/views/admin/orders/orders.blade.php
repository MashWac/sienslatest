@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Orders Page</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                <h3 >List Of Processing Orders</h3>
                <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Client</th>
                        <th>order_amount</th>
                        <th>Payment Method</th>
                        <th>Order Status</th>
                        <th>Order date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['orders'] as $item)
                    @if($item['order_status']=='PROCESSING')
                    <tr>
                        <td>{{$item->order_id}}</td>
                        <td>{{$item->firstname}} {{$item->surname}}</td>
                        <td>{{$item->order_amount}}</td>
                        <td>{{$item->payment_method}}</td>
                        <td>{{$item->order_status}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a href="{{url('view-orderdetails/'.$item->order_id)}}">
                                <button type="submit" class="btn btn-success">View</button>
                            </a>
                        </td>
                    </tr>
                    @endif
                    @endforeach

                </tbody>
                </table>
          
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                <h3 >List Of Completed Orders</h3>
                <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Client</th>
                        <th>order_amount</th>
                        <th>Payment</th>
                        <th>Order Status</th>
                        <th>Order date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['orders'] as $item)
                    @if($item['order_status']=='DELIVERED')
                    <tr>
                        <td>{{$item->order_id}}</td>
                        <td>{{$item->firstname}} {{$item->surname}}</td>
                        <td>{{$item->order_amount}}</td>
                        <td>{{$item->reference}}</td>
                        <td>{{$item->order_status}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a href="{{url('view-orderdetails/'.$item->order_id)}}">
                                <button type="submit" class="btn btn-success">View</button>
                            </a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
                </table>
          
        </div>
    </div>
@endsection