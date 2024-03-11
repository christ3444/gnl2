<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Global Novalife</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="global novalife, global novallife, marketing de réseau, mlm, groupe leader, dakar, mlm sénégal, mlm senegal" />
    <meta name="description" content="Global Novalife est un réseau qui propose durablement à ses membres une capacité financière optimale et un cadre de vie plus agréable qui associe mieux vivre ensemble, mixité sociale et respect de l'environnement.">
    <meta property="og:title" content="Global Novalife">
    <meta property="og:url" content="/" />
    <meta property="og:description" content="Un réseau fiable et lucratif, Global Novalife disponible !">
    <meta property="og:image" content="/favicon.jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:locale:alternate" content="en_US" />
    <link rel="apple-touch-icon" href="/favicon.jpeg">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.jpeg">

    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,700,600italic,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- Font -->
    <link rel="stylesheet" href="{{asset('front_assets/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/css/responsive.css')}}">
    <script src="{{asset('front_assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    @yield('css')
  </head>
  <body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    @include('partials.front-end.nav')

    @yield('main')
  
    @include('partials.front-end.footer')

    <script src="{{asset('front_assets/js/vendor/jquery-1.12.0.min.js')}}"></script>
    <script src="{{asset('front_assets/js/plugins.js')}}"></script>
    <script src="{{asset('front_assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front_assets/js/jquery.mousewheel-3.0.6.pack.js')}}"></script>
    <script src="{{asset('front_assets/js/paralax.js')}}"></script>
    <script src="{{asset('front_assets/js/jquery.smooth-scroll.js')}}"></script>
    <script src="{{asset('front_assets/js/jquery.sticky.js')}}"></script>
    <script src="{{asset('front_assets/js/wow.min.js')}}"></script>
    <script src="{{asset('front_assets/js/main.js')}}"></script>		
    <script src="{{asset('front_assets/js/custom.js')}}"></script>
    {{-- Google Analytics: change UA-XXXXX-X to be your site's ID.
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='https://www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X','auto');ga('send','pageview');
    </script>  --}}

    @yield('js')
  </body>
</html>