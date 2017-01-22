<div class="container">
	<section class="section preview {{ $post->get_layout() }}">
		<article class="columns is-gapless">
			<a class="preview-image column is-5" href="{{ $post->get_permalink() }}">
				<figure class="image-wrapper" style="background-image: url({{ $post->thumbnail()->src('large') }})">
				</figure>
			</a>
			<div class="preview-text column is-7">
				<div class="text-wrapper">
					<h1 class="title is-large">{{ $post->title() }}</h1>
					<div class="preview-excerpt">{{ $post->get_preview() }}</div>
				</div>
			</div>
		</article>
	</section>
</div>
