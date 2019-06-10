@extends('master')

@section('content')
@foreach($posts as $post)
	<!-- Title -->
	<h1 class="mt-4">
		<a href="posts/{{$post->id}}">{{ $post->title}}</a>
	</h1>
	<!-- Title -->

	<!-- Author -->
	<p class="lead">
		by
		<a href="#">Start Bootstrap</a>
	</p>
	<!-- Author -->

	<hr>

	<!-- Date/Time -->
	<p>Posted on {{$post->created_at->toDayDateTimeString()}}</p>

	<hr>
	<!-- Date/Time -->

	<!-- Preview Image -->
	@if($post->url)
		<img class="img-fluid rounded" src="../uploads/{{ $post->url }}" alt="">
		<hr>
	@endif
	<!-- Preview Image -->

	<!-- Post Content -->

	<p>
		{{$post->body}}
	</p>

	<hr>
	<a class="btn btn-primary" href="posts/{{$post->id}}">Read More . . 
		<span class="glyphicon glyphicon-chevron-right"></span>
	</a>
	<!-- Post Content -->

@endforeach
	<h2 style="margin-top:45px;color:red">Insert Post</h2>
	<form method="post" action="posts/store" enctype="multipart/form-data">
		{{ csrf_field () }}
		<div class="form-group">
			<label for="title">Title:</label>
			<input type="text" name="title" id='title' class="form-control">
		</div>
		<div class="form-group">
			<label for="body">Body:</label>
			<textarea type="text" name="body" id='body' class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label for="url">Image:</label>
			<input class="form-control" id='url' type="file" name="url">
		</div>
		<div class="form-group">
			<button type="submit" class='btn btn-primary'>Add Post</button>
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