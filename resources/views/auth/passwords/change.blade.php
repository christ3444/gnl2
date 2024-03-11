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
								<li class="breadcrumb-item active">
                                    <a href="{{ route('code.generate') }}">Changement de mot de passe
                    {{ $which_password === 'password' ? ' de connexion' : ' de transaction' }}</a>
								</li>
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
                        <h3 class="text-white mb-0">Formulaire de Changement de mot de passe{{ $which_password === 'password' ? ' de connexion' : ' de transaction' }}</h3>
                    </div>
					<div class="card-body">
                        {!! Form::open(['route' => ['network.change-password-store', 'which_password' => encrypt($which_password)]]) !!}
                            @csrf
                            <div class="form-group {!! $errors->has('old_password') ? 'has-error' : '' !!}">
                                {!! Form::label('old_password', 'Ancien mot de passe'.($which_password === 'password' ? ' de connexion' : ' de transaction')) !!}
                                {!! Form::password('old_password', ['class' => 'form-control', 'placeholder' => 'Entrer l\'ancien mot de passe'.($which_password === 'password' ? ' de connexion' : ' de transaction')]) !!}
                                {!! $errors->first('old_password', '<small class="help-block text-danger">:message</small>') !!}
                                @if (session('error_owner_password'))
                                    <small class="help-block text-danger"> {{ session('error_owner_password') }} </small>
                                @endif
                            </div>

                            <div class="form-group {!! $errors->has('new_password') ? 'has-error' : '' !!}">
                                {!! Form::label('new_password', 'Nouveau Mot de passe'.($which_password === 'password' ? ' de connexion' : ' de transaction')) !!}
                                {!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => 'Entrer le nouveau mot de passe'.($which_password === 'password' ? ' de connexion' : ' de transaction')]) !!}
                                {!! $errors->first('new_password', '<small class="help-block text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group {!! $errors->has('new_password_confirmation') ? 'has-error' : '' !!}">
                                {!! Form::label('new_password_confirmation', 'Confirmer mot de passe'.($which_password === 'password' ? ' de connexion' : ' de transaction')) !!}
                                {!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmer le nouveau mot de passe'.($which_password === 'password' ? ' de connexion' : ' de transaction')]) !!}
                                {!! $errors->first('new_password_confirmation', '<small class="help-block text-danger">:message</small>') !!}
                            </div>
                            
                            {!! Form::submit('Valider', ['class' => 'btn btn-primary pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
				</div>
			</div>
        </div><!--/.row-->

        </div>
		@include('partials.back-end.footer')
	</div>    
@endsection