@extends('master')

@section('content')

	<h1 class="mt-4">
		Web Statistics
	</h1>
	<br>
	<br>
	<table class="table table-hover">
		<tr>
			<td>All Users</td>
			<td>{{ $stats['users'] }}</td>
		</tr>
		<tr>
			<td>All Posts</td>
			<td>{{ $stats['posts'] }}</td>
		</tr>
		<tr>
			<td>All Comments</td>
			<td>{{ $stats['comments'] }}</td>
		</tr>
		<!-- ######################################  -->
		<tr>
			<td>Most Active User</td>
			<td><b>{{ $stats['active_user'] }}</b> , Likes({{ $stats['active_user_likes'] }}) , Comments({{ $stats['active_user_comments'] }})</td>
		</tr>
		<tr>
			<td>Most Active post</td>
			<td><b>{{ $stats['active_post'] }}</b> , Likes({{ $stats['active_post_likes'] }}) , Comments({{ $stats['active_post_comments'] }})</td>
		</tr>
	</table>

@stop 