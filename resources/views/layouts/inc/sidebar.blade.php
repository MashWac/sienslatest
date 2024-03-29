<div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="{{url('dashboard')}}" class="simple-text">
                    <img src="/staticimg/sienslogo2.png/" alt="logo" height="70px" width="190px">
                        <span>Admin</span>
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('dashboard') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('dashboard')}}">
                            <ion-icon name="home"></ion-icon>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('categories') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('categories')}}">
                            <ion-icon name="folder-open"></ion-icon>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('users') ? 'active' : ''}}" >
                        <a class="nav-link" href="{{url('users')}}">
                            <ion-icon name="people"></ion-icon>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('products') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('products')}}">
                        <ion-icon name="rose-outline"></ion-icon>
                        <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('diseases') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('diseases')}}">
                        <ion-icon name="warning-outline"></ion-icon>
                        <p>Diseases</p>
                        </a>
                    </li>
                    <li  class="nav-item {{ \Illuminate\Support\Facades\Request::is('orders') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('orders')}}">
                        <ion-icon name="list-circle-outline"></ion-icon>
                        <p>Orders</p>
                        </a>
                    </li>
                    <li  class="nav-item {{ \Illuminate\Support\Facades\Request::is('marketers') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('marketers')}}">
                        <ion-icon name="cash-outline"></ion-icon>
                        <p>Promoters</p>
                        </a>
                    </li>
                    <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('messages') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('messages')}}">
                            <ion-icon name="send"></ion-icon>
                            <p>Message</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>