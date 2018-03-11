<div class="data-pengecekan">
	<p><span class="@if($complaint->c_status == 0)
						kondisi-kurang fa fa-exclamation-circle
					@else
						kondisi-baik fa fa-check-circle
					@endif"></span>@if($complaint->c_status == 0)
						Belum diperbaiki
					@else
						Sudah diperbaiki
					@endif</p>
	<p><span class="fa fa-hotel"></span> Kamar No {{ $complaint->number }}</p>
	<p><span class="fa fa-user"></span> {{ $complaint->user_name }}</p>
	<p><span class="fa fa-wrench"></span> {{ $complaint->name }}</p>
	<p><span class="fa fa-calendar-o"></span> {{ date("M jS, Y H:m:s", strtotime($complaint->created_at)) }}</p>
</div>
<div class="detail-pengaduan">
	{{ $complaint->detail }}
</div>
