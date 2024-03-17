<div class="floating_side_bar">
    <div class="container">
        <div>
            <h4 style="vertical-align: middle;">Product Filter </h4>
        </div>
        <div class="floating_side_bar_content" >
            <form class="indepth_page_filter" method="GET" id="indepth_page_filter">
                <div class="col-md-12">
                    <label for="datalist_product" class="form-label">Search Product:</label>
                    <input class="form-control product_list_search" list="product_datalist" id="datalist_product" name="search_product" placeholder="Type to search...">
                    <datalist id="product_datalist" class="product_datalist">

                    </datalist>
                </div>
                <div class="col-md-12">
                    <label for="disease_type" class="form-label">Ailment:</label>
                    <select class="form-select ailment_select2" name="ailment">
                        <option value="all">Select an Ailment</option>
                        @foreach($data['diseases'] as $item)
                        <option value="{{$item->disease_name}}">{{$item->disease_name}}</option>
                        @endforeach
                    </select>    
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Order By:</label>
                    <select class="form-select" name="product_order">
                        <option value="datedesc">Date Added Descending</option>
                        <option value="dateasc">Date Added Ascending</option>
                        <option value="pricedesc">Price Descending</option>
                        <option value="priceasc">Price Ascending</option>
                        <option value="nameasc">Product Name A-Z</option>
                        <option value="namedesc">Product Name Z-A</option>
                    </select>
                </div>

                <div  class="col-md-12">
                    <label for="inputAddress2" class="form-label">Price Range</label>
                    <div class="range_container">
                        <div class="sliders_control">
                            <input id="fromSlider" type="range" value="0" min="0" max="{{$data['product_max_price']}}"/>
                            <input id="toSlider" type="range" value="{{$data['product_max_price']}}" min="0" max="{{$data['product_max_price']}}"/>
                        </div>
                        <div class="form_control">
                            <div class="form_control_container">
                                <input class="form_control_container__time__input" style="width:80px;" name="minimum_price" type="number" id="fromInput" value="0" min="0" max="{{$data['product_max_price']}}"/>
                            </div>
                            <div class="form_control_container">
                                <input class="form_control_container__time__input" style="width:80px;" name="max_price" type="number" id="toInput" value="{{$data['product_max_price']}}" min="0" max="{{$data['product_max_price']}}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="col-md-12">
                    <label for="inputAddress" class="form-label">In Stock</label>
                    <input class="form-check-input" type="checkbox" name="in_stock" value="in_stock" id="flexCheckChecked" checked>
                </div>

                <div class="col-md-12">
                    <label for="inputCity" class="form-label">Discounted</label>
                    <input class="form-check-input" type="checkbox" name="discounted" value="discounted" id="flexCheckChecked" checked>
                </div>
                <div  class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <button class="btn  btn-warning btn_reset_filters" style="margin-top: 10px;">Reset Filters</button>
        </div>
    </div>

</div>