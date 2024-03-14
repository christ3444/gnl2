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
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
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

			@if(!$have_pay)
			<div class="alert bg-warning text-white" role="alert">
               <span class="text-" >Votre compte n'a pas encore été activé !  </span>
                <a href="/paynow-{{Auth::user()->id}}" >
                    <span> Activer maintenant</span>
                </a>
            </div>
			@endif	

			<!-- *************************************************************** -->
			<!-- Start First Cards -->
			<!-- *************************************************************** -->
			<div class="card-group">
				<div class="card border-right">
					<div class="card-body">
						<div class="d-flex d-lg-flex d-md-block align-items-center">
							<div>
								<div class="d-inline-flex align-items-center">
									<h2 class="text-dark mb-1 font-weight-medium">{{$my_recordings}}</h2>
								</div>
								<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Inscriptions</h6>
							</div>
							<div class="ml-auto mt-md-3 mt-lg-0">
								<span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="card border-right">
					<div class="card-body">
						<div class="d-flex d-lg-flex d-md-block align-items-center">
							<div>
								<h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
										class="set-doller">FCFA</sup>{{$my_balance}}</h2>
								<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Solde
								</h6>
							</div>
							<div class="ml-auto mt-md-3 mt-lg-0">
								<span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="card border-right">
					<div class="card-body">
						<div class="d-flex d-lg-flex d-md-block align-items-center">
							<div>
								<div class="d-inline-flex align-items-center">
									<h2 class="text-dark mb-1 font-weight-medium">{{$my_codes}}</h2>
								</div>
								<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
								
								Codes restants</h6>
							</div>
							<div class="ml-auto mt-md-3 mt-lg-0">
								<span class="opacity-7 text-muted"><i data-feather="lock"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="d-flex d-lg-flex d-md-block align-items-center">
							<div>
								<h2 class="text-dark mb-1 font-weight-medium">{{$my_level}}</h2>
								<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Niveau</h6>
							</div>
							<div class="ml-auto mt-md-3 mt-lg-0">
								<span class="opacity-7 text-muted"><i data-feather="sunrise"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- *************************************************************** -->
			<!-- End First Cards -->
			<!-- *************************************************************** -->
			{{-- @role('admin')
				<!-- *************************************************************** -->
				<!-- Start Charts Section -->
				<!-- *************************************************************** -->
				<div class="row">
					<div class="col-lg-4 col-md-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Graphe des niveaux</h4>
								<div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
								<ul class="list-style-none mb-0">
									<li>
										<i style="color: #FE9A2E" class="fas fa-circle font-10 mr-2"></i>
										<span class="text-muted">Niveau 0</span>
										<span class="text-dark float-right font-weight-medium">{{ $level_stats['zero'] }}</span>
									</li>
									<li class="">
										<i style="color: #81F79F" class="fas fa-circle font-10 mr-2"></i>
										<span class="text-muted">Niveau 1</span>
										<span class="text-dark float-right font-weight-medium">{{ $level_stats['one'] }}</span>
									</li>
									<li class="">
										<i style="color: #BF00FF" class="fas fa-circle font-10 mr-2"></i>
										<span class="text-muted">Niveau 2</span>
										<span class="text-dark float-right font-weight-medium">{{ $level_stats['two'] }}</span>
									</li>
									<li>
										<i style="color: #013ADF" class="fas fa-circle font-10 mr-2"></i>
										<span class="text-muted">Niveau 3</span>
										<span class="text-dark float-right font-weight-medium">{{ $level_stats['three'] }}</span>
									</li>
									<li class="">
										<i style="color: #424242" class="fas fa-circle font-10 mr-2"></i>
										<span class="text-muted">Niveau 4</span>
										<span class="text-dark float-right font-weight-medium">{{ $level_stats['four'] }}</span>
									</li>
									<li class="">
										<i style="color: #0B1907" class="fas fa-circle font-10 mr-2"></i>
										<span class="text-muted">Niveau 5</span>
										<span class="text-dark float-right font-weight-medium">{{ $level_stats['five'] }}</span>
									</li>
									<li class="">
										<i style="color: #61210B" class="fas fa-circle font-10 mr-2"></i>
										<span class="text-muted">Niveau 6</span>
										<span class="text-dark float-right font-weight-medium">{{ $level_stats['six'] }}</span>
									</li>
									<li class="">
										<i style="color: #00FF00" class="fas fa-circle font-10 mr-2"></i>
										<span class="text-muted">Niveau 7</span>
										<span class="text-dark float-right font-weight-medium">{{ $level_stats['seven'] }}</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Graphe des enregistrements</h4>
								<div class="net-income mt-4 position-relative" style="height:294px;"></div>
								<ul class="list-inline text-center mt-5 mb-2">
									<li class="list-inline-item text-muted font-italic">Enregistrement mensuel</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-4">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Recent Activity</h4>
								<div class="mt-4 activity">
									@foreach ($marks as $mark)
										<div class="d-flex align-items-start border-left-line pb-3">
											<div>
												<a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
													<i data-feather="activity"></i>
												</a>
											</div>
											<div class="ml-3 mt-2">
												<h5 class="text-dark font-weight-medium mb-2">{{$mark->action->action}}</h5>
												<p class="font-14 mb-2 text-muted">
													{{ $mark->description }}
												</p>
												<span class="font-weight-light font-14 text-muted"> {{ $mark->created_at->diffForHumans() }} </span>
											</div>
										</div>									
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- *************************************************************** -->
				<!-- End Sales Charts Section -->
				<!-- *************************************************************** -->
			@endrole --}}
			<!-- *************************************************************** -->
			<!-- Start Top Leader Table -->
			<!-- *************************************************************** -->
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-center mb-4">
								<h4 class="card-title">Table de mes enregistrements</h4>
								<div class="ml-auto">
									<a class="btn btn-info pull-right" href="{{ route('mark.recording-transaction-history') }}">
										Voir <i class="fa fa-plus"></i>
									</a>
								</div>
							</div>
							<div class="table-responsive">
								@if (is_not_empty($my_recordings_traces))
									<table class="table no-wrap v-middle mb-0">
										<thead>
											<tr class="border-0">
												<th class="border-0 font-14 font-weight-medium text-muted">Filleul
												</th>
												<th class="border-0 font-14 font-weight-medium text-muted px-2">Montant
												</th>
												<th class="border-0 font-14 font-weight-medium text-muted">Date d'ajout</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($my_recordings_traces as $my_recordings_trace)
												<tr>
													<td class="border-top-0 px-2 py-4">
														{{ $my_recordings_trace->recorded_pseudo }}
													</td>
													<td class="border-top-0 text-muted px-2 py-4 font-14">
														{{ $my_recordings_trace->amount }}
													</td>
													<td class="border-top-0 px-2 py-4">
														{{ $my_recordings_trace->created_at }}
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								@else
									<p class="text-center">
										Aucune entrée pour le moment
									</p>
								@endif
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-6 col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-center mb-4">
								<h4 class="card-title">Table des membres phares</h4>								
							</div>
							<div class="table-responsive">
								@if (is_not_empty($flagship_members))
									<table class="table no-wrap v-middle mb-0">
										<thead>
											<tr class="border-0">
												<th class="border-0 font-14 font-weight-medium text-muted">Pseudo
												</th>
												<th class="border-0 font-14 font-weight-medium text-muted px-2">Niveau
												</th>
												<th class="border-0 font-14 font-weight-medium text-muted">Pays</th>
											</tr>
										</thead>
										<tbody>
											@if (is_not_empty($flagship_members))
												@foreach ($flagship_members as $flagship_member)
													<tr>
														<td class="border-top-0 px-2 py-4">
															{{ $flagship_member->user->pseudo }}
														</td>
														<td class="border-top-0 text-muted px-2 py-4 font-14">
															{{ $flagship_member->level_label }}
														</td>
														<td class="border-top-0 px-2 py-4">
															{{ $flagship_member->country }}
														</td>
													</tr>
												@endforeach
											@else
												<p class="text-center">
													Aucune entrée pour le moment
												</p>
											@endif
										</tbody>
									</table>
								@else
									<p class="text-center">
										Aucune entrée pour le moment
									</p>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- *************************************************************** -->
			<!-- End Top Leader Table -->
			<!-- *************************************************************** -->
		</div>
		@include('partials.back-end.footer')
	</div>
@endsection

@section('js')
	<script src="{{asset('back_assets/dist/js/pages/dashboards/dashboard1.min.js')}}"></script>
	<script src="{{asset('back_assets/assets/libs/chartist/dist/chartist.min.js')}}"></script>
	<script src="{{asset('back_assets/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
@endsection