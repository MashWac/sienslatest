@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Orders Page</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                <h3 >List Of Pending Orders</h3>
                <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Client</th>
                        <th>order_amount</th>
                        <th>Payment</th>
                        <th>Order Status</th>
                        <th>Order date</th>
                        <th>Last updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['users'] as $item)
                    <tr>
                        <td>{{$item->firstname}}</td>
                        <td>{{$item->surname}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->role_name}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>
                            <a href="{{url('view-user/'.$item->user_id)}}">
                                <button type="submit" class="btn btn-success">View</button>
                            </a>
                            <a href="{{url('edit-user/'.$item->user_id)}}">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </a>
                            <a href="{{url('delete-user/'.$item->user_id)}}">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                            
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                </table>
          
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
                        <th>Payment</th>
                        <th>Order Status</th>
                        <th>Order date</th>
                        <th>Last updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['users'] as $item)
                    <tr>
                        <td>{{$item->firstname}}</td>
                        <td>{{$item->surname}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->role_name}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>
                            <a href="{{url('view-user/'.$item->user_id)}}">
                                <button type="submit" class="btn btn-success">View</button>
                            </a>
                            <a href="{{url('edit-user/'.$item->user_id)}}">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </a>
                            <a href="{{url('delete-user/'.$item->user_id)}}">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                            
                        </td>
                    </tr>
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
                        <th>Last updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['users'] as $item)
                    <tr>
                        <td>{{$item->firstname}}</td>
                        <td>{{$item->surname}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->role_name}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>
                            <a href="{{url('view-user/'.$item->user_id)}}">
                                <button type="submit" class="btn btn-success">View</button>
                            </a>
                            <a href="{{url('edit-user/'.$item->user_id)}}">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </a>
                            <a href="{{url('delete-user/'.$item->user_id)}}">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                            
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                </table>
          
        </div>
    </div>
@endsection