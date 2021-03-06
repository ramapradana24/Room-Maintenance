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
@section('title', 'Maintenance | Penjadwalan')
@section('scheduleActive', 'active')

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
					                		<button type="button" class="btn btn-success" onclick="showSchedule({{$mainten->id}});">
						                		<span class="fa fa-eye"></span>
						                	</button>
					                	</div>
					                	<div data-toggle="tooltip" data-placement="top" title="Edit jadwal">
						                	<button type="button" class="btn btn-primary btn-edit-jadwal" onclick="editSchedule({{$mainten->id}})">
						                		<span class="fa fa-pencil"></span>
						                	</button>
						                </div>
						                <div data-toggle="tooltip" data-placement="top" title="Hapus jadwal">
						                	<button type="button" class="btn btn-danger"  onclick="hapus()">
						                		<span class="fa fa-trash"></span>
						                	</button>
						                	<form action="/scheduling/{{$mainten->id}}" method="POST" style="display: none;" id="delete-form">
												{{csrf_field()}}
												{{method_field('DELETE')}}
											</form>
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

<!-- popup notification -->
<div id="alert-popover">
	<div class="wrapper">
		<div class="content-popover"></div>
	</div>
</div>
<!-- popup notification -->

<!-- float button add shcedule -->
<div class="float-btn">
	<a href="/scheduling/create" class="btn-success" data-toggle="tooltip" data-placement="top" title="Tambah Jadwal"><span class="fa fa-plus"></span></a>
</div>
<!-- float button add shcedule -->

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

<!-- modal edit jadwal -->
<div class="modal fade" id="modalEditJadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Jadwal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="editSchedule">
				<!-- ajax result will be appear here -->	
			</div>
			
		</div>
	</div>
</div>
<!-- modal edit jadwal -->

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