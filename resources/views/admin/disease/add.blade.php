@extends('layouts.admin')

@section('content')
    @if($data['formtype']=='add')
    <div class="card">
        <div class="card-header">
            <h4>Add Disease</h4>
        </div>
        <div class="card-body">
            <form action="{{url('insert-disease')}}" method="POST" id="insert_disease_form">
                @csrf 
                <div class="row">
                    <div class="col-md-12">
                        <label for="disease_name" class="col-md-4 col-form-label text-md-end">Disease Name:</label>
                        <input id="disease_name" type="text" class="form-control @error('disease_name') is-invalid @enderror" name="disease_name" value="{{ old('disease_name') }}" autocomplete="disease_name" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('disease_name')
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <label for="short_description" class="form-label">Short Description:</label>
                        <input id="short_description" type="text" class="form-control @error('short_description') is-invalid @enderror" name="short_description" value="{{ old('short_description') }}" autocomplete="short_description" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('short_description')
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <label for="disease_information" class="col-md-4 col-form-label text-md-end">Disease Information:</label>
                        <textarea class="form-control @error('disease_information') is-invalid @enderror text_areas" name="disease_information" id="disease_information"autocomplete="disease_information" autofocus> {{ old('disease_information')}}</textarea>
                        <span class="invalid-feedback" role="alert">
                        @error('disease_information')  
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
                                    <label for="">Add/Remove</label><br>
                                    <button class="btn btn-success add_item_btn">Add More</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="create_invoice_btn">Create Disease</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-header">
            <h4>Edit Disease</h4>
        </div>
        <div class="card-body">
            <form action="{{url('update-disease')}}" method="POST" id="update_disease_form">
                @csrf 
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="disease_id" value="{{$data['disease']->disease_id}}">
                    </div>

                    <div class="col-md-12">
                        <label for="disease_name" class="col-md-4 col-form-label text-md-end">Disease Name:</label>
                        <input id="disease_name" type="text" class="form-control @error('disease_name') is-invalid @enderror" name="disease_name" value="{{$data['disease']->disease_name }}" autocomplete="disease_name" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('disease_name')
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <label for="short_description" class="form-label">Short Description:</label>
                        <input id="short_description" type="text" class="form-control @error('short_description') is-invalid @enderror" name="short_description" value="{{$data['disease']->short_description }}" autocomplete="short_description" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('short_description')
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <label for="disease_information" class="col-md-4 col-form-label text-md-end">Disease Information:</label>
                        <textarea class="form-control @error('disease_information') is-invalid @enderror text_areas" name="disease_information" id="disease_information"autocomplete="disease_information" autofocus>{!!$data['disease']->information !!}</textarea>
                        <span class="invalid-feedback" role="alert">
                        @error('disease_information')  
                        <strong>{{ $message }}</strong>
                        @enderror
                        </span>
                    </div>
                    <div class="col-md-12">
                        <h4>Products</h4>
                        <div class="show_item">
                            @foreach($data['disease']->product_names as $item=>$value)
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Product Name:</label>
                                    <input class="form-control product_list_search" id="product_detail" value="{{$value}}" list="product_datalist" name="products[]"  placeholder="Type to search...">
                                    <datalist id="product_datalist" class="product_datalist">
                                    </datalist>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Add/Remove</label><br>
                                    <button class="btn btn-success add_item_btn">Add More</button>
                                    <button class="btn btn-danger remove_item_btn">Remove</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="create_invoice_btn">Update Disease</button>
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
        $('#insert_disease_form').submit(function(e){
            e.preventDefault()
            const redirect_url="{{url('diseases')}}"
            $.ajax({
                url:"{{url('insert_disease')}}",
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
        $('#update_disease_form').submit(function(e){
            e.preventDefault()
            const redirect_url="{{url('diseases')}}"
            $.ajax({
                url:"{{url('update_disease')}}",
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