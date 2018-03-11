
<form action="/complaint/{{$complaint->id}}" method="POST">
	{{csrf_field()}}
	{{method_field('PUT')}}
	<div class="modal-body">
		@if($user->privilege_id == 1)
		<div class="form-group">
			<label class="form-label" for="user">Pegawai Penindak</label>
			<select class="form-control" name="user" id="user" required>
				<option selected value="{{ $complaint->user_id }}">{{ $complaint->user_name }}</option>
				@foreach($users as $user)
					<option value="{{ $user->id }}">{{ $user->user_name }}</option>
				@endforeach
			</select>
		</div>
		@endif
		<div class="form-group">
			<label class="form-label" for="rooms">No Kamar</label>
			<select class="form-control" name="rooms" id="rooms" required>
				<option selected value="{{ $complaint->room_id }}">{{ $complaint->number }}</option>
				@foreach($rooms as $room)
					<option value="{{ $room->id }}">{{ $room->number }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label class="form-label" for="inventory">Inventory</label>
			<select class="form-control" name="inventory" id="inventory" required>
				<option selected value="{{ $complaint->inventory_id }}">{{ $complaint->name }}</option>
				@foreach($inventories as $inventory)
					<option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label class="form-label" for="detail">Detail Kerusakan</label>
			<textarea class="form-control" id="detail" name="detail">{{ $complaint->detail }}</textarea>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Simpan</button>
	</div>
</form>
