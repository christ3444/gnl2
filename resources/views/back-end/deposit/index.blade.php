@extends('layouts.back-end')

@section('css')
   
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
                                <li class="breadcrumb-item active"><a href="{{ route('withdrawal-request.not_processed_history') }}">Dépots d'argent</a></li>
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
                            <h3 class="text-white mb-0">  @if ($admin ?? '') 
                                 Total dépot : {{$somme}} Fcfa
                                   @else 
                                  
                                   @endif </h3>
                          
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
                                      
                                    @if ($admin ?? '')                                        
                                        <th>User pseudo</th>
                                        <th>Date de dépot</th>
                                        
                                    @endif
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>User pseudo</td>
                                    <td>Date de depot</td>
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