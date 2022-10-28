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
                        <div class="container">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Click on Me
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>


                    <li class="filteropts">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Dropdown button</button>                       
                        <div class="dropdown-menu pre-scrollable" aria-labelledby="dropdownMenuButton">                                                           
                        <a class="dropdown-item" href="#">Foo</a>                                  
                        <a class="dropdown-item" href="#">Thing</a>                          
                        <a class="dropdown-item" href="#">Something</a>
                        <a class="dropdown-item" href="#">Dudes</a>
                        <a class="dropdown-item" href="#">Birds</a>
                        <a class="dropdown-item" href="#">Nikes</a>
                        <a class="dropdown-item" href="#">Marsh mellows</a>
                        <a class="dropdown-item" href="#">Apples</a>
                        <a class="dropdown-item" href="#">Dingles</a>
                        <a class="dropdown-item" href="#">Berries</a>
                        <a class="dropdown-item" href="#">What not</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>                     
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
