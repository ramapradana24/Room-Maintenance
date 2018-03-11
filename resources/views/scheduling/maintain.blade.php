@extends('layouts.app')
@extends('layouts.sidebar')
@section('additionalStyle')
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/dashboard_pegawai.css')}}">
@endsection
@section('title', 'Maintenance | Periksa Kamar')
@section('homeActive', 'active')
@section('body')

<!-- pengecekan -->
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<p class="card-title">Form Pengecekan Kamar</p>
					<?php 
						$count_inventory = count($inventories);
						$i = 1; 
					?>
					<!-- form -->
					<form action="/scheduling/{{ $inventories[0]->maintenance_id }}/maintain" method="POST"
						>
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<input type="text" name="count_inventory" style="display: none;" value="{{$count_inventory}}">
						<input type="text" name="username" style="display: none;" value="{{ $maintenance_info->user_name }}">
						<input type="text" name="room_id" style="display: none;" value="{{$inventories[0]->room_id}}">
						<input type="text" name="room_number" style="display: none;" value="{{ $maintenance_info->number }}">
						<input type="text" name="sch_date" style="display: none;" value="{{date("M jS, Y", strtotime($maintenance_info->s_date))}}">
						<div class="info-kamar">
							<p><span class="fa fa-hotel"></span> Kamar No {{ $maintenance_info->number }}</p>
							<p><span class="fa fa-user"></span> {{ $maintenance_info->user_name }}</p>
							<p><span class="fa fa-calendar-o"></span> {{date("M jS, Y", strtotime($maintenance_info->s_date))}}</p>
						</div>

						<table class="table table-stripped table-responsive" width="100%" cellspacing="0">
							<thead>
					            <tr>
					                <th>No</th>
					                <th>Nama Barang</th>
					                <th>Status (Baik/Rusak)</th>
					                <th>Keterangan</th>
					            </tr>
					        </thead>
					        <tbody>
					        	@foreach( $inventories as $inventory )
					        	<tr>
					        		<td>{{ $i }}</td>
					        		<td>
					        			{{ $inventory->name }}
					        			<input type="text" name="inventid{{$i}}" style="display: none;" value="{{ $inventory->inventory_id }}">
					        		</td>
					        		<td>
					        			<label class="switch">
											<input type="checkbox" name="invent{{$i}}" value="0">
											<div class="slider"></div>
										</label>
					        		</td>
					        		<td>
					        			<div data-toggle="tooltip" data-placement="top" title="Tulis keterangan barang">
				                			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKetBarang{{ $i }}">
						                		<span class="fa fa-pencil"></span>
						                	</button>
					                	</div>
					                	<!-- modal pengaduan -->
										<div class="modal modal-large fade" id="modalKetBarang{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Keterangan Barang</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<div class="form-group">
															<textarea rows="3" class="form-control" name="detail{{$i}}" placeholder="Tuliskan detail kondisi barang ketika dicek..." required></textarea>
														</div>
														<button type="button" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-save"></span>   Simpan</button>
													</div>
												</div>
											</div>
										</div>
										<!-- modal pengaduan -->
					        		</td>
					        	</tr>
					        	<?php $i++ ?>
					        	@endforeach
					        </tbody>
						</table>

						<center style="margin-top: 30px">
							<button type="submit" class="btn btn-success"><span class="fa fa-send"></span> KIRIM PENGECEKAN</button>
						</center>
						
					</form>
					<!-- form -->

				</div>
			</div>
		</div>
	</div>
	<!-- pengecekan -->
@endsection