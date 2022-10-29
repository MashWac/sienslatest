@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2> Discounts Page</h2>
        </div>
        <div class="card-body">
            <h5>Create New Discount</h5>
            <div class="col-md-6">
                <a href="{{url('add-discount')}}">
                    <button type="submit" class="btn btn-primary">Add</button>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                <h3 >List Of Discounts</h3>
                <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>Discount ID</th>
                        <th>Discount Code</th>
                        <th>Discount Percentage</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($discount as $item)
                    <tr>
                        <td>{{$item->discount_id}}</td>
                        <td>{{item->discount_code}}</td>
                        <td>{{$item->discount_percentage}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>
                            <a href="{{url('edit-discount/'.$item->discount_id)}}">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </a>
                            <form method="GET" action="{{url('delete-discount/'.$item->discount_id)}}">
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