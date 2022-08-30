@extends('layouts.user')
@section('content')
<div>
        <div class="card"  id='invoice'>
            <div class="card-header p-4">
                    <div id="aboutlogo"> 
                        <img src="/staticimg/sienslogo2.png/" class="pagelogo" alt="logo" height="30%" width="40%">
                    </div>      
                    <div class="float-right"> <h3 class="mb-0">Invoice: #Siens22{{$data['order']->order_id}}</h3>
                        Date of Purchase: {{$data['order']->created_at}}
                    </div>
            </div>
            <div class="card-body" >
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h5 class="mb-3">From:</h5>
                        <h3 class="text-dark mb-1">Siens Africa</h3>
                        <div>VICTORY PLAZA 3RD FLOOR, Thika.</div>
                        <div>Email: siens@email.com</div>
                        <div>Nairobi: (+254)716615207.
                        Thika: (+254)728010172, (+254)705055983.</div>
                    </div>
                    <div class="col-sm-6 ">
                        <h5 class="mb-3">To:</h5>
                        <h3 class="text-dark mb-1">{{$data['user']->firstname}}  {{$data['user']->surname}}</h3>
                        <div>Email: {{$data['user']->email}}</div>
                        <div>Phone:{{$data['user']->telephone}}</div>
                    </div>
                </div>
                <div class="table-responsive-sm" >
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th class="right">Price</th>
                                <th class="center">Qty</th>
                                <th class="right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['orderdets'] as $things)
                                <tr>
                                    <td>{{$things->product_name}}</td>
                                    <td>{{$things->product_price}}</td>
                                    <td>{{$things->order_quantity}}</td>
                                    <td>{{$things->order_subtotal}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                    <tbody>
                    <tr>
                    <td class="left">
                    <strong class="text-dark">Total</strong>
                    </td>
                    <td class="right">
                    <strong class="text-dark">{{$data['order']->order_amount}} KES
                    </strong>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
         
        </div>
         <div class="card-footer bg-white">
            <p class="mb-0"><button class="btn btn-primary" id="downloadbtn"> Download Invoice</button>
            </p>
        </div>
</div>
@endsection  
