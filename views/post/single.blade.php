@extends('layout.default')

@section('content')
	@if ($post)
		@include ('post.partials.hero')
		<article class="single">
			<section class="body content">
				@include ('post.partials.social')
				{{ $post->content() }}
			</section>

		</article>
	@endif
@stop
