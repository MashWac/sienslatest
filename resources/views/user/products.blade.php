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
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item" type="button">Action</button></li>
                                <li><button class="dropdown-item" type="button">Another action</button></li>
                                <li><button class="dropdown-item" type="button">Something else here</button></li>
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



            <div class="card-body">
                <div class="row gy-3 "> 
                    @foreach($data['products'] as $item)
                        <div class="col">
                            <div class="card productsprofile h-100 " style="width: 16rem; " >
                                <img src="{{ $item['product_image']}}"  class="card-img-top" height="300px"alt="...">
                                <div class="card-body details" style="position: relative; height: 150px; ">

                                    <h5 class="card-title">{{$item->product_name}}</h5>
                                    
                                    <div class="d-grid gap-2 d-md-block" style="position: absolute; bottom: 10%; height: 150px;">
                                        <h6 class="text-center pricetext"style="margin-top: 30%;">{{$item->unit_price}} KSH<h6>
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
