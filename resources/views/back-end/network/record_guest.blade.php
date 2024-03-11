@extends('layouts.front-end')

@section('main')
    <!-- Sider Start -->
    <div class="slider">
        <div id="fawesome-carousel" class="carousel slide" data-ride="carousel">            
            <div class="carousel-inner" role="listbox">
                <div class="item active" style="height: 256px">
                    <img src="{{asset('front_assets/img/slider3.jpg')}}" alt="Sider Big Image">
                    <div class="carousel-caption">
                        <h2 class="wow fadeInLeft">Inscription</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sider End -->
    
</header>
<!-- Header End -->

  <!-- About Section -->
  <section id="about" class="site-padding">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
            @if (session()->has('success'))
                <div class="alert bg-success text-white mb-3" role="alert">
                    {{ session('success') }} 
                    <a href="#" class="pull-right close" data-dismiss="alert" aria-label="close">
                        <em class="fa fa-lg fa-close"></em>
                    </a>
                </div>
            @endif
            @include('partials.record_form')
        </div>
      </div>
    </div>
  </section>
  <!-- About Section -->
@endsection
