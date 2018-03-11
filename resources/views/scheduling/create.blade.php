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
@section('title', 'Maintenance | Buat Jadwal Baru')
@section('scheduleActive', 'active')
@section('body')

<!-- Tambah Jadwal -->
	<div class="row">
		<div class="col-sm-12">
			<div class="card card-tambah-jadwal">
				<div class="card-body">
					<p class="card-title">Tambah Jadwal</p>
					
					<!-- form tambah jadwal -->
					<form action="/scheduling" method="POST">
						{{csrf_field()}}
						<div class="form-group">
							<label class="form-label" for="pegawai">Nama Pegawai</label>
							<select class="form-control" name="users" id="sl-nama-pegawai">
								<option disabled selected>-- Pilih Nama Pegawai --</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->user_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-label">No Kamar</label>
							<button type="button" class="btn btn-light btn-block" data-toggle="modal" data-target="#modalDaftarKamar"><span class="fa fa-list"></span> Daftar Kamar</button>
						</div>

						<!-- modal daftar kamar -->
						<div class="modal fade" id="modalDaftarKamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Daftar Kamar</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<!-- daftar kamar -->
										<div class="row" id="daftar-no-kamar">
											@foreach($rooms as $room)
												<div class="col-sm-6">
													<label class="label-check">
														<input type="checkbox" class="cuz-cb" name="rooms" value="{{$room->id}}" id="{{$room->id}}" >
														<span class="label-text"></span>Kamar No {{$room->number}}
													</label>
												</div>
											@endforeach
										</div>
										<!-- daftar kamar -->
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" id="reset-check-box">Kosongkan</button>
										<button type="button" class="btn btn-light" id="semua-check-box">Centang Semua</button>
										<button type="button" class="btn btn-success" data-dismiss="modal">Simpan</button>
									</div>
								</div>
							</div>
						</div>
						<!-- modal daftar kamar -->

						<div class="form-group">
							<label class="form-label" for="jml-tgl">Jumlah Tanggal Pengecekan</label>
							<select class="form-control" name="date" id="jml-tgl">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
							</select>
						</div>
						<div class="form-group">
							<label class="form-label">Tanggal Pengecekan</label>
							<div id="daftar-tgl">
								<input type="date" class="form-control" name="tgl1">
							</div>
						</div>
						<button type="submit" class="btn btn-success btn-block"><span class="fa fa-save"></span> SIMPAN</button>
					</form>
					<!-- form tambah jadwal -->
				</div>
			</div>
		</div>
	</div>
<!-- Tambah Jadwal -->

<!-- popup notification -->
<div id="alert-popover">
	<div class="wrapper">
		<div class="content-popover"></div>
	</div>
</div>
<!-- popup notification -->

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
</script>
@endsection