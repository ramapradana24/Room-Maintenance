@extends('layouts.app')
@extends('layouts.adminsidebar')
@section('additionalStyle')
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/home.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/jquery.dataTables.min.css')}}">
@endsection
@section('title', 'Profile')
@section('profileActive', 'active')

@section('body')
<div class="row">
			<div class="col s12">				
				<div class="card-user z-depth-1">
					<div class="user-img z-depth-4" style="background-image: url('{{asset('style/img/user.png')}}');"></div>
					<span class="user-name"><span class="fa fa-user"></span> {{$user->user_name}}</span>
					<p class="jabatan">
						@if($user->privilege_id == 1)
							Administrator
						@elseif($user->privilege_id == 2)
							Pegawai
						@endif
					</p>
					<small class="email"><span class="fa fa-envelope-o"></span>{{$user->email}}</small>
					<div class="row user-data">
						<div class="col s4 m4 l4">
							<small>Kelamin</small>
							<span>@if($user->sex == 1)
									Laki-Laki
									@else
									Perempuan
								@endif
							</span>
						</div>
						<div class="col s4 m4 l4">
							<small>Tanggal lahir</small>
							<span>{{ $textdate }}</span>
						</div>
						<div class="col s4 m4 l4">
							<small>Umur</small>
							<span>{{$userage}} Tahun</span>
						</div>
					</div>

					<div class="alamat">
						<small><span class="fa fa-home"></span> Alamat</small>
						<p>{{$user->address}}</p>
					</div>
				</div>
			</div>
		</div>
@endsection