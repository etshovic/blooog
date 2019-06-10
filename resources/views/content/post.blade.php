@extends('master')

@section('content')
	<!-- Title -->
	<h1 class="mt-4">
		<a href="{{$post->id}}">{{ $post->title}}</a>
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
	<p>Posted on {{$post->created_at}}</p>

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
	<!-- Post Content -->

	<!-- Comments Show -->
	<div class="comments">
		@if($post->comments->all())
			<h2 style="width:250px;padding:5px 10px;color:purple;font-weight: bold;border:2px solid">All Comments</h2>
			@foreach($post->comments->all() as $comment)
				<p class="lead">{{ $comment->body }}</p>
			@endforeach
		@endif
	</div>
	<!-- Comments Show -->

	<!-- Comments Form -->
	@if($disable_commenting == 1)
		<h3><b style="color:red">OUCH!!!</b> Commenting is Disabled</h3>
	@else
		<h2 style="width:300px;padding:5px 10px;margin-top:45px;color:green;font-weight: bold;border:2px solid;">Insert Comment</h2>
		<form method="post" action="{{ $post->id }}/store">
			{{ csrf_field () }}
			<div class="form-group">
				<label for="body">Comment here</label>
				<textarea type="text" name="body" id='body' class="form-control"></textarea>
			</div>
			<div class="form-group">
				<button type="submit" class='btn btn-primary'>Add Comment</button>
			</div>
		</form>
		<div>
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">
					{{ $error }} 
				</div>
			@endforeach
		</div>
		<!-- Comments Form -->
	@endif

@stop 