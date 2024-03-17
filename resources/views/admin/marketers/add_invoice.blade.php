@extends('layouts.admin')

@section('content')
    @if($data['formtype']=='add')
    <div class="card">
        <div class="card-header">
            <h4>Add Invoice</h4>
        </div>
        <div class="card-body">
            <form action="{{url('insert-invoice')}}" method="POST" id="insert_invoice_form">
                @csrf 
                <div class="row">
                    <div class="col-md-6">
                        <label for="invoice_number" class="col-md-4 col-form-label text-md-end">Invoice Number:</label>
                        <input id="invoice_number" type="number" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="{{ old('invoice_number') }}" autocomplete="invoice_number" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('invoice_number')
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-6">
                        <label for="promoters" class="form-label">Search Promoter:</label>
                        <input class="form-control promoter_list_search" list="promoters_datalist" name="promoters"  id="promoters" placeholder="Type to search...">
                        <datalist id="promoters_datalist">
            
                        </datalist>
                    </div>
                    <div class="col-md-6">
                        <label for="invoicing_date" class="col-md-4 col-form-label text-md-end">{{ __('Invoicing Date:') }}</label>
                        <input id="invoicing_date" type="date" class="form-control @error('invoicing_date') is-invalid @enderror" name="invoicing_date" value="{{ old('invoicing_date') }}" autocomplete="invoicing_date">
                        <span class="invalid-feedback" role="alert">
                        @error('invoicing_date')  
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <h4>Products</h4>
                        <div class="show_item">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Product Name:</label>
                                    <input class="form-control product_list_search" id="product_detail" list="product_datalist" name="products[]"  placeholder="Type to search...">
                                    <datalist id="product_datalist" class="product_datalist">
                                    </datalist>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Product Quantity:</label>
                                    <input type="number" class="form-control" name="quantities[]">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Add/Remove</label><br>
                                    <button class="btn btn-success add_item_btn">Add More</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="create_invoice_btn">Create Invoice</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-header">
            <h4>Edit Invoive</h4>
        </div>
        <div class="card-body">
            <form action="{{url('update-invoice')}}" method="POST" id="update_invoice_form">
                @csrf 
                <div class="row">
                    <input type="hidden" name="invoice_id" value="{{$data['invoice']->invoice_id}}">
                    <div class="col-md-6">
                        <label for="invoice_number" class="col-md-4 col-form-label text-md-end">Invoice Number:</label>
                        <input id="invoice_number" type="number" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="{{$data['invoice']->invoice_number}}" autocomplete="invoice_number" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('invoice_number')
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-6">
                        <label for="promoters" class="form-label">Search Promoter:</label>
                        <input class="form-control promoter_list_search" list="promoters_datalist" name="promoters" value="{{$data['invoice']->promoter_id}}"  id="promoters" placeholder="Type to search...">
                        <datalist id="promoters_datalist">
                
                        </datalist>
                    </div>
                    <div class="col-md-6">
                        <label for="invoicing_date" class="col-md-4 col-form-label text-md-end">{{ __('Invoicing Date:') }}</label>
                        <input id="invoicing_date" type="date" class="form-control @error('invoicing_date') is-invalid @enderror" name="invoicing_date" value="{{$data['invoice']->invoice_date}}" autocomplete="invoicing_date">
                        <span class="invalid-feedback" role="alert">
                        @error('invoicing_date')  
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <h4>Products</h4>
                        <div class="show_item">
                        @foreach($data['invoice']->combined_array as $things=>$values)  
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Product Name:</label>
                                    <input class="form-control product_list_search" id="product_detail" list="product_datalist" name="products[]"   value="{{$values['product_name']}}"  placeholder="Type to search...">
                                    <datalist id="product_datalist" class="product_datalist">
                                    </datalist>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Product Quantity:</label>
                                    <input type="number" class="form-control" value="{{$values['invoice_quantity']}}" name="quantities[]">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Add/Remove</label><br>
                                    <button class="btn btn-success add_item_btn">Add More</button>
                                    <button class="btn btn-danger remove_item_btn">Delete</button>

                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="create_invoice_btn">Create Invoice</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    // Event delegation to handle click event for dynamically added elements
    $(document).on("click", ".add_item_btn", function(e){
        e.preventDefault();
        var container = $(".show_item");
        // Change button class and text
        $(this).removeClass('btn-success add_item_btn').addClass('btn-danger remove_item_btn').text("Remove");
        container.append(`
            <div class="row">
                <div class="col-md-4">
                    <label for="">Product Name:</label>
                    <!-- Corrected class name -->
                    <input class="form-control product_list_search" list="product_datalist" name="products[]"  placeholder="Type to search...">
                    <datalist id="product_datalist" class="product_datalist">

                    </datalist>
                </div>
                <div class="col-md-4">
                    <label for="">Product Quantity:</label>
                    <input type="number" class="form-control" name="quantities[]">
                </div>
                <div class="col-md-4">
                    <label for="">Add/Remove</label><br>
                    <button class="btn btn-success add_item_btn">Add More</button>
                </div>
            </div>
        `);
    });

    // Event delegation to handle click event for dynamically added "Remove" buttons
    $(document).on("click", ".remove_item_btn", function(e){
        e.preventDefault();
        // Handle the removal of the item here
        $(this).closest('.row').remove(); // Remove the parent row
    });

    $(document).on("keyup", ".product_list_search", function(e){
        var query = $(this).val(); // Use $(this) to refer to the current input field
        console.log(query)
        if (query != ''){
            var productDatalist = $(this).closest('.col-md-4').find('.product_datalist');
            $.ajax({
                url: "{{url('autocompleteproductlist')}}",
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
});

</script>

<script>
    $(document).ready(function(){
        $(".promoter_list_search").keyup(function(){
            var query=$(".promoter_list_search").val();
            if(query !=''){
                console.log(query)
                $.ajax({
                    url:"{{url('autocompletepromoter')}}",
                    method:"GET",
                    data:{query:query},
                    success:function(data){
                        console.log(data)
                        $("#promoters_datalist").empty();
                        for(var i=0;i<data.length;i++)
                        {
                            $("#promoters_datalist").append("<option value='" + 
                            data[i].user_id + "'>"+data[i].firstname+" "+data[i].surname+ "</option>");
                        }
                    },
                    error:function(response){
                        console.log(response)
                    }
                })
            }
        });
    })
</script>
<script>
        $('#insert_invoice_form').submit(function(e){
            e.preventDefault()
            const redirect_url="{{url('marketers')}}"
            $.ajax({
                url:"{{url('insert_invoice')}}",
                type: "GET",
                data:$(this).serialize(),
                success:function(response){
                    swal(response.message);
                    setTimeout(function(){
                        window.location.href = redirect_url;
                    }, 3000)
                },error:function(response){

                    swal(response.message);
                } 
            })
        })
</script>
<script>
    $('#update_invoice_form').submit(function(e){
        e.preventDefault()
        const redirect_url="{{url('view_invoices')}}"
        $.ajax({
            url:"{{url('update_invoice')}}",
            type: "GET",
            data:$(this).serialize(),
            success:function(response){
                swal(response.message);
                setTimeout(function(){
                    window.location.href = redirect_url;
                }, 3000)
            },error:function(response){

                swal(response.message);
            } 
        })
    })
</script>

@endsection