@extends('layouts.app')
@extends('layouts.adminsidebar')
@section('additionalStyle')
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/home.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/jquery.dataTables.min.css')}}">
@endsection
@section('title', 'Edit Schedule')
@section('scheduleActive', 'active')

@section('body')

<!-- Todo -->


<div class="row row-table">
	<div class="col s12">
		<div class="card">
			<div class="card-content white text">
				<center><h5 class="title"> Edit Jadwal</h5></center>
				<br>
				<form action="/scheduling/{{$data[0]->id}}" method="POST">
					{{csrf_field()}}
					{{method_field('PUT')}}
					<div class="">
						<select name="users">
							<option value="{{$data[0]->user_id}}">{{$data[0]->user_name}}</option>
							@foreach($users as $user)
								<option value="{{$user->id}}">{{$user->user_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="">
						<button type="button" class="btn btn-kamar modal-trigger waves-effect waves-default orange darken-2" data-target="modalKamar">Pilih Kamar</button>
					</div>
					<!-- modal popup -->
						<div class="modal modal-fixed-footer" id="modalKamar">
							<div class="modal-content">
								<h4>Daftar Kamar</h4>
								<div class="row">
									@foreach($rooms as $room)
									<div class="col s6 m3 l3 row-kamar">
										<p>
											<input type="radio" name="rooms" id="{{$room->id}}" class="filled-in" value="{{$room->id}}">
											<label for="{{$room->id}}">{{$room->number}}</label>
										</p>
									</div>
									@endforeach
								</div>
							</div>
							<div class="modal-footer">
								<a id="btn-reset" class="btn waves-effect blue-grey lighten-5">Reset</a>
								<a class="btn modal-action modal-close waves-effect waves-light orange darken-2">Save</a>
							</div>
						</div>
						<!-- /modal popup -->

						<div class="title-tgl">
							<span>Daftar Tanggal Pengecekan</span>
						</div>
						<div class="">
							<div class="" id="daftar-tgl">
								<input type="date" class="" name="tgl1" value="{{$data[0]->s_date}}">
							</div>
						</div>

						<div class="">
							<button type="submit" class="btn btn-jadwal-save waves-effect waves-default orange darken-2"><span class="fa fa-save"></span> Simpan </button>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection