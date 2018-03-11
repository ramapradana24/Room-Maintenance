<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/bootstrap.min.css')}}">
	@section('additionalStyle')
    	@show
    <link rel="stylesheet" href="{{asset('style/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/css/font-awesome.min.css')}}">
</head>
<body>

@section('login')
	@show

<!-- content -->
<div class="content">
	@section('body')
		@show
</div>
<!-- content -->

<!-- modal report -->
<div class="modal modal-large fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Masukkan Bulan Report</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="/report" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="form-label" for="year">Tahun</label>
						<select class="form-control" name="year" id="year" required>
							<option disabled selected>-- pilih tahun yang tersedia berikut --</option>
							@foreach($years as $year)
								<option value="{{ $year->tahun }}">{{ $year->tahun }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label class="form-label" for="month">Bulan</label>
						<select class="form-control" name="month" id="month" required>
							<option selected value="0">Semua Bulan</option>
							@foreach($months as $month)
								<option value="{{ $month->bulan }}">{{ $month->nama_bulan }}</option>
							@endforeach
						</select>
					</div>
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Submit</button>
					</div>
				</form>
		</div>
	</div>
</div>
<!-- modal report -->

<script src="{{asset('style/js/jquery.min.js')}}"></script>
<script src="{{asset('style/js/popper.min.js')}}"></script>
<script src="{{asset('style/js/bootstrap.min.js')}}"></script>
<script src="{{asset('style/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('style/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('style/js/main.js')}}"></script>
@section('script')
	@show
</body>
</html>