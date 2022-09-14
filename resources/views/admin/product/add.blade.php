@extends('layouts.admin')

@section('content')
    @if($data['formtype']=='add')
    <div class="card">
        <div class="card-header">
            <h4>Add Product</h4>
        </div>
        <div class="card-body">
            <form action="{{url('insert-prod')}}" method="POST" enctype="multipart/form-data">
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
                    <div class="col-md-6">
                        <label for="prodcate">Category:</label>
                        <input type="text" class="form-control @error('prodcate') is-invalid @enderror" name="prodcate" id="product-category" list="categoryselect" value="{{ old('prodcate')}}">
                                <datalist id="categoryselect">
                                    @foreach($data['category'] as $item)
                                    <option value="<?=$item['category_name']?>"><?="category-".$item['category_name']?><option>
                                    @endforeach
                                </datalist>
                                <span class="invalid-feedback" role="alert">
                                    @error('prodcate')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                </span>   
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
            @else
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product</h4>
                </div>
                <div class="card-body">
            
                <form action="{{url('update-prod/'.$data['product']->product_id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
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
                    <div class="col-md-6">
                        <label for="prodcate">Category:</label>
                        @foreach($data['category'] as $item)
                            @if($item['category_id']== $data['product']->category)
                            <input type="text" class="form-control @error('prodcate') is-invalid @enderror" name="prodcate" id="product-category" list="categoryselect" value="{{$item->category_name}}">
                            @endif
                         @endforeach

                                <datalist id="categoryselect">
                                    @foreach($data['category'] as $item)
                                    <option value="<?=$item['category_name']?>"><?="category-".$item['category_name']?><option>
                                    @endforeach
                                </datalist>
                                <span class="invalid-feedback" role="alert">
                                    @error('prodcate')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                </span>   
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