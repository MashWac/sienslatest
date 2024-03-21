@extends('layouts.admin')
@section('content')
    @if($data['formtype']=='add')
    <div class="card">
        <div class="card-header">
            <h4>Add Receipt</h4>
        </div>
        <div class="card-body">
            <form action="{{url('insert-receipt')}}" method="POST" id="insert_receipt_form">
                @csrf 
                <div class="row">
                    <div class="col-md-6">
                        <label for="receipt_number" class="col-md-4 col-form-label text-md-end">Receipt Number:</label>
                        <input id="receipt_number" type="number" class="form-control @error('receipt_number') is-invalid @enderror" name="receipt_number" value="{{ old('receipt_number') }}" autocomplete="receipt_number" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('receipt_number')
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-6">
                        <label for="promoters" class="form-label">Search Promoter:</label>
                        <input class="form-control promoter_list_search" list="promoters_datalist" name="promoters" onfocusout="updateHiddenField(this)"  id="promoters" placeholder="Type to search...">
                        <input type="text" disabled id="promoter_name" value="">
                        <datalist id="promoters_datalist">
            
                        </datalist>
                    </div>
                    <div class="col-md-6">
                        <label for="receipting_date" class="col-md-4 col-form-label text-md-end">{{ __('receipting Date:') }}</label>
                        <input id="receipting_date" type="date" class="form-control @error('receipting_date') is-invalid @enderror" name="receipting_date" value="{{ old('receipting_date') }}" autocomplete="receipting_date">
                        <span class="invalid-feedback" role="alert">
                        @error('receipting_date')  
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <h4>Products</h4>
                        <div class="show_item">
                            <div class="row product_row">
                                <div class="col-sm-2 row_count">
                                    <label for="">Row Count</label>
                                    <input type="text" style="border: 0px;" value="1" class="row_count_number" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Product Name:</label>
                                    <input class="form-control product_list_search" id="product_detail" list="product_datalist" name="products[]"  placeholder="Type to search...">
                                    <datalist id="product_datalist" class="product_datalist">
                                    </datalist>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Product Quantity:</label>
                                    <input type="number" class="form-control" name="quantities[]">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Add/Remove</label><br>
                                    <button class="btn btn-success add_item_btn">Add More</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="create_receipt_btn">Create receipt</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-header">
            <h4>Edit Receipt</h4>
        </div>
        <div class="card-body">
            <form action="{{url('update-receipt')}}" method="POST" id="update_receipt_form">
                @csrf 
                <div class="row">
                    <input type="hidden" value="{{$data['receipt']->receipt_id}}" name="receipt_id" >
                    <div class="col-md-6">
                        <label for="receipt_number" class="col-md-4 col-form-label text-md-end">Receipt Number:</label>
                        <input id="receipt_number" type="number" class="form-control @error('receipt_number') is-invalid @enderror" name="receipt_number" value="{{ $data['receipt']->receipt_number }}" autocomplete="receipt_number" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('receipt_number')
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-6">
                        <label for="promoters" class="form-label">Search Promoter:</label>
                        <input class="form-control promoter_list_search" list="promoters_datalist"  onfocusout="updateHiddenField(this)" name="promoters" value="{{ $data['receipt']->promoter_id }}"  id="promoters" placeholder="Type to search...">
                        <input type="text" disabled id="promoter_name" value="{{$data['receipt']->firstname}} {{$data['receipt']->surname}}">
                        <datalist id="promoters_datalist">
            
                        </datalist>
                    </div>
                    <div class="col-md-6">
                        <label for="receipting_date" class="col-md-4 col-form-label text-md-end">{{ __('receipting Date:') }}</label>
                        <input id="receipting_date" type="date" class="form-control @error('receipting_date') is-invalid @enderror" name="receipting_date" value="{{ $data['receipt']->receipt_date }}" autocomplete="receipting_date">
                        <span class="invalid-feedback" role="alert">
                        @error('receipting_date')  
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <h4>Products</h4>
                        <div class="show_item">
                        @foreach($data['receipt']->combined_array as $things=>$values)  
                            <div class="row product_row">
                                <div class="col-sm-2 row_count">
                                    <label for="">Row Count</label>
                                    <input type="text" style="border: 0px;" value="{{intval($things)+1}}" class="row_count_number" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Product Name:</label>
                                    <input class="form-control product_list_search" id="product_detail" list="product_datalist" name="products[]"   value="{{$values['product_name']}}"  placeholder="Type to search...">
                                    <datalist id="product_datalist" class="product_datalist">
                                    </datalist>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Product Quantity:</label>
                                    <input type="number" class="form-control" value="{{$values['receipt_quantity']}}" name="quantities[]">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Add/Remove</label><br>
                                    <button class="btn btn-success add_item_btn">Add More</button>
                                    <button class="btn btn-danger remove_item_btn">Delete</button>

                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="create_receipt_btn">Update receipt</button>
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
        var lastRow = container.find('.product_row').last();
        var lastRowCount = lastRow.find('.row_count_number').val();
        var newRowCount = parseInt(lastRowCount) + 1;
        container.append(`
            <div class="row product_row">
                <div class="col-sm-2 row_count">
                    <label for="">Row Count</label>
                    <input type="text" style="border: 0px;" value="${newRowCount}" class="row_count_number" disabled>
                </div>
                <div class="col-md-3">
                    <label for="">Product Name:</label>
                    <!-- Corrected class name -->
                    <input class="form-control product_list_search" list="product_datalist" name="products[]"  placeholder="Type to search...">
                    <datalist id="product_datalist" class="product_datalist">

                    </datalist>
                </div>
                <div class="col-md-3">
                    <label for="">Product Quantity:</label>
                    <input type="number" class="form-control" name="quantities[]">
                </div>
                <div class="col-md-3">
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
        var rowCount = 1; // Start the count from 1
        $('.product_row').each(function() {
            $(this).find('.row_count_number').val(rowCount); // Update the row count number
            rowCount++; // Increment the count for the next row
        });
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
        $('#insert_receipt_form').submit(function(e){
            e.preventDefault()
            const redirect_url="{{url('marketers')}}"
            $.ajax({
                url:"{{url('insert_receipt')}}",
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
    $('#update_receipt_form').submit(function(e){
        e.preventDefault()
        const redirect_url="{{url('view_receipts')}}"
        $.ajax({
            url:"{{url('update_receipt')}}",
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
function updateHiddenField(input) {
    var inputValue = input.value;
    if(inputValue !=''){
        console.log(inputValue)
        $.ajax({
            url:"{{url('getpromoter')}}",
            method:"GET",
            data:{query:inputValue},
            success:function(data){
                $('#promoter_name').val(data.firstname+' '+data.surname )

            },
            error:function(response){
                console.log(response)
            }
        })
    }
}
</script>
@endsection