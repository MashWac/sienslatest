@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2> View Category</h2>
        </div>
        <div class="card-body">
            <h5>Create A New Product</h5>
            <div class="col-md-6">
                <a href="{{url('add-Product')}}">
                    <button type="submit" class="btn btn-primary">Add</button>
                </a>
            </div>
        </div>

    </div>
    <div class="card">
        <div class="card-body">
                <h3 >List Of Products</h3>
                <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $item)
                    <tr>
                        <td>{{$item->product_name}}</td>
                        <td>{!!$item->product_description!!}</td>
                        <td>{{$item->category_names}}</td>
                        <td>{{$item->unit_price}}</td>
                        <td>{{$item->available_stock}}</td>
                        <td><img src="{{$item['product_image']}}" height="130px" width="100px" alt='image here'>
                        </td>
                        <td>
                            <a href="{{url('view-prod')}}">
                                <button type="submit" class="btn btn-success">View</button>
                            </a>
                            <a href="{{url('edit-prod/'.$item->product_id)}}">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </a>
                            <a href="{{url('delete-prod/'.$item->product_id)}}">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
          
        </div>
        <div class="text-center d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-4') }}
             </div>
    </div>
@endsection