@extends('layouts.user')
@section('content')

        <div id="productshome" class="py-4">
            <h2 id="productttitleend">OUR PRODUCTS</h2>
            <hr>
            <div id="filterbar">
                <ul id="filters">
                <li class="filteropts"><a href="{{url('prodpage')}}" >All</a></li>
                    @foreach($data['categories'] as $things)
                        <li class="filteropts"><a href="{{url('filterbycate/'.$things->category_id)}}" >{{$things->category_name}}</a></li>
                    @endforeach

                    <li class="filteropts">
                        <div class="dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                More Categories
                            </a>

                            <ul class="dropdown-menu dropping-menu" aria-labelledby="dropdownMenuLink">
                                @foreach($data['categorieslist'] as $things)
                                    <li><a class="dropdown-item" href="{{url('filterbycate/'.$things->category_id)}}" >{{$things->category_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>



                    <li class="filteropts">  <div class="search-box">
                        <button class="btn-search"><i class="fas fa-search"></i></button>
                        <input type="text" class="input-search" placeholder="Search Product...">
                        </div>
                    </li>

                    <li class="filteropts"><ion-icon name="funnel"></ion-icon></li>
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
                                        <h6 class="text-center pricetext">{{($item->unit_price)*($data['discount'])}} KSH<h6>
                                        <div class="prodbuttons">
                                            <a href="{{url('viewproduct/'.$item->product_id)}}" class="btn btn-warning "id="btnpurch" style="color:white;"> View Details</a>
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
