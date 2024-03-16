@extends('layouts.front-end')

@section('main')
    <!-- Sider Start -->
    <div class="slider">
        <div id="fawesome-carousel" class="carousel slide" data-ride="carousel">            
            <div class="carousel-inner" role="listbox">
                <div class="item active" style="height: 406px ; width:100%">
                    <img src="{{asset('front_assets/img/pm.png')}}" alt="Sider Big Image" style="width:100%">
                    <div class="carousel-caption">
                        <!-- <h2 class="wow fadeInLeft">Payez avec Perfect Money</h2> -->
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


        <form action="https://perfectmoney.com/api/step1.asp" method="POST">
            <input type="hidden" name="PAYEE_ACCOUNT" value="U41179207">
            <input type="hidden" name="PAYEE_NAME" value="Global Novalife">
            <input type="hidden" name="PAYMENT_ID" value="Global Novalife">
            <input type="hidden" name="PAYMENT_AMOUNT" value="0.1">
            <input type="hidden" name="PAYMENT_UNITS" value="USD">
            <input type="hidden" name="STATUS_URL" value="http://127.0.0.1:8000/paysuccess'">
            <input type="hidden" name="PAYMENT_URL" value="http://127.0.0.1:8000/paysuccess'">
            <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
            <input type="hidden" name="NOPAYMENT_URL" value="https://pay-chap.com/register">
            <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
            <input type="hidden" name="SUGGESTED_MEMO" value="">
            <input type="hidden" name="pseudo" value="{{$id}}">
            <input type="hidden" name="BAGGAGE_FIELDS" value="pseudo">
            <input type="submit" name="PAYMENT_METHOD" value="Pay Now!">
        </form>
        </div>
      </div>
    </div>
  </section>
  <!-- About Section -->
@endsection
