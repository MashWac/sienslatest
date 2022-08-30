@extends('layouts.user')
@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://cdn-icons-png.flaticon.com/512/1057/1057231.png?w=360"><span class="font-weight-bold"> {{$data['user']->firstname}}  {{$data['user']->surname}}  </span><span class="text-black-50"> {{$data['user']->email}} </span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Your profile</h4>
                </div>
                <form method="post" action="updateaccount">
                    @csrf
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" name="firstname" placeholder="First Name" value="{{$data['user']->firstname}}"></div>
                    <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" value="{{$data['user']->surname}}" name="surname" placeholder="Surname"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" name="email" placeholder="Email" value="{{$data['user']->email}}"></div>
                    <div class="col-md-12"><label class="labels">Country</label><input type="text" class="form-control" placeholder="Country" name="country" value="{{$data['user']->country}}" list="country_list">                                 <datalist id="country_list">
                                    @foreach($data['countries'] as $item)
                                    <option value="{{$item->name}}">
                                    @endforeach

                                    
                                </datalist></div>
                    <div class="col-md-12"><label class="labels">Phone Number</label><input type="number" class="form-control" name="phone" placeholder="Phone" value="{{$data['user']->telephone}}"></div>
                    <div class="col-md-12"><label class="labels">Password</label><input type="password" class="form-control" placeholder="Password" value=""></div>
                    <div class="col-md-12"><label class="labels">Confirm Password</label><input type="text" class="form-control" name="confirmpassword" placeholder="Confirm Password" value=""></div>
                    <div class="col-md-12"><label class="labels">Last Update</label><input readonly type="datetime-local" class="form-control" placeholder="enter address line 2" value="{{$data['user']->updated_at}}"></div>
                </div>
                    <button type="submit" class="btn btn-warning "id="btnpurch" style="color:white;">Update Profile</button>
                    </form>
            </div>
        </div>
    </div>
</div>
<div class="card">
        <div class="card-header text-center">
            <h2>Your orders</h2>
        </div>
        <div class="card-body">
            <div class="Accordion" style="margin:3%;">
            @foreach($data['orders'] as $item)
            <div class=Accorcionitem id="option{{$item->order_id}}">

                    <a class="accordionlink" href="{{'#option'.$item->order_id}}"><p>#:{{$item->order_id}}</p><br>  
                    <p>Amount:{{$item->order_amount}}KSH</p><br>
                    <p>Date:{{$item->updated_at}}</p>
                    <ion-icon class="ion-icon" name="add"></ion-icon>
                    <ion-icon class="ion-icon" name="remove"></ion-icon>
                    </a>
                    <div class="answer">
                        <div class="card text-center">
                            <div class="card-header">
                                Order Details
                            </div>
                            <div class="card-body">
                            <table class="table table-stripped table-hover" id="ticketstable">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['orderdets'] as $things)
                                        @if($things['order_id']==$item['order_id'])
                                        <tr>
                                            <td>{{$things->product_name}}</td>
                                            <td>{{$things->order_quantity}}</td>
                                            <td>{{$things->product_price}}</td>
                                        </tr>
                                        @endif
                                    @endforeach

                                    <!--stae-->
                                </tbody>
                            </table>
                                <a href="{{url('viewreceipt/'.$item->order_id)}}" class="btn btn-primary"> View Invoice</a>
                            </div>
                            <div class="card-footer text-muted">
                                2 days ago
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="text-center d-flex justify-content-center">
            {{ $data['orders']->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection  
