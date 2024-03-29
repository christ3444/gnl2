@extends('layouts.back-end')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

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
                                <li class="breadcrumb-item"><a href="{{ route('mark.action') }}">Traçabilité</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('mark.action') }}">Actions</a></li>

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
                            <h3 class="text-white mb-0">Historique des actions menées sur la plateforme</h3>
                        </div>

                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert bg-success text-white" role="alert">
                                    {{ session('success') }} 
                                    <a href="#" class="pull-right close" data-dismiss="alert" aria-label="close">
                                        <em class="fa fa-lg fa-close"></em>
                                    </a>
                                </div>
                            @endif

                            @if (session()->has('error'))
                                <div class="alert bg-danger text-white" role="alert">
                                    {{ session('error') }} 
                                    <a href="#" class="pull-right close" data-dismiss="alert" aria-label="close">
                                        <em class="fa fa-lg fa-close"></em>
                                    </a>
                                </div>
                            @endif
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Pseudo du faiseur</th>
                                        <th>Action</th>
                                        <th>Description</th>
                                        <th>Date d'occurence</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
		</div>
		@include('partials.back-end.footer')
	</div>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mark.action') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'mark_code', name: 'mark_code'},
                    {data: 'occurrer_pseudo', name: 'occurrer_pseudo'},
                    {data: 'mark_action', name: 'mark_action'},
                    {data: 'description', name: 'description'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });    
        });        
    </script>
@endsection