{{-- Hero page with text overlain. --}}
{{-- Template Name: Hero --}}

@extends('layout.default')

@section('content')

    <section class="hero is-large {{ $post->maybe_overlay() }}" style="background-image: url({{ $post->thumbnail()->src('wide') }})">
    	<div class="hero-body">
    		<div class="container {{ $post->title_position() }}">
    			<div class="column is-8">
					{{ $post->content() }}
    			</div>
    		</div>
    	</div>
    </section>

	@include ('page.partials.hero')

@stop
