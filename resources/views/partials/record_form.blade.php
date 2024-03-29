{!! Form::open(['route' => 'network.register-store']) !!}
    @csrf

    @if (session('error_payer_code'))
        <br>
        <p class="text-danger"> {{ session('error_payer_code') }} </p>
    @endif

    <fieldset>
        <legend>Informations du filleul</legend>

        <div class="form-group {!! $errors->has('last_name') ? 'has-error' : '' !!}">
            {!! Form::label('last_name', 'Nom') !!}
            {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => 'Entrer votre nom']) !!}
            {!! $errors->first('last_name', '<small class="help-block text-danger">:message</small>') !!}
        </div>

        <div class="form-group {!! $errors->has('first_name') ? 'has-error' : '' !!}">
            {!! Form::label('first_name', 'Prénoms') !!}
            {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'Entrer votre prénoms']) !!}
            {!! $errors->first('first_name', '<small class="help-block text-danger">:message</small>') !!}
        </div>

        <div class="form-group {!! $errors->has('pseudo') ? 'has-error' : '' !!}">
            {!! Form::label('pseudo', 'Pseudo') !!}
            {!! Form::text('pseudo', old('pseudo'), ['class' => 'form-control', 'placeholder' => 'Entrer votre pseudo']) !!}
            {!! $errors->first('pseudo', '<small class="help-block text-danger">:message</small>') !!}
        </div>

        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
            {!! Form::label('email', 'Adresse e-mail') !!}
            {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Entrer votre adresse e-mail']) !!}
            {!! $errors->first('email', '<small class="help-block text-danger">:message</small>') !!}
        </div>

        <div class="form-group {!! $errors->has('country') ? 'has-error' : '' !!}">
            {!! Form::label('country', 'Pays') !!}
            {!! Form::text('country', old('country'), ['class' => 'form-control', 'placeholder' => 'Entrer le nom de votre pays']) !!}
            {!! $errors->first('country', '<small class="help-block text-danger">:message</small>') !!}
        </div>

        <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
            {!! Form::label('password', 'Mot de passe') !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Entrer votre mot de passe']) !!}
            {!! $errors->first('password', '<small class="help-block text-danger">:message</small>') !!}
        </div>

        <div class="form-group {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
            {!! Form::label('password_confirmation', 'Confirmer mot de passe') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmer votre mot de passe']) !!}
            {!! $errors->first('password_confirmation', '<small class="help-block text-danger">:message</small>') !!}
        </div>

    </fieldset>

    {!! Form::submit('Enregister', ['class' => 'btn btn-primary pull-right']) !!}
{!! Form::close() !!}
