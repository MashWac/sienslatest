@extends('layouts.authtemplate')

@section('content')
<main class="py-1">
    <div id="courasel">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner landing_carousel_items">
                <div class="carousel-item active">
                    <img src="/staticimg/home2.png" class="d-block w-100 bannerimg" alt="primose">
                    <div class="carousel-caption">
                        <p class="proddesc">JOINING THE HEALTHY LIFESTYLE IS FREE.</p>
                        <a href="{{url('productspreview')}}" class="btn btn-warning"> Shop Now</a>
                    </div>
                </div>
                <div class="carousel-item right_item_parent" >
                    <img src="/staticimg/home3.png" class="d-block w-100 bannerimg" alt="wheatgrass">
                    <div class="carousel-caption right_item" id="on-de-right">
                        <p class="proddesc">JOINING THE HEALTHY LIFESTYLE IS FREE.</p>
                        <a href="{{url('productspreview')}}" class="btn btn-warning right_button"> Shop Now</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/staticimg/home1.png" class="d-block w-100 bannerimg" alt="zinc">
                    <div class="carousel-caption">
                        <p class="proddesc">JOINING THE HEALTHY LIFESTYLE IS FREE.</p>
                        <a href="{{url('productspreview')}}" class="btn btn-warning"> Shop Now</a>
                    </div>
                </div>
                <div class="carousel-item right_item_parent">
                    <img src="/staticimg/home5.png" class="d-block w-100 bannerimg" alt="omega3">
                    <div class="carousel-caption right_item" id="on-de-right">
                        <p class="proddesc">JOINING THE HEALTHY LIFESTYLE IS FREE.</p>
                        <a href="{{url('productspreview')}}" class="btn btn-warning right_button"> Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="container">
        <div id="authpages">

            <div id="Who">
            <section class="" style="background-color: #f5f7fa; margin-top:3px;">
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
                                "SIENS has existed for over fifteen
                                    years, engaging health industry with
                                    food supplements and magnetic
                                    health devices of unique, premium
                                    quality, and potent standard. Over 7
                                    million people have successfully used
                                    Siens products to address health and
                                    well- being in areas such as
                                    immunity, mental, emotional,
                                    physical, women wellness, men
                                    wellness and general body health.
                                    Our products are GMP, ISO, NON-
                                    GMO, AND USDA ORGANIC certified.
                                    We promote a Healthy Lifestyle by
                                    encouraging people to listen to the
                                    body as it cries in pain. We believe
                                    addressing a condition early natures
                                    quick healing. Being in Poor health
                                    zone is regrettable because the Body
                                    systems no longer perform
                                    maximally."
                            </p>
                            </blockquote>
                        </div>
                        </div>

                    </div>
                    </div>
                </div>
            </section>

            </div>
            <div class="vission_mission text-center">
                <div id="importrews">

                    <div id="mission" style=" margin: 2%;">
                        <div class="quote-wrapper">
                        <blockquote class="text">
                            <p style="font-size: 19px;"> <span style="font-size:22px;">OUR VISION</span><br><br> To be a world class health and beauty company of choice. </p>
                        </blockquote>
                        </div>
                    </div>
                    <div id="concept" style=" margin: 2%;" >
                        <div class="quote-wrapper">
                        <blockquote class="text">
                            <p style="font-size: 19px;"> <span style="font-size:22px;">OUR MISSION</span><br><br> Inspire communities to live healthy lifestyles.</p>
                        </blockquote>
                        </div>
                    </div>
                    
                    <div id="concept" style=" margin: 2%;" >
                        <div class="quote-wrapper">
                        <blockquote class="text">
                            <p style="font-size: 19px;"> <span style="font-size:22px;">OUR OBJECTIVE</span><br><br> Promote a healthy lifestyle to over 100,000 people every year.</p>
                        </blockquote>
                        </div>
                    </div>
                </div>
            </div>

            <div id="loginsign" class="loginsign">

                <div class="become_a_member text-center">
                    <h2 class="frebo" style="color:white;">Become a Member Today? <br><a href="{{url('register')}}" class="btn btn-primary" style="color:white;"> Register</a></h2>  
                </div>
                <div class="already_a_member text-center">
                    <h3 class=" frebo"> Already A member?<br> <a href="{{url('login')}}" class="btn btn-warning "id="btnpurch" style="color:white;"> Login</a></h3>
                </div>
            
                </div>
            </div>
        </div>
        </div>
</main>
@endsection
