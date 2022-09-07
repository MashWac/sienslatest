@extends('layouts.admin')

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://cdn-icons-png.flaticon.com/512/1057/1057231.png?w=360"><span class="font-weight-bold"> {{$data['user']->firstname}}  {{$data['user']->surname}}  </span><span class="text-black-50"> {{$data['user']->email}} </span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Your profile</h4>
                </div>
                <form method="post" action="adminprofileupdate">
                    @csrf
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" name="firstname" placeholder="First Name" value="{{$data['user']->firstname}}"></div>
                    <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" value="{{$data['user']->surname}}" name="surname" placeholder="Surname"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" name="email" placeholder="Email" value="{{$data['user']->email}}"></div>
                    <div class="col-md-12"><label class="labels">Country</label><input type="text" class="form-control" placeholder="Country" name="country" value="{{$data['user']->country}}" list="country_list">                                 <datalist id="country_list">
                                    @foreach($data['countries'] as $item)
                                    <option value="{{$item->name}}">
                                    @endforeach

                                    
                                </datalist></div>
                    <div class="col-md-12"><label class="labels">Phone Number</label><input type="number" class="form-control" name="phone" placeholder="Phone" value="{{$data['user']->telephone}}"></div>
                    <div class="col-md-12"><label class="labels">Password</label><input type="password" class="form-control" name="password"placeholder="Password" value=""></div>
                    <div class="col-md-12"><label class="labels">Confirm Password</label><input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" value=""></div>
                    <div class="col-md-12"><label class="labels">Last Update</label><input readonly type="datetime-local" class="form-control" placeholder="enter address line 2" value="{{$data['user']->updated_at}}"></div>
                </div>
                    <button type="submit" class="btn btn-primary ">Update Profile</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection