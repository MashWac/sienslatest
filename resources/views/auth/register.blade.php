@extends('layouts.authtemplate')

@section('content')
<main class="py-4" id="regpage"  >
<div class="container" >
    <div class="row justify-content-center "style="padding-bottom: 50px;" >
        <div class="col-md-6">
            <div class="card" >
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="reg-user">
                        @csrf
                        <div class="row mb-3">
                            <label for="firstname" class="col-md-4 col-form-label text-md-end">{{ __('First Name:') }}</label>

                            <div class="col-md-6">
                                <input id="firstame" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" autofocus>
                                    <span class="invalid-feedback" role="alert">
                                    @error('firstname')<strong>{{ $message }}</strong>@enderror
                                    </span>
                                
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="surname" class="col-md-4 col-form-label text-md-end">{{ __('Surname:') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                               
                                    <span class="invalid-feedback" role="alert">
                                    @error('email')  <strong>{{ $message }}</strong>@enderror
                                    </span>
                                
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="telephone" class="col-md-4 col-form-label text-md-end">{{ __('Telephone:') }}</label>

                            <div class="col-md-6">
                                <input id="telephone" type="number" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}">

                               
                                    <span class="invalid-feedback" role="alert">
                                    @error('telephone')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="country" class="col-md-4 col-form-label text-md-end">{{ __('Country:') }}</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" list="country_list">
                                <datalist id="country_list">
                                    @foreach($data['countries'] as $item)
                                    <option value="{{$item->name}}">
                                    @endforeach

                                    
                                </datalist>
                               
                                    <span class="invalid-feedback" role="alert">
                                    @error('country')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password:') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirm" type="password" class="form-control @error('password_confirm') is-invalid @enderror" name="password_confirm" autocomplete="new-password">
                            </div>
                                    <span class="invalid-feedback" role="alert">
                                    @error('password_confirm')<strong>{{ $message }}</strong>@enderror
                                    </span>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

		          </form>
		          <p class="text-center">Already a member? <a data-toggle="tab" href="{{url('login')}}">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

@endsection
