<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Global Novalife</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="global novalife, global novallife, marketing de réseau, mlm, groupe leader, dakar, mlm sénégal, mlm senegal" />
        <meta name="description" content="Global Novalife est un réseau qui propose durablement à ses membres une capacité financière optimale et un cadre de vie plus agréable qui associe mieux vivre ensemble, mixité sociale et respect de l'environnement.">
		<meta name="author" content="">
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
		<!-- Custom CSS -->
		<link href="{{asset('back_assets/assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
		<link href="{{asset('back_assets/assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
		<link href="{{asset('back_assets/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
		<!-- Custom CSS -->
		<link href="{{asset('back_assets/dist/css/style.min.css')}}" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="{{asset('back_assets/assets/libs/jquery/dist/jquery.min.js')}}"></script>

		@yield('css')
	</head>
	<body>
		<!-- ============================================================== -->
		<!-- Preloader - style you can find in spinners.css)}} -->
		<!-- ============================================================== -->
		<div class="preloader">
			<div class="lds-ripple">
				<div class="lds-pos"></div>
				<div class="lds-pos"></div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- Main wrapper - style you can find in pages.scss -->
		<!-- ============================================================== -->
		<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
			data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
			@include('partials.back-end.nav')
			@include('partials.back-end.sidebar')
	
			@yield('main')
		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="{{asset('back_assets/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
		<script src="{{asset('back_assets/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
		<!-- apps -->
		<!-- apps -->
		<script src="{{asset('back_assets/dist/js/app-style-switcher.js')}}"></script>
		<script src="{{asset('back_assets/dist/js/feather.min.js')}}"></script>
		<script src="{{asset('back_assets/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
		<script src="{{asset('back_assets/dist/js/sidebarmenu.js')}}"></script>
		<!--Custom JavaScript -->
		<script src="{{asset('back_assets/dist/js/custom.min.js')}}"></script>
		<!--This page JavaScript -->
		<script src="{{asset('back_assets/assets/extra-libs/c3/d3.min.js')}}"></script>
		<script src="{{asset('back_assets/assets/extra-libs/c3/c3.min.js')}}"></script>
		<script src="{{asset('back_assets/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
		<script src="{{asset('back_assets/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
		@yield('js')
			
	</body>
</html>