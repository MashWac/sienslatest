@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2> Users Page</h2>
        </div>
        <div class="card-body">
            <h5>Create A New User</h5>
            <div class="col-md-6">
                <a href="{{url('add-User')}}">
                    <button type="submit" class="btn btn-primary">Add</button>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                <h3 >List Of Users</h3>
                <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Surname Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created On</th>
                        <th>Last updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['users'] as $item)
                    <tr>
                        <td>{{$item->firstname}}</td>
                        <td>{{$item->surname}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->role_name}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>
                            @if(($item->role_as==2)||($item->role_as==3))
                            <a href="{{url('view-user/'.$item->user_id)}}">
                                <button type="submit" class="btn btn-success">View</button>
                            </a>
                            @endif
                            <a href="{{url('edit-user/'.$item->user_id)}}">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </a>
                            <form method="GET" action="{{url('delete-user/'.$item->user_id)}}">
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
            {{ $data['users']->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection