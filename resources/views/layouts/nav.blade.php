
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/home') }}">
            <img src="/staticimg/sienslogo2.png/" alt="logo" height="70px" width="190px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <a class="navlinks" href="{{ url('home') }}">
                    <li class="navopts"> 
                        HOME
                    </li>
                </a>
                <a class="navlinks" href="{{ url('prodpage') }}">
                <li class="navopts"> 
                    PRODUCTS
                </li>
                </a>
    
                <a class="navlinks" href="{{ url('/contacts') }}">
                <li class="navopts"> 
                    CONTACT US
                </li>
                </a> 
                <a class="navlinks" href="{{ url('/aboutus') }}">
                <li class="navopts"> 
                    ABOUT US
                </li>
                </a> 
                <a class="navlinks" href="">
                <a class="navlinks" href="{{ url('cart') }}">
                <li class="navopts"> 
                <span id="cartdetails">Cart<ion-icon name="cart" size="medium"></ion-icon></span>
                    <?php if(Session::has('cart')){
                    $count=count(session('cart'));
                    echo"<span id=cartCount>$count</span>";
                    }else
                    echo"<span id=cartCount>0</span>"
                    ?>
                </li>
                </a>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <?php if(session('logged')):?>
                <!-- Authentication Links -->
                    <li class="navlinks dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Oxygen', sans-serif; font-size:17px; text-transform: capitalize;" v-pre>
                            <ion-icon size="large" name="contact" style="  vertical-align: middle;"></ion-icon>
                             {{ session('surname') }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('viewprofile')}}">
                                {{ __('View Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{url('logout')}}">
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>
                    <?php endif;?>
            </ul>
            </div>
        </div>
    </nav>
</header>

