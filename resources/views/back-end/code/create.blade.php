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
								<li class="breadcrumb-item">
                                    <a href="{{ route('code.list') }}">Codes</a>
								</li>
								<li class="breadcrumb-item active">
                                    <a href="{{ route('code.generate') }}">Générer</a>
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
                        <h3 class="text-white mb-0">Génération codes</h3>
                    </div>
					<div class="card-body">
                        {!! Form::open(['route' => 'code.generate-store']) !!}
                            @csrf
                            <div class="form-group {!! $errors->has('amount') ? 'has-error' : '' !!}">
                                {!! Form::label('amount', 'Nombre de codes à générer') !!}
                                {!! Form::number('amount', null, ['class' => 'form-control', 'placeholder' => 'Entrer une valeur']) !!}
                                {!! $errors->first('amount', '<small class="help-block text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group {!! $errors->has('transaction_password') ? 'has-error' : '' !!}">
                                {!! Form::label('transaction_password', 'Mot de passe de transaction') !!}
                                {!! Form::password('transaction_password', ['class' => 'form-control', 'placeholder' => 'Entrer votre mot de passe de transaction']) !!}
                                {!! $errors->first('transaction_password', '<small class="help-block text-danger">:message</small>') !!}
                                @if (session('error_transaction_password'))
                                    <small class="help-block text-danger"> {{ session('error_transaction_password') }} </small>
                                @endif
                            </div>
                            {!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
				</div>
			</div>
        </div><!--/.row-->

        </div>
		@include('partials.back-end.footer')
	</div>    
@endsection