@extends('layouts.authtemplate')

@section('content')

        <div id="productshome" class="py-4">
            <h2 id="productttitleend">OUR PRODUCTS</h2>
            <hr>
            <div id="filterbar">
                <ul id="filters">
                <li class="filteropts"><a href="{{url('productspreview')}}" >All</a></li>
                    @foreach($data['categories'] as $things)
                        <li class="filteropts"><a href="{{url('filterbycateprev/'.$things->category_id)}}" >{{$things->category_name}}</a></li>
                    @endforeach

                    <li class="filteropts">
                        <div class="dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                More Categories
                            </a>

                            <ul class="dropdown-menu dropping-menu" aria-labelledby="dropdownMenuLink">
                                @foreach($data['categorieslist'] as $things)
                                    <li><a class="dropdown-item" href="{{url('filterbycateprev/'.$things->category_id)}}" >{{$things->category_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>



                    <li class="filteropts">  
                        <form action="{{url('searchproductprev')}}" method="POST">
                            @csrf
                            <div class="search-box">
                                <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                                <input type="text" name="searchfield" class="input-search" placeholder="Search Product...">
                            </div>
                        </form>

                        
                    </li>
                    <li class="filteropts">
                        <div class="dropdown">
                            <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink12" data-bs-toggle="dropdown" aria-expanded="false">
                                <ion-icon name="funnel"></ion-icon>
                            </a>

                            <ul class="dropdown-menu dropping-menu" aria-labelledby="dropdownMenuLink12">
                                <li>
                                    <form method="POST" class="dropdown-item" action="{{url('filterbysortprev')}}">
                                        @csrf
                                        <input type="hidden" value="dateasc" name="order">
                                        <input type="hidden" value="{{$data['cateid']}}" name="cateid">
                                        <button class="dropdown-item" type="submit" >Date Added Ascending</button>
                                    </form>
                                </li>
                                <li>
                                    <form method="POST" class="dropdown-item" action="{{url('filterbysortprev')}}">
                                        @csrf
                                        <input type="hidden" value="datedesc" name="order">
                                        <input type="hidden" value="{{$data['cateid']}}" name="cateid">
                                        <button class="dropdown-item" type="submit" >Date Added Descending</button>
                                    </form>
                                </li>
                                <li>
                                    <form method="POST" class="dropdown-item" action="{{url('filterbysortprev')}}">
                                        @csrf
                                        <input type="hidden" value="priceasc" name="order">
                                        <input type="hidden" value="{{$data['cateid']}}" name="cateid">
                                        <button class="dropdown-item" type="submit" >Price Acscending</button>
                                    </form>
                                </li>
                                <li>
                                    <form method="POST" class="dropdown-item" action="{{url('filterbysortprev')}}">
                                        @csrf
                                        <input type="hidden" value="pricedesc" name="order">
                                        <input type="hidden" value="{{$data['cateid']}}" name="cateid">
                                        <button class="dropdown-item" type="submit" >Price Descending</button>
                                    </form>
                                </li>
                                <li>
                                    <form method="POST" class="dropdown-item" action="{{url('filterbysortprev')}}">
                                        @csrf
                                        <input type="hidden" value="nameasc" name="order">
                                        <input type="hidden" value="{{$data['cateid']}}" name="cateid">
                                        <button class="dropdown-item" type="submit" >Product Name A-Z</button>
                                    </form>
                                </li>
                                <li>
                                    <form method="POST" class="dropdown-item" action="{{url('filterbysortprev')}}">
                                        @csrf
                                        <input type="hidden" value="namedesc" name="order">
                                        <input type="hidden" value="{{$data['cateid']}}" name="cateid">
                                        <button class="dropdown-item" type="submit" >Product Name Z-A</button>
                                    </form>
                                </li>

                            </ul>
                        </div>
                    </li>
                </ul>     
            </div>



            <div class="prodsectionprodpage container-fluid">
                    <div class="row justify-content-center">
                    @foreach($data['products'] as $item)
                            <div class="card productsprofile" style="width: 18rem;  height:520px" >
                                <img src="{{ $item['product_image']}}"  class="card-img-top" height="300px"alt="...">
                                <div class="card-body proddetails">

                                    <h5 class="card-title producttitle">{{$item->product_name}}</h5>
                                    
                                    <div class="detailssection" style="">
                                        @if($data['user_role']==3)
                                            <h6 class="text-center pricetext"style="margin-top: 30%;">{{($item->unit_price)-(($item->unit_price)*($data['discount']))}} KSH<h6>
                                        @else
                                            <h6 class="text-center pricetext"style="margin-top: 30%;">{{$item->unit_price}} KSH<h6>
                                        @endif
                                        <div class="prodbuttons">
                                            <a href="{{url('viewproductprev/'.$item->product_id)}}" class="btn btn-warning "id="btnpurch" style="color:white;"> View Details</a>
                                            <a href="{{url('addtocart/'.$item->product_id)}}" class="btn btn-primary"> Add To Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>

        </div>
        <div class="text-center d-flex justify-content-center">
                {{ $data['products']->links('pagination::bootstrap-4') }}
        </div>
@endsection  
