@extends('layouts.admin')

@section('content')
    @if($data['formtype']=='add')
    <div class="card">
        <div class="card-header">
            <h4>Add user</h4>
        </div>
        <div class="card-body">
            <form action="{{url('insert-user')}}" method="POST">
                @csrf 
                <div class="row">
                    <div class="col-md-6">
                        <label for="firstname" class="col-md-4 col-form-label text-md-end">{{ __('First Name:') }}</label>

                        <input id="firstame" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('firstname')<strong>{{ $message }}</strong>@enderror
                        </span>
                            
                    </div>
                    <div class="col-md-6">
                        <label for="surname" class="col-md-4 col-form-label text-md-end">{{ __('Surname:') }}</label>

                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" autocomplete="surname" autofocus>
                        @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address:') }}</label>
                        
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                        <span class="invalid-feedback" role="alert">
                        @error('email')  <strong>{{ $message }}</strong>@enderror
                        </span>
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Telephone:') }}</label>
                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                            <span class="invalid-feedback" role="alert">
                        @error('phone')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>   
                    </div>

                    <div class="col-md-6">
                        <label for="role">Role:</label>
                        <input type="number" class="form-control @error('role') is-invalid @enderror" name="role" id="userrole" list="roles" value="{{ old('role') }}">
                                <datalist id="roles">
                                    @foreach($data['role'] as $item)
                                    <option value="<?=$item['role_id']?>"><?="Role-".$item['role_name']?><option>
                                    @endforeach
                                </datalist>
                                <span class="invalid-feedback" role="alert">
                            @error('role')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>   
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
            @else
            <div class="card">
        <div class="card-header">
            <h4>Edit user</h4>
        </div>
        <div class="card-body">
            <form action="{{url('update-user/'.$data['user']->user_id)}}" method="POST">
                @csrf
                @method('PUT') 
                <div class="row">
                <div class="col-md-6">
                        <label for="firstname" class="col-md-4 col-form-label text-md-end">{{ __('First Name:') }}</label>

                        <input id="firstame" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $data['user']->firstname}}" autocomplete="firstname" autofocus>
                        <span class="invalid-feedback" role="alert">
                        @error('firstname')<strong>{{ $message }}</strong>@enderror
                        </span>
                            
                    </div>
                    <div class="col-md-6">
                        <label for="surname" class="col-md-4 col-form-label text-md-end">{{ __('Surname:') }}</label>

                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{$data['user']->surname}}" autocomplete="surname" autofocus>
                        @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address:') }}</label>
                        
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$data['user']->email}}" autocomplete="email">
                        <span class="invalid-feedback" role="alert">
                        @error('email')  <strong>{{ $message }}</strong>@enderror
                        </span>
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Telephone:') }}</label>
                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$data['user']->telephone}}">
                            <span class="invalid-feedback" role="alert">
                        @error('phone')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>   
                    </div>
                    <div class="col-md-6">
                        <label for="role">Role:</label>
                        <input type="number" class="form-control @error('role') is-invalid @enderror" name="role" id="userrole" list="roles" value="{{$data['user']->role_as}}">
                                <datalist id="roles">
                                    @foreach($data['role'] as $item)
                                    <option value="<?=$item['role_id']?>"><?="Role-".$item['role_name']?><option>
                                    @endforeach
                                </datalist>
                                <span class="invalid-feedback" role="alert">
                        @error('role')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>   
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