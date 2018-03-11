@extends('layouts.app')
@extends('layouts.sidebar')
@section('additionalStyle')
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/dataTables.bootstrap4.min.css')}}">
	@if($user_in->privilege_id == 1)
		<link rel="stylesheet" type="text/css" href="{{asset('style/css/dashboard.css')}}">
	@else
		<link rel="stylesheet" type="text/css" href="{{asset('style/css/dashboard_pegawai.css')}}">
	@endif
@endsection
@section('responsiveTitle', 'HOME')
@section('title', 'Maintenance | Home')
@section('homeActive', 'active')
@section('body')
<h4>Dashboard</h4>
<p>Selamat Datang di Panel Administrasi</p>

<!-- info data -->
<div class="row">
	<div class="col-sm-12 col-md-6 col-lg-4">
		<div class="card">
			<div class="card-body">
				<div class="data-db">
					<div class="data-img" style="background: #d5f6fb; border-color: #23d3eb">
						<span class="la la-area-chart" style="color: #23d3eb"></span>
					</div>
					<div class="data-detail">
						<span>{{ $count_complaint }}</span>
						<p>Jumlah Pengaduan</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6 col-lg-4">
		<div class="card">
			<div class="card-body">
				<div class="data-db">
					<div class="data-img" style="border-color: #fb7eaa; background: #fee2eb">
						<span class="la la-bar-chart-o" style="color: #fb7eaa"></span>
					</div>
					<div class="data-detail">
						<span>{{ $count_checked_room }}</span>
						<p>Jadwal Sudah Dicek</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6 col-lg-4">
		<div class="card">
			<div class="card-body">
				<div class="data-db">
					<div class="data-img" style="border-color: #6f63ba; background: #d9d5ec">
						<span class="la la-line-chart" style="color: #6f63ba"></span>
					</div>
					<div class="data-detail">
						<span>{{ $count_unchecked_room }}</span>
						<p>Jadwal Belum Dicek</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--<div class="col-sm-12 col-md-6 col-lg-3">
		<div class="card">
			<div class="card-body">
				<div class="data-db">
					<div class="data-img" style="border-color: #88cb70; background: #e4f5df">
						<span class="la la-pie-chart" style="color: #88cb70"></span>
					</div>
					<div class="data-detail">
						<span>24</span>
						<p>Jumlah pemasukan</p>
					</div>
				</div>
			</div>
		</div>
	</div> -->
</div>
<!-- info data -->


@if( $user_in->privilege_id == 1 )
<!-- datatable penjadwalan admin -->
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<p class="card-title">Tabel Penjadwalan</p>

					@if( !empty($maintenance[0]->id) )
						<!-- table -->
						<table id="tableJadwal" class="table table-stripped table-responsive" width="100%" cellspacing="0">
					        <thead>
					            <tr>
					                <th>No</th>
					                <th>No Kamar</th>
					                <th>Nama Pegawai</th>
					                <th>Tanggal Pengecekan</th>
					                <th>Status</th>
					                <th>Aksi</th>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php $i = 1; ?>
								@foreach ($maintenance as $mainten)
						            <tr>
						                <td>{{ $i }}</td>
						                <td>{{$mainten->number}}</td>
						                <td>{{$mainten->user_name}}</td>
						                <td>{{date("M jS, Y", strtotime($mainten->s_date))}}</td>
						                <td class="@if($mainten->m_status == 0)
											belum
										@else
											sudah
										@endif">
						                	<span class="la @if($mainten->m_status == 0)
											la-exclamation-circle
										@else
											la-check-circle
										@endif"></span> @if($mainten->m_status == 0)
											Belum
										@else
											Sudah
										@endif
						                </td>
						                <td>
						                	<div data-toggle="tooltip" data-placement="top" title="Hasil pengecekan">
						                		<button type="button" class="btn btn-success" onclick="showSchedule({{$mainten->id}})">
							                		<span class="fa fa-eye"></span>
							                	</button>
						                	</div>
						                </td>
						            </tr>
						            <?php $i++ ?>
						    	@endforeach
					        </tbody>
					    </table>
					    <!-- table -->
					@else
							<center>Belum ada jadwal yang dibuat oleh Admin</center>
					@endif
				</div>
			</div>
		</div>
	</div>
	<!-- datatable penjadwalan admin-->
@endif


@if( $user_in->privilege_id == 2 )
<!-- datatable penjadwalan pegawau -->
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
				@if(session()->has('message'))
					<div class="alert alert-success" role="alert">
						{{ session()->get('message') }}
					</div>
				@endif
					<p class="card-title">Tabel Penjadwalan</p>

					@if( !empty($user_maintenance[0]->id) )
						<!-- table -->
						<table id="tableJadwal" class="table table-stripped table-responsive" width="100%" cellspacing="0">
					        <thead>
					            <tr>
					                <th>No</th>
					                <th>No Kamar</th>
					                <th>Tanggal Pengecekan</th>
					                <th>Status</th>
					                <th>Aksi</th>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php $i = 1; ?>
								@foreach ($user_maintenance as $mainten)
						            <tr>
						                <td>{{ $i }}</td>
						                <td>{{$mainten->number}}</td>
						                <td>{{date("M jS, Y", strtotime($mainten->s_date))}}</td>
						                <td class="@if($mainten->m_status == 0)
											belum
										@else
											sudah
										@endif">
						                	<span class="la @if($mainten->m_status == 0)
											la-exclamation-circle
										@else
											la-check-circle
										@endif"></span> @if($mainten->m_status == 0)
											Belum
										@else
											Sudah
										@endif
						                </td>
						                <td>
						                	<div data-toggle="tooltip" data-placement="top" title="Hasil pengecekan">
						                		<button type="button" class="btn btn-info" onclick="showSchedule({{$mainten->id}})">
							                		<span class="fa fa-eye"></span>
							                	</button>
						                	</div>
						                	<div data-toggle="tooltip" data-placement="top" 
						                		@if($mainten->m_status == 0)
						                			title="Cek Sekarang"
						                		@endif>
						                		<button onclick="checknow({{$mainten->id}})" class="btn btn-info" 
						                			@if($mainten->m_status == 1)
						                				disabled
						                			@endif 
						                			>
							                		<span class="fa fa-edit"></span>
							                	</button>
						                	</div>
						                </td>
						            </tr>
						            <?php $i++ ?>
						    	@endforeach
					        </tbody>
					    </table>
					    <!-- table -->
					@else
							<center>Belum ada jadwal yang dibuat oleh Admin</center>
					@endif
				</div>
			</div>
		</div>
	</div>
	<!-- datatable penjadwalan pegawai-->
