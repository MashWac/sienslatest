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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.js" integrity="sha512-vNrhFyg0jANLJzCuvgtlfTuPR21gf5Uq1uuSs/EcBfVOz6oAHmjqfyPoB5rc9iWGSnVE41iuQU4jmpXMyhBrsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Styles -->
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
</head>
<body>
<div>
        <div class="card"  id='invoice'>
            <div class="card-header p-4">
                    <div id="aboutlogo"> 
                        <img src="/staticimg/sienslogo2.png/" class="pagelogo" alt="logo" height="30%" width="40%">
                    </div>      
                    <div class="float-right"> <h3 class="mb-0">Invoice: #Siens22{{$data['order']->order_id}}</h3>
                        Date of Purchase: {{$data['order']->created_at}}
                    </div>
            </div>
            <div class="card-body" >
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h5 class="mb-3">From:</h5>
                        <h3 class="text-dark mb-1">Siens Africa</h3>
                        <div>VICTORY PLAZA 3RD FLOOR, Thika.</div>
                        <div>Email: siens@email.com</div>
                        <div>Nairobi: (+254)716615207.
                        Thika: (+254)728010172, (+254)705055983.</div>
                    </div>
                    <div class="col-sm-6 ">
                        <h5 class="mb-3">To:</h5>
                        <h3 class="text-dark mb-1">{{$data['user']->firstname}}  {{$data['user']->surname}}</h3>
                        <div>Email: {{$data['user']->email}}</div>
                        <div>Phone:{{$data['user']->telephone}}</div>
                    </div>
                </div>
                <div class="table-responsive-sm" >
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th class="right">Price</th>
                                <th class="center">Qty</th>
                                <th class="right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['orderdets'] as $things)
                                <tr>
                                    <td>{{$things->product_name}}</td>
                                    <td>{{$things->product_price}}</td>
                                    <td>{{$things->order_quantity}}</td>
                                    <td>{{$things->order_subtotal}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                    <tbody>
                    <tr>
                    <td class="left">
                    <strong class="text-dark">Total</strong>
                    </td>
                    <td class="right">
                    <strong class="text-dark">{{$data['order']->order_amount}} KES
                    </strong>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
         
        </div>
         <div class="card-footer bg-white">
            <p class="mb-0"><button class="btn btn-primary" id="downloadbtn"> Download Invoice</button>
            </p>
        </div>
</div>


    <!--- Scripts-->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}" defer></script>
    <!-- <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" defer></script> -->

    <script src="{{ asset('frontend/js/paycalc.js') }}" defer></script>
    <script src="{{ asset('frontend/js/downloadpdf.js') }}" defer></script>
    <script src="{{ asset('frontend/js/formdisplay.js') }}" defer></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    
    @if(session('status'))
    <script>
        swal("{{session('status')}}")
    </script>
    @endif

</body>
</html>
