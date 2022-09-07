@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2> Product Page</h2>
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
                    @foreach($product as $item)
                    <tr>
                        <td>{{$item->product_name}}</td>
                        <td>{{$item->product_description}}</td>
                        <td>{{$item->category}}</td>
                        <td>{{$item->unit_price}}</td>
                        <td>{{$item->stock_available}}</td>
                        <td><img src="{{$item['product_image']}}" height="130px" width="100px" alt='image here'>
                        </td>
                        <td>
                            <a href="{{url('view-prod')}}">
                                <button type="submit" class="btn btn-success">View</button>
                            </a>
                            <a href="{{url('edit-prod/'.$item->product_id)}}">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </a>
                            <form method="GET" action="{{url('delete-prod/'.$item->product_id)}}">
                                @csrf
                                <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
          
        </div>
        <div class="text-center d-flex justify-content-center">
            {{ $product->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection