<form action="/defect/{{$defect->id}}/fixing" method="POST">
	{{ csrf_field() }}
	{{ method_field("PUT") }}
	<div class="modal-body">
		<div class="form-group">
			<label class="form-label" for="cost">Biaya Perbaikan</label>
			<input type="number" class="form-control" name="cost" id="cost" required></input>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Simpan</button>
	</div>
</form>