@extends('master')

@section('content')
	@if($disable_register == 1)
		<h3><b style="color:red">OUCH!!!</b> Registering is Disabled</h3>
	@else
		<h3>Create a New USER !!</h3>
		<form action="register" method="post">
			{{ csrf_field() }}

			<div class="form-group">	
				<label for="name">Name</label>
				<input type="text" name="name" value="{{ old('name') }}" class="form-control form-app" placeholder="Full Name">
			</div>

			<div class="form-group">	
				<label for="email">Email</label>
				<input type="text" name="email" value="{{ old('email') }}" class="form-control form-app" placeholder="Email">
			</div>

			<div class="form-group">	
				<label for="password">Passowrd</label>
				<input type="password" name="password" value="{{ old('password') }}" class="form-control form-app" placeholder="Enter Passowrd">
			</div>

			<div class="form-group">	
				<button type="submit" class="btn btn-primary">Signup</button>
			</div>

		</form>
	@endif
@stop 