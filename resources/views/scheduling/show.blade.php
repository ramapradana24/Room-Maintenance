@extends('layouts.app')
@extends('layouts.adminsidebar')
@section('additionalStyle')
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/home.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/jquery.dataTables.min.css')}}">
@endsection
@section('title', 'View Schedule')
@section('scheduleActive', 'active')

@section('body')
<div class="row row-table">
			<div class="col s12">
				<div class="card">
					<div class="card-content white text">
				<center><h4>Data Pengecekan</h4></center>
				<p class="status belum"><span class="fa 
					@if($maintenances[0]->m_status == 0)
						fa-exclamation-circle
					@else
						fa-check-circle
					@endif
					"></span> 
					@if($maintenances[0]->m_status == 0)
						Belum Dicek
					@else
						Sudah Dicek
					@endif
				</p>
				<p class="pegawai"><span class="fa fa-user"></span> {{ $maintenances[0]->user_name }}</p>
				<p class="kamar"><span class="fa fa-home"></span> Kamar {{ $maintenances[0]->number }}</p>
				<p class="tanggal"><span class="fa fa-calendar"></span> {{ date("M jS, Y", strtotime($maintenances[0]->s_date)) }}</p>
				

				<ul class="collapsible" data-collapsible="accordion">
					@foreach($maintenances as $maintenance)
					<li>
						<div class="collapsible-header">
							<span class="item">{{$maintenance->name}}</span>
							<span class="fa 
								@if($maintenance->status == 0)
									fa-exclamation-circle
								@else
									fa-check-circle
								@endif">
							</span>
						</div>
						<div class="collapsible-body">
							<small style="display: block;">Detail :</small>
							<span>{{$maintenance->description}}</span>
						</div>
					</li>	
					@endforeach
					
				</ul>

			</div>

		</div>
	</div>
</div>
</div>
	
		<!-- /modal popup -->

@endsection