@endif

<!-- datatable pengaduan -->
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<p class="card-title">Tabel Pengaduan</p>
					
					@if( !empty($complaints[0]->id) )
					<!-- table -->
					<table id="tablePengaduan" class="table table-stripped table-responsive" width="100%" cellspacing="0">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>No Kamar</th>
				                <th>Barang Rusak</th>
				                <th>Tanggal Pengaduan</th>
				                <th>Status</th>
				                <th>Aksi</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php $i = 1; ?>
							@foreach ($complaints as $complaint)
				            <tr>
				                <td>{{ $i }}</td>
				                <td>{{$complaint->number}}</td>
				                <td>{{ $complaint->name }}</td>
				                <td>{{date("M jS, Y H:i:s", strtotime($complaint->created_at))}}</td>
				                <td class="@if($complaint->c_status == 0)
											belum
										@else
											sudah
										@endif">
				                	<span class="la @if($complaint->c_status == 0)
											la-exclamation-circle
										@else
											la-check-circle
										@endif"></span> @if($complaint->c_status == 0)
											Belum
										@else
											Sudah
										@endif
				                </td>
				                <td>
				                	<div data-toggle="tooltip" data-placement="top" title="Detail pengaduan">
				                		<button type="button" class="btn btn-success" onclick="showComplaint({{$complaint->id}})">
					                		<span class="fa fa-eye"></span>
					                	</button>
				                	</div>
				                </td>
				            </tr>
				            <?php $i++ ; ?>
				            @endforeach
				        </tbody>
				    </table>
				    <!-- table -->
				@else
					<center>Belum ada pengaduan yang dibuat</center>
				@endif

				</div>
			</div>
		</div>
	</div>
	<!-- datatable pengaduan -->

<!-- popup notification -->
<div id="alert-popover">
	<div class="wrapper">
		<div class="content-popover"></div>
	</div>
</div>
<!-- popup notification -->

<!-- modal lihat pengecekan -->
<div class="modal fade" id="modalJadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hasil Pengecekan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="show-maintenance">
				<!-- ajax will appear here -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- modal lihat pengecekan -->

<!-- modal show pengaduan -->
<div class="modal modal-large fade" id="modalPengaduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Pengaduan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="showComplaint">
				<!-- ajax will appear here -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- modalshow pengaduan -->


@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function(){

		function load_notif(){
			var link = "{{url('notification/')}}/"+{{$user_in->id}};
			$.ajax({
				type: 'get',
				url: link,
				success: function(data){
					$('#notif').html(data)
				},
				error: function(){
				}
			});
		}

		function load_count_notif(){
			var link = "{{url('notification/')}}/"+{{$user_in->id}}+"/unseen";
			
			$.ajax({
				type: 'get',
				url: link,
				success: function(data){
					$('#unseen-notification').html(data)
				},
				error: function(){
				}
			});
		}

		function load_last_notif(){
			var link = "{{url('notification/')}}/"+{{$user_in->id}}+"/loadlast";
			$.ajax({
				type: 'get',
				url: link,
				success: function(data){
					$('.content-popover').html(data);
				},
				error: function(){
				}
			});
		}

		load_notif();
		load_count_notif();
		load_last_notif();
		setInterval(function(){
			load_notif();
			load_count_notif();
		}, 3000);

		setInterval(function(){
			load_last_notif();
		}, 5000);
		
	});
	

	$('.dropdown-toggle').click(function(){
		$('#unseen-notification').html('');
		var link = "{{url('notification/')}}/"+{{$user_in->id}}+"/update";
		$.ajax({
			type: 'get',
			url: link, 
			error: function(){
			}
		})
	})

	function showSchedule(id){
		var link = "{{url('scheduling/')}}/"+id;
		$.ajax({
			type: 'get',
			url: link,
			success: function(data){
				$('#show-maintenance').html(data);
				$('#modalJadwal').modal('show');
			},
			error: function(){
			}
		});
	}

	function showComplaint(id){
		var link = "{{url('complaint/')}}/"+id;
		$.ajax({
			type: 'get',
			url: link,
			success: function(data){
				$('#showComplaint').html(data);
				$('#modalPengaduan').modal('show');
			},
			error: function(){
			}
		});
	}

	function checknow(id){
		document.location.href = 'scheduling/'+id+'/maintain';
	}


</script>
@endsection