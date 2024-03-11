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
                                <li class="breadcrumb-item"><a href="#">Traçabilité</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('mark.recording-transaction-history') }}">Enregistrements</a></li>
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
                            <h3 class="text-white mb-0">Historique des enregistrements</h3>
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
                                        @role('admin')                                        
                                            <th>Pseudo du payeur</th>
                                        @endrole
                                        <th>Pseudo du filleul</th>
                                        <th>Montant</th>
                                        <th>Date d'enregistrement</th>
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
        var admin = @json($admin);
        $(function () {
            var table = admin ? $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mark.recording-transaction-history') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'payer_pseudo', name: 'payer_pseudo'},
                    {data: 'recorded_pseudo', name: 'recorded_pseudo'},
                    {data: 'amount', name: 'amount'},
                    {data: 'created_at', name: 'created_at'},
                ]
            }) : 
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mark.recording-transaction-history') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'recorded_pseudo', name: 'recorded_pseudo'},
                    {data: 'amount', name: 'amount'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });    
        });        
    </script>
@endsection