@extends('layouts.user')
@section('content')

<div class="card py-4">
    <div class="card mb-3" style="max-width:90%;">
        <div class="row g-0">
        
            <div class="col-md-4">
            <img src="{{ $product['product_image']}}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body text-center py-5">
                <h3 id="artcardmessage" class="card-title">Product Name: {{$product->product_name}}</h3>
                    <p class="card-text" id="artcardmessage">Description: {{$product->product_description}}</p>
                    <p class="card-text pricetext">Price: {{$product->unit_price}} KSH</p>
                    <a href="{{url('addtocart/'.$product->product_id)}}" class="btn btn-primary">Add To Cart</a>
                </div>
            </div>
        
        </div>
    </div>
</div>
@endsection  
