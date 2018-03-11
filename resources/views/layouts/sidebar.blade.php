<!-- navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
	<button type="button" id="sidebarCollapse">
		<span class="la la-bars"></span>
	</button>
	<a class="navbar-brand" href="#">
		<b style="color: @if($user_in->privilege_id == 1)#5ebea9 @else #5d9cec @endif; margin-right: 2px">MAIN</b>TENANCE
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="lalse" aria-label="Toggle navigation">
		<span class="la la-ellipsis-v"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item active">
				<a class="nav-link" href="#"><span class="la la-user"></span> {{$user_in->user_name}}</a>
			</li>
			<li class="nav-item active dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
					<span class="la la-bell"></span>
					<div class="icon-typo">Pemberitahuan</div>
					<span class="badge @if($user_in->privilege_id == 2) bg-pegawai @endif" id="unseen-notification"></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-right" id="notif">
					<!-- ajax notification will appear here -->
				</ul>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="{{ route('logout') }}"
					onclick="event.preventDefault();
						document.getElementById('logout-form').submit()">
					<span class="la la-power-off"></span>
					<div class="icon-typo">Log Out</div>
				</a>
				<form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none">
					{{csrf_field()}}
				</form>
			</li>
		</ul>
	</div>
</nav>
<!-- navbar -->

<!-- sidebar -->
<nav class="sidebar" id="sidebar">
	<span>Navigasi</span>
	<ul>
		<li class="@yield('homeActive')"><a href="/home"><span class="la la-home"></span>Beranda</a> </li>
		@if( $user_in->privilege_id == 1 )
			<li class="@yield('scheduleActive')"><a href="/scheduling"><span class="la la-calendar-check-o"></span>Kelola Jadwal</a></li>
			<li class="@yield('reportActive')"><a href="#" data-toggle="modal" data-target="#modalReport"><span class="la la-tasks"></span>Report</a></li>
		@endif
		<li class="@yield('complaintActive')"><a href="{{ route('complaint.index') }}"><span class="la la-bullhorn"></span>Pengaduan <span class="sidebar-badge @if($user_in->privilege_id == 2) bg-pegawai @endif">{{ $unfinish_complaint }}</span></a> </li>

		<li class="@yield('defectActive')"><a href="{{ route('defect.index') }}"><span class="la la-wrench"></span>Kerusakan </a> </li>
	</ul>
	<div class="collapse navbar-collapse" id="navbarNav">
</nav>
<!-- sidebar -->