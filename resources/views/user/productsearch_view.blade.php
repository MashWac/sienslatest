<div class="products_container" style="width: 100%;">
    @foreach($data['products'] as $item)
        <div class="card productsprofile" style="width: 16rem;  height:350px" >
            <img src="{{ $item['product_image']}}"  class="card-img-top" height="180px"alt="...">
            <div class="card-body proddetails text-center">

                <h5 class="card-title producttitle">{{$item->product_name}}</h5>
                
                <div class="detailssection" style="margin-top:10px">
                    @if($data['user_role']==3)
                        <h6 class="text-center pricetext"style="margin-top: 5px;">{{($item->unit_price)-(($item->unit_price)*($data['discount']))}} KSH<h6>
                    @else
                        <h6 class="text-center pricetext"style="margin-top: 5px;">{{$item->unit_price}} KSH<h6>
                    @endif
                    @if($data['user_role']==NULL)
                    <div class="prodbuttons">
                        <a href="{{url('viewproductprev/'.$item->product_id)}}" class="btn btn-warning btn-sm "id="btnpurch" style="color:white;"> View Details</a>
                        <a href="{{url('addtocart/'.$item->product_id)}}" class="btn btn-primary btn-sm"> Add To Cart</a>
                    </div>
                    @else
                    <div class="prodbuttons">
                        <a href="{{url('viewproduct/'.$item->product_id)}}" class="btn btn-warning btn-sm "id="btnpurch" style="color:white;"> View Details</a>
                        <a href="{{url('addtocart/'.$item->product_id)}}" class="btn btn-primary btn-sm"> Add To Cart</a>
                    </div>

                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="text-center d-flex justify-content-center">
        {{ $data['products']->links('pagination::bootstrap-4') }}
</div>