@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2> Category Page</h2>
        </div>
        <div class="card-body">
            <h5>Create A New Category</h5>
            <div class="col-md-6">
                <a href="{{url('add-category')}}">
                    <button type="submit" class="btn btn-primary">Add</button>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                <h3 >List Of Categories</h3>
                @foreach($category as $item)
                <div class="card w-75">
                    <div class="card-body">
                        <h4 style="text-transform:uppercase;" class="card-title">{{$item->category_name}}</h4>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{url('view-category/'.$item->category_id)}}">
                                <button type="submit" class="btn btn-success">View</button>
                            </a>
                            <a href="{{url('edit-category/'.$item->category_id)}}">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </a>
                            <a href="{{url('delete-category/'.$item->category_id)}}">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
@endsection