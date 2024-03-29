@extends('layouts.authtemplate')
@section('content')

<div class="card py-4" style="border: 0px;">
    <div class="card mb-3" style="max-width:90%;border:0px;">
        <div class="row g-0">
        
            <div class="col-md-4">
            <img src="{{ $data['product']->product_image}}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body text-center py-5">
                <h3 id="artcardmessage" class="card-title producttitle">Product Name: {{$data['product']->product_name}}</h3>
                    <p class="card-text" id="artcardmessage">Description: {!!$data['product']->product_description!!}</p>
                    @if($data['user_role']==3)
                    <p class="card-text pricetext">Price:{{($data['product']->unit_price)-(($data['product']->unit_price)*($data['discount']))}} KSH</p>
                    @else
                    <p class="card-text pricetext">Price:{{$data['product']->unit_price}} KSH</p>
                    @endif
                    <a href="{{url('addtocart/'.$data['product']->product_id)}}" class="btn btn-primary">Add To Cart</a>
                    <a href="{{url('productspreview')}}" class="btn btn-warning" style="color:white;">Back</a>
                </div>
            </div>
        
        </div>
    </div>
</div>
@endsection  
