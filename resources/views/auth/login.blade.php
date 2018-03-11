@extends('layouts.app')
@section('title', 'Login')
@section('additionalStyle')
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/auth.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('style/css/custom.css')}}">
@endsection

@section('login')

<div class="auth-card">
		<div class="logo-section">
			<h4>LOGIN TO YOUR ACCOUNT</h4>
		</div>
		<form action="{{ route('login') }}" method="POST">
			{{ csrf_field() }}
			<div class="input-group">
				<div class="input-group-addon">
					<span class="fa fa-envelope"></span>
				</div>
				<input type="email" name="email" class="form-control" placeholder="Email Anda.." required>
			</div>

			<!-- error report -->
			@if ($errors->has('email'))
	            <p class="help-block">
	                <strong class="error">{{ $errors->first('email') }}</strong>
	            </p>
            @endif
            <!-- error report -->

			<div class="input-group">
				<div class="input-group-addon">
					<span class="fa fa-key"></span>
				</div>
				<input type="password" name="password" class="form-control" placeholder="Password Anda.." required>
			</div>

			<!-- error report -->
			@if ($errors->has('password'))
	            <span class="help-block">
	                <strong>{{ $errors->first('password') }}</strong>
	            </span>
            @endif
            <!-- error report -->

			<button type="submit" name="login" class="btn btn-primary btn-block z-depth-1">LOGIN</button>
		</form>
	</div>

@endsection