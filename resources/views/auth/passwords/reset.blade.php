@extends('layouts.front-end')

@section('main')    
    <!-- Sider Start -->
    <div class="slider">
        <div id="fawesome-carousel" class="carousel slide" data-ride="carousel">            
            <div class="carousel-inner" role="listbox">
                <div class="item active" style="height: 256px">
                    <img src="{{asset('front_assets/img/slider2.jpg')}}" alt="Sider Big Image">
                    <div class="carousel-caption">
                        <h2 class="wow fadeInLeft">Mise à jour de mot de passe de connexion</h2>
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
            <div class="mb-3 p-3 text-center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <fieldset>
                        <legend>Formulaire de réinitialisation de mot de passe</legend>
                        {!! Form::open(['route' => 'password.update']) !!}
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row {!! $errors->has('pseudo') ? 'has-error' : '' !!}">
                                {!! Form::label('pseudo', 'Pseudo') !!}
                                {!! Form::text('pseudo', $pseudo, ['class' => 'form-control', 'placeholder' => 'Entrer votre pseudo', 'autofocus' => true, 'required' => true]) !!}
                                {!! $errors->first('pseudo', '<small class="help-block">:message</small>') !!}
                            </div>
                        
                            <div class="form-group row {!! $errors->has('password') ? 'has-error' : '' !!}">
                                {!! Form::label('password', 'Nouveau mot de passe') !!}
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Entrer votre nouveau mot de passe', 'autocomplete' => 'new-password']) !!}
                                {!! $errors->first('password', '<small class="help-block text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group row {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
                                {!! Form::label('password_confirmation', 'Confirmer mot de passe') !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmer votre nouveau mot de passe', 'autocomplete' => 'new-password']) !!}
                                {!! $errors->first('password_confirmation', '<small class="help-block text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 col-md-offset-3">
                                    {!! Form::submit('Réinitialiser mot de passe', ['class' => 'btn btn-primary btn-block']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </fieldset>
                </div>
            </div>
    </div>
  </section>

@endsection
