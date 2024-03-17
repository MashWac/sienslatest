@extends('layouts.admin')
@section('content')
<h3>Welcome To Your DashBoard</h3>

<div class="container-fluid">
    <div class="row">
        <div class="card text-center quickdata" style="width: 17rem;">
            <h4 class="card-title">
                Today's Visitors
            </h4>
            <div class="card-body">
                <h2 class="card-title">{{$data['countvisitors']}}</h2>
            </div>
        </div>
        <div class="card text-center quickdata" style="width: 17rem;">
            <h4 class="card-title">
                New Messages
            </h4>
            <div class="card-body">
                <h2 class="card-title">{{$data['countmessages']}}</h2>
                <a href="{{url('messages')}}" class="btn btn-primary">View Messages</a>
            </div>
        </div>
        <div class="card text-center quickdata" style="width: 17rem;">
            <h4 class="card-title">
                Pending Orders
            </h4>
            <div class="card-body">
                <h2 class="card-title">{{$data['countorders']}} </h2>

            </div>
        </div>

    </div>

</div>
<div class="card">
    <h4> Total Sales</h4>
</div>
<div class="card">
    <h4>Top Products</h4>
</div>
<div class="card">
    <h4> Visits Traffic</h4>
</div>



@endsection