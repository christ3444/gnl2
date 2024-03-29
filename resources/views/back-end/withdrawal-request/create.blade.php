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
                                <li class="breadcrumb-item"><a href="{{ route('withdrawal-request.processed_history') }}">Demandes de retrait</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('withdrawal-request.submit') }}">Soumettre</a></li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                @if (session()->has('error'))
                                <div class="alert bg-danger text-white" role="alert">
                                    {{ session('error') }} 
                                    <a href="#" class="pull-right close" data-dismiss="alert" aria-label="close">
                                        <em class="fa fa-lg fa-close"></em>
                                    </a>
                                </div>
                            @endif
                    <div class="card border-dark">
                        <div class="card-header bg-dark">
                            <h3 class="text-white mb-0">Formulaire de demande de retrait</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => 'withdrawal-request.submit-store']) !!}
                                @csrf                              

                                <div class='form-group'>
                                <input id="" type="text" class="form-control" name="adress" value="" required placeholder="adresse PM USD">

                                </div>

                                <div class="form-group {!! $errors->has('amount') ? 'has-error' : '' !!}">
                                    {!! Form::label('amount', 'Montant') !!}
                                    {!! Form::number('amount', old('amount'), ['class' => 'form-control', 'placeholder' => 'Entrer le montant du retrait']) !!}
                                    {!! $errors->first('amount', '<small class="help-block text-danger">:message</small>') !!}
                                </div> 

                                {!! Form::submit('Soumettre', ['class' => 'btn btn-primary pull-right']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
		</div>
		@include('partials.back-end.footer')
	</div>
@endsection