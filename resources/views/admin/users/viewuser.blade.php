
@extends('layouts.admin')
@section('content')
<div class="card">
        <div class="card-header">
            <div class="card text-center">
            <div class="card-header">
                Username: {{$data['user']->firstname}}  {{$data['user']->surname}}
            </div>
            <div class="card-body">
                <h5 class="card-title">Email: {{$data['user']->email}}</h5>
                <h5 class="card-title">Phone: {{$data['user']->telephone}}</h5>
                <a href="{{url('users')}}" class="btn btn-primary">Back</a>
            </div>
            <div class="card-footer text-muted">
                Date of creation: {{$data['user']->created_at}}
            </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                <h3 >List Of Orders</h3>
                <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>order_amount</th>
                        <th>Payment</th>
                        <th>Order Status</th>
                        <th>Order date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['orders'] as $item)
                    <tr>
                        <td>{{$item->order_id}}</td>
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
                    @endforeach
                </tbody>
                </table>
          
        </div>
        <div class="text-center d-flex justify-content-center">
            {{ $data['orders']->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection