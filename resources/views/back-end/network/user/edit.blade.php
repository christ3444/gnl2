@extends('layouts.back-end')

@section('main')
	<div class="page-wrapper">
		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-12 align-self-center">
					<h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Hello {{ Auth::user()->pseudo }}!</h3>
					<div class="d-flex align-items-center">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb m-0 p-0">
								<li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a>
								</li>
                                <li class="breadcrumb-item"><a href="{{ route('network.users') }}">Utilisateurs</a></li>
                                <li class="breadcrumb-item active">Editer</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-dark">
                        <div class="card-header bg-dark">
                            <h3 class="text-white mb-0">Formulaire de mise à jour d'un utilisateur</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::model($user, ['route' => ['network.users.update', encrypt($user->id)], 'method' => 'put']) !!}
                                @csrf
                                    <div class="form-group {!! $errors->has('pseudo') ? 'has-error' : '' !!}">
                                        {!! Form::label('pseudo', 'Pseudo') !!}
                                        {!! Form::text('pseudo', $user->pseudo, ['class' => 'form-control', 'placeholder' => 'Entrer le nouveau pseudo']) !!}
                                        {!! $errors->first('pseudo', '<small class="help-block text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                        {!! Form::label('email', 'Adresse e-mail') !!}
                                        {!! Form::email('email', $user->person->email, ['class' => 'form-control', 'placeholder' => 'Entrer la nouvelle adresse e-mail']) !!}
                                        {!! $errors->first('email', '<small class="help-block text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group {!! $errors->has('last_name') ? 'has-error' : '' !!}">
                                        {!! Form::label('last_name', 'Nom') !!}
                                        {!! Form::text('last_name', $user->person->last_name, ['class' => 'form-control', 'placeholder' => 'Entrer le nouveau nom']) !!}
                                        {!! $errors->first('last_name', '<small class="help-block text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group {!! $errors->has('first_name') ? 'has-error' : '' !!}">
                                        {!! Form::label('first_name', 'Prénoms') !!}
                                        {!! Form::text('first_name', $user->person->first_name, ['class' => 'form-control', 'placeholder' => 'Entrer le nouveau prénoms']) !!}
                                        {!! $errors->first('first_name', '<small class="help-block text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group {!! $errors->has('country') ? 'has-error' : '' !!}">
                                        {!! Form::label('country', 'Pays') !!}
                                        {!! Form::text('country', $user->person->country, ['class' => 'form-control', 'placeholder' => 'Entrer le nom de votre pays']) !!}
                                        {!! $errors->first('country', '<small class="help-block text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                                        {!! Form::label('password', 'Mot de passe') !!}
                                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Entrer le nouveau mot de passe']) !!}
                                        {!! $errors->first('password', '<small class="help-block text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
                                        {!! Form::label('password_confirmation', 'Confirmer mot de passe') !!}
                                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmer le nouveau mot de passe']) !!}
                                        {!! $errors->first('password_confirmation', '<small class="help-block text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group {!! $errors->has('transaction_password') ? 'has-error' : '' !!}">
                                        {!! Form::label('transaction_password', 'Mot de passe de transaction') !!}
                                        {!! Form::password('transaction_password', ['class' => 'form-control', 'placeholder' => 'Entrer le nouveau mot de passe de transaction']) !!}
                                        {!! $errors->first('transaction_password', '<small class="help-block text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group {!! $errors->has('transaction_password_confirmation') ? 'has-error' : '' !!}">
                                        {!! Form::label('transaction_password_confirmation', 'Confirmer Mot de passe de transaction') !!}
                                        {!! Form::password('transaction_password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmer le nouveau mot de passe de transaction']) !!}
                                        {!! $errors->first('transaction_password_confirmation', '<small class="help-block text-danger">:message</small>') !!}
                                    </div>

                                {!! Form::submit('Mettre à jour', ['class' => 'btn btn-primary pull-right']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
		</div>
		@include('partials.back-end.footer')
	</div>
@endsection