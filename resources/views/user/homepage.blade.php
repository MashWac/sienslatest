
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
                    <img src="/staticimg/home1.png" class="d-block w-100" height="20%" alt="...">
                    <div class="carousel-caption">
                        <p class="proddesc">HEAL AND RELIEVE BODY ACHES AND FATIGUE.</p>
                        <a href="{{url('prodpage')}}" class="btn btn-warning " style="color:white;"> View Products</a>
                    </div>
                    </div>
                    <div class="carousel-item">
                    <img src="/staticimg/home3.png" class="d-block w-100" height="20%"alt="...">
                    <div class="carousel-caption" id="on-de-right" >
                        <p class="proddesc">REJUVINATE AND ENHANCE VITAL MINERALS.</p>
                        <a href="{{url('prodpage')}}" class="btn btn-warning " style="color:white;"> View Product</a>
                    </div>
                    </div>
                    <div class="carousel-item">
                    <img src="/staticimg/home5.png"  class="d-block w-100" height="20%"alt="...">
                    <div class="carousel-caption" id="on-de-right">
                        <p class="proddesc">GREAT NATURAL DETOXIFICATION.</p>
                        <a href="{{url('prodpage')}}" class="btn btn-warning " style="color:white;"> View Products</a>

                    </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="firstcont">
            <div>
                <h1 id="welcome">WELCOME TO <span id="companyname">SIENS&nbsp;&nbsp;<span class="logowel"><img src="/staticimg/fav.png" class="img-fluid" style="width:15% ; height:50%;"></span> AFRICA</span></h1>
                <p id="researc"> A platform of well researched food supplements.</p>
                <h4>OUR VALUES</h4>
            </div>
            <div id="ourvalues">
                
                <div class="valuez">
                    <div class="imgpart">
                        <img src="/staticimg/fitness.png" class="img-fluid" style="width:50% ;  height:50%;">
                    </div>
                    <div class="valdesc">
                        <p>FITNESS</p>
                    </div>
                </div>
                <div class="valuez">
                    <div class="imgpart">
                    <img src="/staticimg/health.png" class="img-fluid"  style="width:50% ; height:50%;">
                    </div>
                    <div class="valdesc">
                        <p>GOOD HEALTH</p>
                    </div>
                </div>
                <div class="valuez">
                    <div class="imgpart">
                    <img src="/staticimg/strength.png" class="img-fluid"  style="width:50% ; height:50%;">
                    </div>
                    <div class="valdesc">
                        <p>STRENGTH</p>
                    </div>
                </div>
                <div class="valuez">
                    <div class="imgpart">
                    <img src="/staticimg/organic.png" class="img-fluid"  style="width:50% ; height:50%;">
                    </div>
                    <div class="valdesc">
                        <p>NATURAL</p>
                    </div>
                </div>
                <div class="valuez">
                    <div class="imgpart">
                    <img src="/staticimg/beauty.png" class="img-fluid"  style="width:50% ; height:50%;" >
                    </div>
                    <div class="valdesc">
                        <p>BEAUTY</p>
                    </div>
                </div>

            </div>
            
        </div>
        <div id="productshome">
            <h2 id="productttitleend">OUR PRODUCTS</h2>
            <hr>
            <div id="supplements">
                <div class="card productsprofile" style="width: 18rem;">
                    <img src="/staticimg/products/supplements/garlicoil.jpg"  class="card-img-top" height="10%" width="200px" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Siens Garlic Oil</h5>
                        <div id=buttonprodhome>
                            <a href="#" class="btn btn-primary">Add To Cart</a>
                            <a href="#" class="btn btn-warning " style="color:white;"> Purchase</a>
                        </div>
                    </div>
                </div>
                <div class="card productsprofile" style="width: 18rem;">
                    <img src="/staticimg/products/supplements/omega.jpg" class="card-img-top" height="10%" width="200px" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Siens Omega 3</h5>
                        <div id=buttonprodhome>
                            <a href="#" class="btn btn-primary">Add To Cart</a>
                            <a href="#" class="btn btn-warning " style="color:white;"> Purchase</a>
                        </div>
                    </div>
                </div>
                <div class="card productsprofile" style="width: 18rem;">
                    <img src="/staticimg/products/supplements/primose.jpg" class="card-img-top" height="10%" width="200px" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Siens Evening Primose</h5>
                        <div id=buttonprodhome>
                            <a href="#" class="btn btn-primary">Add To Cart</a>
                            <a href="#" class="btn btn-warning " style="color:white;"> Purchase</a>
                        </div>
                    </div>
                </div>
                <div class="card productsprofile" style="width: 11rem; margin-top:15%;">
                    <div>
                        <h3 class="callactmore">VIEW MORE</h3>
                    </div>
                    <div>
                    <ion-icon id="arrowcall" name="arrow-round-forward"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection