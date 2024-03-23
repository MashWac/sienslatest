@extends('layouts.admin')

@section('content')
    @if($data['formtype']=='add')
    <div class="card">
        <div class="card-header">
            <h4>Add Product</h4>
        </div>
        <div class="card-body">
            <form action="{{url('insert-prod')}}" method="POST" id="insert_product_form" enctype="multipart/form-data">
                @csrf 
                <div class="row">
                    <div class="col-md-6">
                        <label for="prodname">Product Name:</label>
                        
                        <input id="prodname" type="text" class="form-control @error('prodname') is-invalid @enderror" name="prodname" value="{{ old('prodname')}}" autocomplete="prodname" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('prodname')<strong>{{ $message }}</strong>@enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <label for="proddescr">Product Description:</label>
                        <textarea class="form-control @error('proddescr') is-invalid @enderror" name="proddescr" id="descript"autocomplete="proddescr" autofocus> {{ old('proddescr')}}</textarea>
                        <span class="invalid-feedback" role="alert">
                        @error('proddescr')<strong>{{ $message }}</strong>@enderror
                        </span>
                    </div>
                    <div class="col-md-12 show_item">
                        <div class="row">
                            <div class="col-md-6">
                            <label for="prodcate">Category:</label>
                            <input type="text" class="form-control @error('prodcate') is-invalid @enderror" name="prodcate[]" id="product-category" list="categoryselect" value="{{ old('prodcate')}}">
                                    <datalist id="categoryselect">
                                        @foreach($data['category'] as $item)
                                        <option value="<?=$item['category_name']?>"><?=$item['category_name']?><option>
                                        @endforeach
                                    </datalist>
                                    <span class="invalid-feedback" role="alert">
                                        @error('prodcate')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                    </span>   
                            </div>
                            <div class="col-md-6">
                                <label for="">Add/Remove</label><br>
                                <button class="btn btn-success add_item_btn">Add More</button>
                                <button class="btn btn-danger remove_item_btn">Delete</button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="prodprice">Unit Price:</label>
                        <input type="number" class="form-control @error('prodprice') is-invalid @enderror" name="prodprice" value="{{ old('prodprice')}}">
                        <span class="invalid-feedback" role="alert">
                        @error('prodprice')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>   
                    </div>
                    <div class="col-md-6">
                        <label for="prodquan">Product Quantity:</label>
                        <input type="number" class="form-control @error('prodquan') is-invalid @enderror" name="prodquan" value="{{ old('prodquan')}}">
                        <span class="invalid-feedback" role="alert">
                        @error('prodquan')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>  
                    </div>

                    <div class="col-md-6">
                        <label for="prodpriority">Product Priority:</label>
                        <select type="number" class="form-control @error('prodpriority') is-invalid @enderror" name="prodpriority">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <span class="invalid-feedback" role="alert">
                        @error('prodpriority')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>  
                    </div>

                    <div class="col-md-12">
                        <label for="prodimage">Product Image:</label>
                        <input type="file" class="form-control @error('prodimage') is-invalid @enderror" id="img"  name="prodimage">
                        <span class="invalid-feedback" role="alert">
                        @error('prodimage')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>  
                    </div>
                    <div class="col-md-6" id="selectedBanner">

                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-header">
            <h4>Edit Product</h4>
        </div>
        <div class="card-body">
    
            <form action="{{url('update-prod/'.$data['product']->product_id)}}" id="update_product_form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <input type="hidden" name="product_id" value="{{$data['product']->product_id}}">
            <div class="col-md-6">
                    <label for="prodname">Product Name:</label>
                    
                    <input id="prodname" type="text" class="form-control @error('prodname') is-invalid @enderror" name="prodname" value="{{ $data['product']->product_name }}" autocomplete="prodname" autofocus>
                    <span class="invalid-feedback" role="alert">
                    @error('prodname')<strong>{{ $message }}</strong>@enderror
                    </span>
                </div>
                <div class="col-md-12">
                    <label for="proddescr">Product Description:</label>
                    <textarea class="form-control @error('proddescr') is-invalid @enderror" name="proddescr" id="descript"autocomplete="proddescr" autofocus>{!! $data['product']->product_description !!} </textarea>
                    <span class="invalid-feedback" role="alert">
                    @error('proddescr')<strong>{{ $message }}</strong>@enderror
                    </span>
                </div>
                <div class="col-md-12 show_item">
                    @foreach($data['product']->category_array as $thing=>$cate_name)
                    <div class="row">
                        <div class="col-md-6">
                        <label for="prodcate">Category:</label>
                        <input type="text" class="form-control @error('prodcate') is-invalid @enderror" name="prodcate[]" id="product-category" list="categoryselect" value="{{$cate_name['product_name']}}">
                                <datalist id="categoryselect">
                                    @foreach($data['category'] as $item)
                                    <option value="<?=$item['category_name']?>"><?=$item['category_name']?><option>
                                    @endforeach
                                </datalist>
                                <span class="invalid-feedback" role="alert">
                                    @error('prodcate')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                </span>   
                        </div>
                        <div class="col-md-6">
                            <label for="">Add/Remove</label><br>
                            <button class="btn btn-success add_item_btn">Add More</button>
                            <button class="btn btn-danger remove_item_btn">Delete</button>

                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-md-6">
                    <label for="prodprice">Unit Price:</label>
                    <input type="number" class="form-control @error('prodprice') is-invalid @enderror" name="prodprice" value="{{$data['product']->unit_price}}">
                    <span class="invalid-feedback" role="alert">
                    @error('prodprice')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </span>   
                </div>
                <div class="col-md-6">
                    <label for="prodquan">Product Quantity:</label>
                    <input type="number" class="form-control @error('prodquan') is-invalid @enderror" name="prodquan" value="{{$data['product']->stock_available}}">
                    <span class="invalid-feedback" role="alert">
                    @error('prodquan')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </span>  
                </div>
                <div class="col-md-6">
                    <label for="prodpriority">Product Priority:</label>
                    <select type="number" class="form-control @error('prodpriority') is-invalid @enderror" name="prodpriority">
                        <option value="1" <?=$data['product']['prodpriority']==1 ? ' selected="selected"' : '';?> >1</option>
                        <option value="2" <?=$data['product']['prodpriority']==2 ? ' selected="selected"' : '';?> >2</option>
                        <option value="3" <?=$data['product']['prodpriority']==3 ? ' selected="selected"' : '';?> >3</option>
                        <option value="4" <?=$data['product']['prodpriority']==4 ? ' selected="selected"' : '';?> >4</option>
                        <option value="5" <?=$data['product']['prodpriority']==5 ? ' selected="selected"' : '';?> >5</option>
                    </select>
                    <span class="invalid-feedback" role="alert">
                    @error('prodpriority')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </span>  
                </div>

                <div class="col-md-12">
                    <label for="prodimage">Product Image:</label>
                    <input type="file" id="img"  name="prodimage" value="">
                </div>
                <div class="col-md-6">
                    <h4>Current Image</h4> 
                    @if($data['product']->product_image)
                    <img src="{{$data['product']['product_image']}}" alt="Product Image" height='400px' width='350px'>
                    @endif
                </div>
                <div class="col-md-6" >
                    <h4>New Image</h4> 
                    <div id="selectedBanner">
                    
                    </div>

                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
        @endif

        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        // Event delegation to handle click event for dynamically added elements
        $(document).on("click", ".add_item_btn", function(e){
            e.preventDefault();
            var container = $(".show_item");
            // Change button class and text
            // $(this).removeClass('btn-success add_item_btn').addClass('btn-danger remove_item_btn').text("Remove");
            var lastRow = container.find('.product_row').last();
            var lastRowCount = lastRow.find('.row_count_number').val();
            var newRowCount = parseInt(lastRowCount) + 1;
            container.append(`
                <div class="row">
                    <div class="col-md-6">
                    <label for="prodcate">Category:</label>
                    <input type="text" class="form-control @error('prodcate') is-invalid @enderror" name="prodcate[]" id="product-category" list="categoryselect" value="{{ old('prodcate')}}">
                            <datalist id="categoryselect">
                                @foreach($data['category'] as $item)
                                <option value="<?=$item['category_name']?>"><?=$item['category_name']?><option>
                                @endforeach
                            </datalist>
                            <span class="invalid-feedback" role="alert">
                                @error('prodcate')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                            </span>   
                    </div>
                    <div class="col-md-6">
                        <label for="">Add/Remove</label><br>
                        <button class="btn btn-success add_item_btn">Add More</button>
                        <button class="btn btn-danger remove_item_btn">Delete</button>

                    </div>
                </div>
            `);
        });

        // Event delegation to handle click event for dynamically added "Remove" buttons
        $(document).on("click", ".remove_item_btn", function(e){
            e.preventDefault();
            $(this).closest('.row').remove(); 
            // var rowCount = 1; // Start the count from 1
            // $('.product_row').each(function() {
            //     $(this).find('.row_count_number').val(rowCount); // Update the row count number
            //     rowCount++; // Increment the count for the next row
            // });
        });
    });

</script>
<!-- <script>
    $('#insert_product_form').submit(function(e){
        e.preventDefault();
        const redirect_url = "{{ url('products') }}";
        const formData = new FormData(this); // Create FormData object from the form

        $.ajax({
            url: "{{ url('insert-prod') }}",
            type: "POST", // Change to POST for file uploads
            data: formData, // Use FormData object for data
            contentType: false, // Don't set content type (automatically set by FormData)
            processData: false, // Don't process data (already done by FormData)
            success: function(response) {
                swal(response.message);
                setTimeout(function() {
                    window.location.href = redirect_url;
                }, 3000);
            },
            error: function(response) {
                swal(response.message);
            }
        });
    });
</script> -->

<!-- <script>
    $('#update_product_form').submit(function(e){
        e.preventDefault()
        const redirect_url="{{url('products')}}"
        $.ajax({
            url:"{{url('update-prod')}}",
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
</script> -->


@endsection