<!-- Header Start -->
<header id="home">
    
    <!-- Main Menu Start -->
    <div class="main-menu">
        <div class="navbar-wrapper">
            <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                        <a href="{{ route('home') }}" class="navbar-brand"><h3 class="text-primary">Global Novalife</h3></a>							
                    </div>
                    
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{route('home')}}">Accueil</a></li>
                            <li><a href="{{route('home').'/#about'}}">A propos</a></li>
                            <li><a href="{{route('home').'/#evolution'}}">Evolution</a></li>
                            <li><a href="{{route('home').'/#motivation'}}">Motivation</a></li>
                            <li><a href="{{route('home').'/#specificity'}}">Spécificité</a></li>
                            <li><a href="{{route('home').'/#contact-us'}}">Contact</a></li>
                            <li><a href="{{route('home').'/#newsletter'}}">Newsletter</a></li>
                            <li><a href="{{route('home').'/plan_de_compensation.pdf'}}">Plan de compensation</a></li>
                            @guest
                                <li><a href="{{ route('login') }}">Connexion</a></li>
                                <li><a href="{{ route('network.register') }}">Admission</a></li>
                            @else
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            @endguest
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Main Menu End -->
    
