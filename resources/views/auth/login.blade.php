@extends('layouts.authtemplate')

@section('content')
<main class="py-4">
<div class="container">
<div id="authpages">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="wrap d-md-flex">
                        <!--image-->
						<div class="img" style="background-image: url(/staticimg/healthy1.png);">
			            </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
                    </div>
			      	</div>
							<form action="authenticate-user" method="POST" class="signin-form">
                                @csrf
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Email or phone:</label>
                              <div class="col-md-12">
                                <input id="userlog" type="userlog" class="form-control @error('userlog') is-invalid @enderror" name="userlog" value="{{ old('userlog') }}" required autocomplete="userlog" placeholder="email or phone 7XXXXXXXX" autofocus>

                                @error('userlog')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                        </div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
                        <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
						<div class="form-group mb-3">
                        <div class="col-md-12">
						 	<button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                        </div>
                        
                        <div class="form-group d-md-flex">
		            	    <div class="w-50 text-left">
			            	    <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
									<span class="checkmark"></span>
								</label>
							</div>
								<div class="w-50 text-md-right">
									<a href="">Forgot Password</a>
							    </div>
		                </div>
		          </form>
		          <p class="text-center">Not a member? <a data-toggle="tab" href="register">Sign Up</a></p>
		        </div>
		      </div>
				</div>
			</div>
		</div>
</div>
<main>
@endsection
