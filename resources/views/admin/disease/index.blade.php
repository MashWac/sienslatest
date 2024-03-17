@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2> Disease Page</h2>
        </div>
        <div class="card-body">
            <h5>Add a Disease</h5>
            <div class="col-md-6">
                <a href="{{url('add-disease')}}">
                    <button type="submit" class="btn btn-primary">Add</button>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                <h3 >List Of Diseases</h3>
                <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>List of medications</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['diseases'] as $item)
                    <tr>
                        <td>{{$item->disease_name}}</td>
                        <td>{{$item->short_description}}</td>
                        <td>{{$item->product_names}}</td>
                        <td>
                            <a href="{{url('edit-disease/'.$item->disease_id)}}">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </a>
                            <form method="GET" action="{{url('delete_disease/'.$item->disease_id)}}">
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

        {{ $data['diseases']->links('pagination::bootstrap-4') }}

        </div>
    </div>
@endsection