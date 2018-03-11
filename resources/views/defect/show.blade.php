<div class="data-pengecekan">
	<p><span class="@if($defect->d_status == 0)
						kondisi-kurang fa fa-exclamation-circle
					@else
						kondisi-baik fa fa-check-circle
					@endif"></span>@if($defect->d_status == 0)
						Belum diperbaiki
					@else
						Sudah diperbaiki
					@endif</p>
	<p><span class="fa fa-hotel"></span> Kamar No {{ $defect->number }}</p>
	<p><span class="fa fa-user"></span> {{ $defect->user_name }}</p>
	<p><span class="fa fa-wrench"></span> {{ $defect->name }}</p>
	<p><span class="fa fa-money"></span> Rp.@if( $defect->d_status == 0 )-@else {{ $defect->cost }}@endif</p>
	<p><span class="fa fa-calendar-o"></span> {{ date("M jS, Y H:m:s", strtotime($defect->created_at)) }}</p>
	<p><span class="fa fa-calendar-check-o"></span> @if( $defect->d_status == 0 )-@else{{ date("M jS, Y H:m:s", strtotime($defect->fixed_at)) }}@endif</p>
</div>
<div class="detail-pengaduan">
	{{ $defect->detail }}
</div>