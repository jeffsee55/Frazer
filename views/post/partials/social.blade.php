<nav class="social nav">
    <div class="nav-left">
        <a class="nav-item social">
    		<date>{{ $post->get_date() }}</date>
        </a>
		@foreach($post->get_tags() as $tag)
            <a href="{{ get_term_link($tag->term_id) }}" class="nav-item label">
                <span class="tag">{{ $tag->name }}</span>
            </a>
        @endforeach
    </div>
    <div class="nav-right">
        <a class="nav-item social"
            target="_blank"
            href="http://www.facebook.com/sharer.php?u={{ urlencode($post->get_permalink() ) }}"
        >
            <span class="icon"><i class="fa fa-facebook"></i></span>
        </a>
        <a class="nav-item social"
            target="_blank"
            href="https://twitter.com/intent/tweet?url={{ urlencode($post->get_permalink() ) }}"
        >
            <span class="icon"><i class="fa fa-twitter"></i></span>
        </a>
    </div>
</nav>
