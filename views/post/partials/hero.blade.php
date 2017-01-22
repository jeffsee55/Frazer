<section class="hero is-medium {{ $post->maybe_overlay() }}" style="background-image: url({{ $post->thumbnail()->src('wide') }})">
	<div class="hero-body">
		<div class="container {{ $post->title_position() }}">
			<div class="column is-half">
				<h1 class="title">
					{{ $post->title() }}
				</h1>
			</div>
		</div>
	</div>
</section>
