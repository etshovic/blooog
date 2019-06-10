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
	<!-- Category Name -->

	<p>Category Name: <a href="categories/{{ $post->category->name }}"> {{ $post->category->name }}</a></p>

	<hr>
	<!-- Category Name -->

	<!-- Preview Image -->
	@if($post->url)
	<img class="img-fluid rounded" src="uploads/{{ $post->url }}" alt="">
	<hr>
	@endif
	<!-- Preview Image -->

	<!-- Post Content -->

	<p>
		{{$post->body}}
	</p>

	<hr>
	<a class="btn btn-primary" href="posts/{{$post->id}}">Read More . .</a>
	@php
		$like_count = 0;
		$unlike_count = 0;
		$like_status = 'btn-secondary';
		$unlike_status = 'btn-secondary';
	@endphp
	@foreach($post->likes as $like)
		@php
			if($like->like == 1)
				$like_count++;
			if($like->like == 0)
				$unlike_count++;
			if(Auth::check()) 
			{
				if($like->like == 1 && $like->user_id == Auth::user()->id )
					$like_status = 'btn-success';
				if($like->like == 0 && $like->user_id == Auth::user()->id )
					$unlike_status = 'btn-danger';
			}
		@endphp
	@endforeach

	<button 
		type="button" 
		class="btn {{ $like_status }} like" 
		data-like='{{ $like_status }}'
		data-postid='{{ $post->id }}_l'>
		Like  
		<b>
			<span class="like_count">
				{{ $like_count }}
			</span>
		</b>
	</button>
	<button 
		type="button" 
		class="btn {{ $unlike_status }} unlike" 
		data-like='{{ $unlike_status }}'
		data-postid='{{ $post->id }}_u'>
		UnLike 
		<b>
			<span class="unlike_count">
				{{ $unlike_count }}
			</span>
		</b>
	</button>
	<!-- Post Content -->

@endforeach
	@if(Auth::check())
		@if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('editor') )
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
		@endif
	@endif
@stop 