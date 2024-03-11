@extends('layouts.front-end')

@section('main')    
    <!-- Sider Start -->
    <div class="slider">
        <div id="fawesome-carousel" class="carousel slide" data-ride="carousel">            
            <div class="carousel-inner" role="listbox">
                <div class="item active" style="height: 256px">
                    <img src="{{asset('front_assets/img/slider3.jpg')}}" alt="Sider Big Image">
                    <div class="carousel-caption">
                        <h2 class="wow fadeInLeft">Connexion</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sider End -->
    
</header>
<!-- Header End -->

  <!-- About Section -->
  <section class="site-padding py-2">
    <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <fieldset>
                        <legend>Formulaire de connexion</legend>
                        {!! Form::open(['route' => 'login']) !!}
                            @csrf
                            <div class="form-group row {!! $errors->has('pseudo') ? 'has-error' : '' !!}">
                                {!! Form::label('pseudo', 'Pseudo') !!}
                                {!! Form::text('pseudo', old('pseudo'), ['class' => 'form-control', 'placeholder' => 'Entrer votre pseudo', 'autofocus' => true, 'autocomplete' => 'pseudo', 'required' => true]) !!}
                                {!! $errors->first('pseudo', '<small class="help-block">:message</small>') !!}
                            </div>
            
                            <div class="form-group row {!! $errors->has('password') ? 'has-error' : '' !!}">
                                {!! Form::label('password', 'Mot de passe') !!}
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Entrer votre mot de passe', 'required' => true]) !!}
                                {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
            
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link pull-right mt-3" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié ?') }}
                                    </a>
                                @endif
                            </div>
            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    {!! Form::checkbox('remember', old('remember') ? 'checked' : '') !!}
                                    {!! Form::label('remember', 'Se souvenir de moi') !!}
                                </div>
                            </div>
            
                            <div class="form-group row">
                                <div class="col-md-4 offset-md-4">
                                    {!! Form::submit('Connexion', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </fieldset>
                </div>
            </div>
    </div>
  </section>
  <!-- About Section -->
@endsection