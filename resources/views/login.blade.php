@extends('master')

@section('content')
	<h3>Login !!</h3>
	<form action="login" method="post">
		{{ csrf_field() }}
		<div class="form-group">	
			<label for="email">Email</label>
			<input type="text" name="email" value="{{ old('email') }}" class="form-control form-app" placeholder="Email">
		</div>

		<div class="form-group">	
			<label for="password">Passowrd</label>
			<input type="password" name="password" value="{{ old('password') }}" class="form-control form-app" placeholder="Enter Passowrd">
		</div>

		<div class="form-group">	
			<button type="submit" class="btn btn-primary">Login</button>
		</div>

	</form>
	<div>
		@foreach($errors->all() as $error)
			<div class="alert alert-danger">
				{{ $error }} 
			</div>
		@endforeach
	</div>
@stop 