@extends('layouts.app')
@extends('layouts.sidebar')
@section('additionalStyle')
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/dataTables.bootstrap4.min.css')}}">
	@if($user_in->privilege_id == 1)
		<link rel="stylesheet" type="text/css" href="{{asset('style/css/dashboard.css')}}">
	@else
		<link rel="stylesheet" type="text/css" href="{{asset('style/css/dashboard_pegawai.css')}}">
	@endif
	<script type="text/javascript" src="{{asset('style/js/sweetalert.min.js')}}"></script>
@endsection
@section('title', 'Maintenance | Pengaduan')
@section('complaintActive', 'active')

@section('body')

<!-- datatable pengaduan -->
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				@if(session()->has('message'))
					<div class="alert alert-success" role="alert">
						{{ session()->get('message') }}
					</div>
				@endif
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
				                <div data-toggle="tooltip" data-placement="top" title="Edit pengaduan">
				                	<button type="button" class="btn btn-primary btn-edit-jadwal" onclick="editComplaint({{$complaint->id}})">
				                		<span class="fa fa-pencil"></span>
				                	</button>
				                </div>
				                <div data-toggle="tooltip" data-placement="top" title="Perbaiki Sekarang">
				                	<button type="button" class="btn btn-primary btn-edit-jadwal" onclick="fixit({{$complaint->id}})" @if( $complaint->c_status ==1 ) disabled @endif>
				                		<span class="fa fa-wrench"></span>
				                	</button>
				                </div>
				                <div data-toggle="tooltip" data-placement="top" title="Hapus pengaduan">
				                	<button type="button" class="btn btn-danger"  onclick="hapus();">
				                		<span class="fa fa-trash"></span>
				                	</button>
				                	<form action="/complaint/{{$complaint->id}}" method="POST" style="display: none;" id="delete-form">
											{{csrf_field()}}
											{{method_field('DELETE')}}
									</form>
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

<!-- floating buttom add-->
<div class="float-btn">
	<a href="/complaint/create" class="btn-success" data-toggle="tooltip" data-placement="top" title="Tambah Pengaduan"><span class="fa fa-plus"></span></a>
</div>
<!-- floating buttom add-->

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

<!-- modal edit pengaduan -->
<div class="modal fade" id="modalEditPengaduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Pengaduan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="editComplaint">
				<!-- ajax result will be appear here -->	
			</div>
			
		</div>
	</div>
</div>
<!-- modal edit pengaduan -->

<!-- modal fix kerusakan -->
<div class="modal modal-large fade" id="modalFixit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Perbaiki Kerusakan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="fixdefect">
				<!-- ajax will appear here -->
			</div>

		</div>
	</div>
</div>
<!-- modal fix kerusakan -->

<script>
	function hapus(){
		swal({
		  title: "Anda yakin?",
		  text: "Pengaduan akan terhapus secara permanen!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		    swal({
		    	title: "Pengaduan Terhapus!",
				text: "Hapus Pengaduan berhasil!",
				icon: "success",
				button: "OK",
		    })
			.then((value) => {
			    event.preventDefault();
				document.getElementById('delete-form').submit();
			});
		  } else {
		    swal("Batal Menghapus Pengaduan");
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

	function fixit(id){
		var link = "{{url('complaint/')}}/"+id+"/fixit";
		$.ajax({
			type: 'get',
			url: link,
			success: function(data){
				$('#fixdefect').html(data);
				$('#modalFixit').modal('show');
			},
			error: function(){
			}
		});
	}

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

		function editComplaint(id){
			var link = "{{url('complaint/')}}/"+id+"/edit";
			$.ajax({
				type: 'get',
				url: link,
				success: function(data){
					$('#editComplaint').html(data);
					$('#modalEditPengaduan').modal('show');
				},
				error: function(){
				}
			});
		}
	</script>
@endsection