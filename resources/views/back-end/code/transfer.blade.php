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
                                <li class="breadcrumb-item"><a href="{{ route('code.mine') }}">Codes</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('code.transfer') }}">Transférer des codes</a></li>
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
                            <h3 class="text-white mb-0">Formulaire de transfeert de codes</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => 'code.transfer-store']) !!}
                                @csrf

                                <div class="form-group {!! $errors->has('recever_pseudo') ? 'has-error' : '' !!}">
                                    {!! Form::label('recever_pseudo', 'Pseudo du receveur') !!}
                                    {!! Form::text('recever_pseudo', null, ['class' => 'form-control', 'placeholder' => 'Entrer le pseudo du receveur', 'autocomplete' => false]) !!}
                                    {!! $errors->first('recever_pseudo', '<small class="help-block text-danger">:message</small>') !!}
                                    @if (session('error_recever_pseudo'))
                                        <small class="help-block text-danger"> {{ session('error_recever_pseudo') }} </small>
                                    @endif

                                </div>

                                <div class="form-group {!! $errors->has('amount') ? 'has-error' : '' !!}">
                                    {!! Form::label('amount', 'Nombre de codes à transférer') !!}
                                    {!! Form::number('amount', null, ['class' => 'form-control', 'placeholder' => 'Entrer une valeur', 'min' => 1]) !!}
                                    {!! $errors->first('amount', '<small class="help-block text-danger">:message</small>') !!}
                                    @if (session('error_amount'))
                                        <small class="help-block text-danger"> {{ session('error_amount') }} </small>
                                    @endif

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