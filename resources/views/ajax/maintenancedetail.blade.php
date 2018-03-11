<div class="data-pengecekan">
	<p><span class="fa fa-hotel"></span> Kamar No {{ $maintenances[0]->number }}</p>
	<p><span class="fa fa-user"></span> {{ $maintenances[0]->user_name }}</p>
	<p><span class="fa fa-calendar-o"></span> {{date("M jS, Y", strtotime($maintenances[0]->s_date))}}</p>
</div>
<div class="daftar-barang">
	@foreach( $maintenances as $maintenance )
		<div class="barang" data-toggle="collapse" href="#collapseBarang{{ $maintenance->inventory_id }}" aria-expanded="false" aria-controls="collapseBarang{{ $maintenance->inventory_id }}">
			<div>
				<span class="@if($maintenance->status == 0)
								kondisi-kurang fa fa-exclamation-circle
							@else
								kondisi-baik fa fa-check-circle
							@endif"></span>
				<span class="nama-barang">{{ $maintenance->name }}</span>
			</div>
			<span class="tanda-dropdown fa fa-angle-down"></span>
		</div>
		<div class="collapse" id="collapseBarang{{ $maintenance->inventory_id }}">
			<div class="detail-barang">
				{{ $maintenance->description }}
			</div>
		</div>
	@endforeach
</div>