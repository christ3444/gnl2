<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-brand" style="background: darkblue;">
                <!-- Logo icon -->
                <a href="{{route('dashboard')}}">
                    <b class="logo-icon">
                        <!-- Dark Logo icon -->
                        <img src="{{asset('back_assets/assets/images/logo.png')}}" alt="homepage" class="dark-logo" />
                        <!-- Light Logo icon -->
                        <img src="{{asset('back_assets/assets/images/logo.png')}}" alt="homepage" class="light-logo" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text text-white">
                        <!-- dark Logo text -->
                        Global Novalife
                    </span>
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse d-flex justify-content-end" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('back_assets/assets/images/users/1.jpg')}}" alt="user" class="rounded-circle"
                            width="40">
                        <span class="ml-2 d-none d-lg-inline-block">
                            <span>Hello,</span> 
                            <span class="text-dark">{{ Auth::user()->pseudo}}</span> 
                            <i data-feather="chevron-down" class="svg-icon"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <a class="dropdown-item" href="{{ route('network.change-password', ['which_password' => encrypt('password')]) }}"><i data-feather="lock"
                                class="svg-icon mr-2 ml-1"></i>
                            Changer mot de passe de connexion</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('network.change-password', ['which_password' => encrypt('transaction')]) }}"><i data-feather="lock"
                                class="svg-icon mr-2 ml-1"></i>
                            Changer mot de passe de transaction</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                            Se déconnecter
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
