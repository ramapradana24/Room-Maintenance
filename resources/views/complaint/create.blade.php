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
@section('title', 'Maintenance | Buat Pengaduan Baru')
@section('complaintActive', 'active')
@section('body')
		<!-- tambah pengaduan -->
<div class="row">
	<div class="col-sm-12">
		<div class="card card-tambah-jadwal">
			<div class="card-body">
				<p class="card-title">Tambah Pengaduan</p>
				<form class="col s12" action="/complaint" method="POST">
					{{csrf_field()}}
					<div class="form-group">
						<label class="form-label" for="kamar">Kamar</label>
						<select class="form-control" name="room" id="kamar" required>
							<option disabled selected>-- Pilih No Kamar --</option>
							@foreach($rooms as $room)
								<option value="{{$room->id}}">Kamar No.{{$room->number}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-label" for="inventory">Inventory</label>
						<select class="form-control" name="inventory" id="inventory" required>
							<option disabled selected>-- Pilih Kamar Terlebih Dahulu --</option>
						</select>
					</div>
					<div class="form-group">
						<label class="form-label" for="detail">Detail Kerusakan</label>
						<textarea name="detail" rows="5" id="detail" class="form-control" required></textarea>
					</div>
					<button type="submit" class="btn btn-success btn-block"><span class="fa fa-save"></span> SIMPAN</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- tambah pengaduan -->

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



		$("#kamar").change(function(){
			var value = jQuery("#kamar option:selected").val();
			var link ="{{url('inventory/')}}/"+value;	
			$.ajax({
			    type: 'get',
			    url: link,
			    success: function(data){
				    $('#inventory').html(data);
					$('select').material_select();
			    },
			    error: function(){
			     alert('error dalam mengambil data');
			    }
			   });
			});
	</script>
@endsection