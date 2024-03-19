@extends('layouts.authtemplate')

@section('content')

        <div id="productshome" class="py-4">
            <h2 id="productttitleend">OUR PRODUCTS</h2>
            <div style="width:100%; display:flex;align-items:center;justify-content:center;" >
            <div class="section_divider_div"></div>
            </div>
            <div id="filterbar">
                @include('user.floating_side_filters')
            </div>
            <div class="prodsectionprodpage container-fluid">
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
                                    <div class="prodbuttons">
                                        <a href="{{url('viewproductprev/'.$item->product_id)}}" class="btn btn-warning btn-sm "id="btnpurch" style="color:white;"> View Details</a>
                                        <a href="{{url('addtocart/'.$item->product_id)}}" class="btn btn-primary btn-sm"> Add To Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center d-flex justify-content-center">
                        {{ $data['products']->links('pagination::bootstrap-4') }}
                </div>
            </div>



        </div>
@endsection  
@section('scripts')
<script>
    $(document).ready(function() {
        $('.disease_type').select2();
    });
</script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: "{{$data['product_max_price']}}",
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  } );
  </script>
    <script>

    $('#indepth_page_filter').submit(function(e){
        e.preventDefault()
        $.ajax({
            url:"{{url('filter_products_registration')}}",
            type: "GET",
            data:$(this).serialize(),
            success: function (query) {
                $('.prodsectionprodpage').empty();
                $('.prodsectionprodpage').html(query);
            },error:function(response){
                swal("Sorry! we currently have no products that fit those attributes.");
            }            

        })
    })
  </script>
  <script>
        $(document).on("keyup", ".product_list_search", function(e){
        var query = $(this).val(); // Use $(this) to refer to the current input field
        console.log(query)
        if (query != ''){
            var productDatalist = $(this).closest('.col-md-4').find('.product_datalist');
            $.ajax({
                url: "{{url('autocompleteproductlist_registration')}}",
                method: "GET",
                data: {query: query},
                success: function(data){
                    console.log(data)
                    $('.product_datalist').empty();
                    for (var i = 0; i < data.length; i++){
                        $('.product_datalist').append("<option value='" + 
                        data[i].product_name + "'>" + data[i].product_name + "</option>");
                    }
                }
            });
        }
    });
  </script>
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).on('click','.pagination a', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        if (href.indexOf("filter_products_registration") !== -1) {
            $.ajax({
                url: href,
                type: "GET",
                success: function(query) {
                    $(this).parent('.page-item').addClass('active').siblings('.page-item').removeClass('active');
                    $('.prodsectionprodpage').empty();
                    $('.prodsectionprodpage').html(query);
                },
                error: function(xhr, status, error) {
                    alert("An error occurred. Please try again.");
                }
            });

        } else if (href.indexOf("productspreview") !== -1) {
            $(this).addClass('active').siblings('.page-item').removeClass('active');
            window.location.href = href;
        }
        console.log(href)

    });
</script>
@endsection

