
@extends('layouts.user')
@section('content')
        <div id="courasel">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="/staticimg/home1.png" class="d-block w-100 bannerimg" height="20%" alt="...">
                    <div class="carousel-caption">
                        <p class="proddesc">WELCOME TO OUR HEALTHY LIFESTYLE PLATFORM.</p>
                        
                        <div class="d-none d-lg-block">
                            <a href="{{url('prodpage')}}" class="btn btn-warning  " style="color:white;width:fit-content;"> View Products</a>
                        </div>
                    </div>
                    </div>
                    <div class="carousel-item">
                    <img src="/staticimg/home3.png" class="d-block w-100 bannerimg" height="20%"alt="...">
                        <div class="carousel-caption" id="on-de-right" >
                            <p class="proddesc">GREAT NATURAL DETOXIFIER.</p>
                            <div class="d-none d-lg-block">
                                <a href="{{url('prodpage')}}" class="btn btn-warning right_button " style="color:white;width:fit-content;"> View Products</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                    <img src="/staticimg/home5.png"  class="d-block d-sm-none d-md-block  w-100 bannerimg" height="20%"alt="...">
                        <div class="carousel-caption" id="on-de-right">
                            <p class="proddesc" style="margin-left: 30%;">REJUVINATE AND ENHANCE VITAL MINERALS AND OIL.</p>
                            <div class="d-none d-lg-block">
                                <a href="{{url('prodpage')}}" class="btn btn-warning  right_button" style="color:white;width:fit-content;"> View Products</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="firstcont">
            <div>
                <h1 id="welcome">WELCOME TO <span id="companyname">SIENS&nbsp;&nbsp;<span class="logowel"><img src="/staticimg/fav.png" height="80px"></span> AFRICA</span></h1>
                <p id="researc"> A platform of well researched food supplements.</p>
                <h4>OUR VALUES</h4>
            </div>
            <div id="ourvalues">
                
                <div class="valuez">
                    <div class="imgpart">
                        <img src="/staticimg/fitness.png" height="100px">
                    </div>
                    <div class="valdesc">
                        <p>FITNESS</p>
                    </div>
                </div>
                <div class="valuez">
                    <div class="imgpart">
                    <img src="/staticimg/health.png" height="100px" >
                    </div>
                    <div class="valdesc">
                        <p>GOOD HEALTH</p>
                    </div>
                </div>
                <div class="valuez">
                    <div class="imgpart">
                    <img src="/staticimg/strength.png" height="100px" >
                    </div>
                    <div class="valdesc">
                        <p>STRENGTH</p>
                    </div>
                </div>
                <div class="valuez">
                    <div class="imgpart">
                    <img src="/staticimg/organic.png" height="100px" >
                    </div>
                    <div class="valdesc">
                        <p>NATURAL</p>
                    </div>
                </div>
                <div class="valuez">
                    <div class="imgpart">
                    <img src="/staticimg/beauty.png" height="100px" >
                    </div>
                    <div class="valdesc">
                        <p>BEAUTY</p>
                    </div>
                </div>

            </div>
            
        </div>
        <div id="productshome">
            <h2 id="productttitleend">OUR PRODUCTS</h2>
            <div class="section_divider_home"> 
                <div class="section_divider_line"> </div>
            </div>
            <div id="supplements">
                @foreach($data['topprods'] as $item)
                <div class="card productsprofile" style="width: 16rem;  height:350px" >
                    <img src="{{ $item['product_image']}}"  class="card-img-top" height="180px"alt="...">
                    <div class="card-body proddetails text-center">

                        <h5 class="card-title producttitle" >{{$item->product_name}}</h5>
                        
                        <div class="detailssection" style="margin-top:10px">
                            @if($data['user_role']==3)
                                <h6 class="text-center pricetext"style="margin-top: 5px;">{{($item->unit_price)-(($item->unit_price)*($data['discount']))}} KSH<h6>
                            @else
                                <h6 class="text-center pricetext"style="margin-top: 5px;">{{$item->unit_price}} KSH<h6>
                            @endif
                            <div class="prodbuttons">
                                <a href="{{url('viewproduct/'.$item->product_id)}}" class="btn btn-warning btn-sm "id="btnpurch" style="color:white;"> View Details</a>
                                <a href="{{url('addtocart/'.$item->product_id)}}" class="btn btn-primary btn-sm"> Add To Cart</a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                <a href="{{url('prodpage')}}">
                <button class="btn btn-primary productsprofile" id="view_more_btn" style="width: 11rem; margin-top:15%;">
                
                    <div>
                        <h3 class="callactmore" style="color: whitesmoke;">VIEW MORE</h3>
                    </div>
                    <div>
                    <ion-icon id="arrowcall" name="arrow-round-forward" style="color: whitesmoke;"></ion-icon>
                    </div>
                </button>
                </a>
            </div>
        </div>
    </div>
@endsection