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
                                <li class="breadcrumb-item active"><a href="{{ route('withdrawal-request.not_processed_history') }}">Demandes de retrait non traitées</a></li>
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
                        <div class="card-header bg-dark d-flex justify-content-between">
                            <h3 class="text-white mb-0">Historique de demandes de retrait non traitées</h3>
                            {!! link_to_route('withdrawal-request.submit', 'Soumettre', null, ['class' => 'btn btn-info pull-right']) !!}
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
                                        @if ($admin)                                        
                                            <th>Pseudo du demandeur</th>
                                        @endif
                                        <th>Groupe leader</th>
                                        <th>Montant</th>
                                        <th>Date de demande</th>
                                        <th>Statut</th>
                                        @role('admin')
                                            <th width="100px">Action</th>
                                        @endrole
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
        var admin = (@json($admin));
        $(function () {
            var table = admin ? $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('withdrawal-request.not_processed_history') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'claimant_pseudo', name: 'claimant_pseudo'},
                    {data: 'leading_group_name', name: 'leading_group_name'},
                    {data: 'amount', name: 'amount'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            }) : 
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('withdrawal-request.not_processed_history') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'leading_group_name', name: 'leading_group_name'},
                    {data: 'amount', name: 'amount'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });    
        });        
    </script>
@endsection