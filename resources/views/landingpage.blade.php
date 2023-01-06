@extends('layouts.authtemplate')

@section('content')
<main class="py-1">
<div id="courasel">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="/staticimg/home2.png" class="d-block w-100 bannerimg" height="20%" alt="...">
                    <div class="carousel-caption">
                        <p class="proddesc">JOIN THE HEALTHY LIFESTYLE.</p>
                        <a href="{{url('login')}}" class="btn btn-warning "id="btnpurch" style="color:white;"> LOGIN</a>
                    </div>
                    </div>
                </div>
    
            </div>
        </div>
<div class="container">
<div id="authpages">

    <div id="Who">
    <section class="" style="background-color: #f5f7fa;">
        <div class="container py-5 ">
            <div class="row d-flex justify-content-center align-items-center">
            <div class="col ">

                <div class="card">
                <div class="card-body">
                    <blockquote class="blockquote blockquote-custom bg-white px-3 pt-4">
                    <div class="blockquote-custom-icon bg-info shadow-1-strong">
                        <i class="fa fa-quote-left text-white"></i>
                    </div>
                    <p class="mb-0 mt-2 font-italic">
                    <span style="font-size:30px;">WHO ARE WE?</span><br><br>
                        "We champion the supplement, vitamins and herbs industry in Kenya. We are committed and continually motivated to encouraging our customers to live a healthy lifestyle. We believe winners are those who have won their inner beauty by living a healthy lifestyle. We continually remind our clients the need to listen to the body as it cries in pain and act immediately. Being in poor health zone is really regrettable and we can all avoid this position. If we take care of our bodies different body systems are able to perform to maximum. We have to have the desire to live healthy lifestyles. It is the only positive direction towards a fulfilling life. You cannot enjoy your paycheck if your body is unhealthy."
                    </p>
                    </blockquote>
                </div>
                </div>

            </div>
            </div>
        </div>
        </section>

    </div>
    <div id="importrews" style="background-color: rgba(0, 128, 172);">

        <div id="mission" style="float:left;  margin: 8%;">
            <div class="quote-wrapper">
            <blockquote class="text">
                <p> <span style="font-size:30px;">OUR VISION</span><br><br> To be a world class health and beauty company of choice. </p>
            </blockquote>
            </div>
        </div>
        <div id="concept" style="float:left; margin: 8%;" >
            <div class="quote-wrapper">
            <blockquote class="text">
                <p> <span style="font-size:30px;">OUR MISSION</span><br><br> Inspire communities to live healthy lifestyles.</p>
            </blockquote>
            </div>
        </div>
    </div>
    <div id="loginsign">
        <div class="row justify-content-center">
				<div class="col-md-12">
				    <div class="wrap d-md-flex">
                        <!--image-->
					    <div class="img" style="background-image: linear-gradient(to bottom right, #ccc20a, #ccc20a);">
                            <h2 class="mb-4 frebo" style="color:white;">Become a Member Today? <a href="{{url('register')}}" class="btn btn-primary" style="color:white;"> Register</a></h2>
                            
			            </div>
						<div class="login-wrap p-4 p-md-5"  style="background-image: linear-gradient(to bottom right, #0a75cc, #0a75cc);">
			      	        <div class="d-flex">
			      		        <div class="w-100">
			      			        <h3 class="mb-4 frebo"> Already A member? <a href="{{url('login')}}" class="btn btn-warning "id="btnpurch" style="color:white;"> Login</a></h3>
                                </div>
			      	        </div>
		                </div>
		            </div>
				</div>
	    </div>
</div>
<main>
@endsection
