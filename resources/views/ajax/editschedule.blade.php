<form action="/scheduling/{{$maintenance->id}}" method="POST">
	{{csrf_field()}}
	{{method_field('PUT')}}
	<div class="modal-body">
		<div class="form-group">
			<label class="form-label" for="no-kamar">No Kamar</label>
			<select class="form-control" name="rooms" id="sl-no-kamar" required>
				<option selected value="{{ $maintenance->room_id }}">{{ $maintenance->number }}</option>
				@foreach($rooms as $room)
					<option value="{{ $room->id }}">Kamar No{{ $room->number }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label class="form-label" for="pegawai">Nama Pegawai</label>
			<select class="form-control" name="users" id="sl-nama-pegawai" required>
				<option selected value="{{ $maintenance->user_id }}">{{ $maintenance->user_name }}</option>
				@foreach( $users as $user )
					<option value="{{$user->id}}">{{$user->user_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label class="form-label" for="tgl-pengecekan">Tanggal Pengecekan</label>
			<input type="date" class="form-control" name="tgl1" id="input-tgl-pengecekan" value="{{ $maintenance->s_date }}" required>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Simpan</button>
	</div>
</form>