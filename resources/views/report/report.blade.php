@extends('layouts.app')
@extends('layouts.sidebar')
@section('additionalStyle')
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/dataTables.bootstrap4.min.css')}}">
	@if($user_in->privilege_id == 1)
		<link rel="stylesheet" type="text/css" href="{{asset('style/css/dashboard.css')}}">
	@else
		<link rel="stylesheet" type="text/css" href="{{asset('style/css/dashboard_pegawai.css')}}">
	@endif
	<script src="{{asset('style/js/sweetalert.min.js')}}"></script>
@endsection
@section('title', 'Maintenance | Report')
@section('reportActive', 'active')

@section('body')

<!-- datatable penjadwalan admin -->
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				@if(session()->has('message'))
					<div class="alert alert-success" role="alert">
						{{ session()->get('message') }}
					</div>
				@endif
				<center><p class="card-title">report pengeluaran perbaikan<br>tahun : {{date('Y', strtotime($year))}}</p></center>

				<p class="card-title"><br>Perbaikan Kerusakan dalam Pengaduan</p>
					<!-- table -->
					<table id="tableJadwal" class="table table-stripped table-responsive" width="100%" cellspacing="0">
				        <thead>
				            <tr>
				                <th>#</th>
				                <th>No Kamar</th>
				                <th>Tanggal Diperbaiki</th>
				                <th>Biaya Perbaikan</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php $i = 1; ?>
							@foreach ($report_complaint as $report)
					            <tr>
					                <td>{{ $i }}</td>
					                <td>{{$report->number}}</td>
					                <td>{{date("M jS, Y", strtotime($report->fixed_at))}}</td>
					                <td>{{ $report->cost }}</td>
					            </tr>
					            <?php $i++ ?>
					    	@endforeach
				        </tbody>
				    </table>
				    <p>Total Perbaikan : {{$total_cost_complaint[0]->total}}</p>
				    <!-- table -->


				<p class="card-title"><br>Perbaikan Kerusakan saat Pengecekan</p>
					<!-- table -->
					<table id="tablePengaduan" class="table table-stripped table-responsive" width="100%" cellspacing="0">
				        <thead>
				            <tr>
				                <th>#</th>
				                <th>No Kamar</th>
				                <th>Tanggal Diperbaiki</th>
				                <th>Biaya Perbaikan</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php $i = 1; ?>
							@foreach ($report_defect as $report)
					            <tr>
					                <td>{{ $i }}</td>
					                <td>{{$report->number}}</td>
					                <td>{{date("M jS, Y", strtotime($report->fixed_at))}}</td>
					                <td>{{ $report->cost }}</td>
					            </tr>
					            <?php $i++ ?>
					    	@endforeach
				        </tbody>
				    </table>
				    <!-- table -->
				    <p>Total Perbaikan : {{$total_cost_defect[0]->total}}</p>
			</div>
		</div>
	</div>
</div>
<!-- datatable penjadwalan admin-->

<!-- popup notification -->
<div id="alert-popover">
	<div class="wrapper">
		<div class="content-popover"></div>
	</div>
</div>
<!-- popup notification -->

<script>
	function hapus(){
		swal({
		  title: "Anda yakin?",
		  text: "Jadwal akan terhapus secara permanen!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		    swal({
		    	title: "Jadwal Terhapus!",
				text: "Hapus Jadwal berhasil!",
				icon: "success",
				button: "OK",
		    })
			.then((value) => {
			    event.preventDefault();
				document.getElementById('delete-form').submit();
			});
		  } else {
		    swal("Batal Menghapus Jadwal");
		  }
		});
	}

</script>

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

		function editSchedule(id){
			var link = "{{url('scheduling/')}}/"+id+"/edit";
			$.ajax({
				type: 'get',
				url: link,
				success: function(data){
					$('#editSchedule').html(data);
					$('#modalEditJadwal').modal('show');
				},
				error: function(){
				}
			});
		}
	</script>
@endsection