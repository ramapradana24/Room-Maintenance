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
@section('title', 'Maintenance | Notification')
@section('homeActive', 'active')

@section('body')

<!-- pemberitahuan -->
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<p class="card-title">Pemberitahuan</p>
					<p class="align-btn">
						<button type="button" class="btn btn-success" id="btn-bersihkan-pemberitahuan"><span class="fa fa-trash" ></span> Bersihkan</button>
					</p>
					<!-- daftar pemberitahuan -->
					<div class="daftar-pemberitahuan">
						<div class="pemberitahuan baru">
							<p class="isi"><span class="fa fa-user"></span> Pegawai <a href="#" class="hightlight"><b>Gus Arisna</b></a> terlambat melakukan pengecekan <b>Kamar No 101</b> pada tanggal <b>12 September 2017</b></p>
							<span class="waktu"><span class="fa fa-clock-o"></span> 1 Jam yang lalu</span>
						</div>
						<div class="pemberitahuan">
							<p class="isi"><span class="fa fa-user"></span> Pegawai <a href="#" class="hightlight"><b>Gus Arisna</b></a> terlambat melakukan pengecekan <b>Kamar No 101</b> pada tanggal <b>12 September 2017</b></p>
							<span class="waktu"><span class="fa fa-clock-o"></span> 1 Jam yang lalu</span>
						</div>
						<div class="pemberitahuan">
							<p class="isi"><span class="fa fa-user"></span> Pegawai <a href="#" class="hightlight"><b>Gus Arisna</b></a> terlambat melakukan pengecekan <b>Kamar No 101</b> pada tanggal <b>12 September 2017</b></p>
							<span class="waktu"><span class="fa fa-clock-o"></span> 1 Jam yang lalu</span>
						</div>
					</div>
					<!-- daftar pemberitahuan -->
				</div>
			</div>
		</div>
	</div>
	<!-- pemberitahuan -->

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