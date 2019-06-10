@extends('master')

@section('content')
	<h3>Control Panel</h3>
	<h5>List of USERS</h5>
	<div class="table table">
		<table>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Email</th>
				<th>Admin</th>
				<th>Editor</th>
				<th>User</th>
			</tr>
			@foreach($users as $user)
			<form method="post" action="admin/add-role">
				{{ csrf_field() }}
				<input type="hidden" name="email" value="{{ $user->email }}">
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>
						<input type='checkbox' name="admin" onChange="this.form.submit()" {{ $user->hasRole('admin') ? 'checked' : ' ' }}>
					</td>
					<td>
						<input type='checkbox' name="editor" onChange="this.form.submit()" {{ $user->hasRole('editor') ? 'checked' : ' ' }}>
					</td>
					<td>
						<input type='checkbox' name="user" onChange="this.form.submit()" {{ $user->hasRole('user') ? 'checked' : ' ' }}>
					</td>
				</tr>
			</form>
			@endforeach
		</table>
	</div>

	<div>
		<h2 style="text-align: center;margin-top:50px">Settings</h2>
		<form method="post" action="{{ url('settings') }}">
			{{ csrf_field() }}
			Disable Commenting : 
			<input type="checkbox" name="disable_commenting" onChange="this.form.submit()" {{ $disable_comment == 1 ? "checked" : " " }}>
			<br>
			Disable Registering : 
			<input type="checkbox" name="disable_registering" onChange="this.form.submit()" {{ $disable_register == 1 ? "checked" : " " }}>
		</form>
	</div>
@stop 