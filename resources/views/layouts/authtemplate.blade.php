<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!----fonts---->
    <link rel="icon" href="{{ url('/staticimg/fav.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bebas+Neue&family=Bree+Serif&family=Courgette&family=Kanit:ital,wght@1,500;1,800&family=Kaushan+Script&family=Lobster&family=Lora:ital,wght@1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Acme&family=Goldman&family=Kanit:ital,wght@1,500&family=Lobster&family=Merriweather:ital,wght@0,700;1,900&family=Patua+One&family=Prompt:wght@500&family=Righteous&family=Roboto+Slab:wght@800&family=Russo+One&family=Secular+One&family=Varela+Round&family=Vollkorn:ital,wght@0,400;0,700;1,700;1,900&display=swap" rel="stylesheet">
   
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Oxygen&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Lora:wght@500&family=Oswald&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Open+Sans:ital@0;1&family=Poppins:wght@300;400&family=Raleway:ital,wght@0,400;1,300&family=Red+Hat+Mono&family=Roboto+Condensed&family=Roboto:ital,wght@0,400;1,300&family=Source+Sans+Pro:ital,wght@0,400;1,300&family=Ubuntu:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
    <!-- Styles -->
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/slider.css') }}" rel="stylesheet">

</head>
@include('layouts.inc.authnav')
<body>
    <div class="mainbody">
    @yield('content')
        <div class="floating-icons" style="position: fixed; bottom:8%; right:3%;">
            <a href="" style="">
                <div class="whatsapp-icon" style="background-color:rgba(255,255,255,0.6); border-radius:0.4rem;margin-bottom: 5px;">
                    <ion-icon name="logo-whatsapp" class="floating_icon"></ion-icon>
                </div>
            </a>
            <a href=""style="">
                <div class="facebook-icon" style="background-color:rgba(255,255,255,0.6); border-radius:0.4rem; margin-bottom: 5px;">
                    <ion-icon name="logo-facebook" class="floating_icon"></ion-icon>
                </div>
            </a>
            <!-- <a href=""style="margin-bottom: 5px;">
                <div class="mail-icon" style="background-color:rgba(255,255,255,0.6); border-radius:0.4rem">
                    <ion-icon name="mail-outline" class="floating_icon"></ion-icon>
                </div>
            </a> -->

        </div>

    </div>
    @include('layouts.footer')


    <!--- Scripts-->
    <script src="{{ asset('frontend/js/slider.js') }}" defer></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(session('status'))
    <script>
        swal("{{session('status')}}")
    </script>
    @endif
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('scripts')
</body>
</html>


