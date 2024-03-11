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
                                <li class="breadcrumb-item"><a href="{{ route('leading-group.list') }}">Groupes Leaders</a></li>
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
                            <h3 class="text-white mb-0">Formulaire de mise à jour d'un groupe leader</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::model($leading_group, ['route' => ['leading-group.edit-store', encrypt($leading_group->id)], 'method' => 'put']) !!}
                                @csrf
                                <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                    {!! Form::label('name', 'Nom') !!}
                                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Entrer le nom du groupe leader']) !!}
                                    {!! $errors->first('name', '<small class="help-block text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group {!! $errors->has('country') ? 'has-error' : '' !!}">
                                    {!! Form::label('country', 'Pays') !!}
                                    {!! Form::text('country', old('country'), ['class' => 'form-control', 'placeholder' => 'Entrer le pays du groupe leader']) !!}
                                    {!! $errors->first('country', '<small class="help-block text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group {!! $errors->has('responsible_identity') ? 'has-error' : '' !!}">
                                    {!! Form::label('responsible_identity', 'Nom du responsable') !!}
                                    {!! Form::text('responsible_identity', old('responsible_identity'), ['class' => 'form-control', 'placeholder' => 'Entrer le nom du responsable du groupe leader']) !!}
                                    {!! $errors->first('responsible_identity', '<small class="help-block text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group {!! $errors->has('contact') ? 'has-error' : '' !!}">
                                    {!! Form::label('contact', 'Nombre de codes à générer') !!}
                                    {!! Form::tel('contact', old('contact'), ['class' => 'form-control', 'placeholder' => 'Ex: +229 96 00 00 00']) !!}
                                    {!! $errors->first('contact', '<small class="help-block text-danger">:message</small>') !!}
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