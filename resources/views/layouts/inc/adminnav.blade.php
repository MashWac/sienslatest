<nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"> Dashboard </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                <ion-icon name="home"></ion-icon>
                                <span class="d-lg-none">Dashboard</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                        <?php if(session('logged')):?>
                        <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" >
                                    <ion-icon size="large" name="contact" style="  vertical-align: middle;"></ion-icon>
                                    {{ session('surname') }}
                                </a>

                                <ul class="dropdown-menu dropdown-navbar">
                                    <li class="nav-link"><a href="{{url('adminprofile')}}" class="nav-item dropdown-item">Profile</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li class="nav-link"><a href="{{url('logout')}}" class="nav-item dropdown-item">Log out</a></li>
                                    </ul>
                                </li>
                                <li class="separator d-lg-none"></li>
                            </li>
                            <?php endif;?>
                            <li class="nav-item">
                
                            </li>

                            <li class="nav-item">
                           
                                <a class="nav-link" href="{{ url('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('logout') }}" method="GET" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>