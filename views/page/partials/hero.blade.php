@while(have_rows('row'))
    <?php the_row(); ?>
    @if(get_row_layout() == 'image_text')
        <?php $side = get_sub_field('header_right') ? 'even' : 'odd'; ?>
        <section class="section message">
        	<article class="level columns message-{{ $side }}">
        		<div class="column message-label is-{{ get_sub_field('header_width') }}">
                    <img class="scroll-reveal reveal-right reveal-rotate" src="{{ wp_get_attachment_image_src( get_sub_field('header'), 'original')[0] }}">
        		</div>
        		<div class="column message-text is-{{ 12 - intval(get_sub_field('header_width')) }}">
        			<div class="text-wrapper">
                        {{ the_sub_field('body') }}
        			</div>
        		</div>
        	</article>
        </section>
    @endif
    @if(get_row_layout() == 'block_text')
        <?php $side = get_sub_field('header_right') ? 'even' : 'odd'; ?>
        <section class="section message">
        	<article class="level columns message-{{ $side }}">
        		<div class="column message-label is-{{ get_sub_field('header_width') }}">
                    <h1>{{ the_sub_field('header') }}</h1>
                    @if(! empty(get_sub_field('link')))
                        <a class="button" href="{{ the_sub_field('link') }}">{{ the_sub_field('link_text') }}</a>
                    @endif
        		</div>
        		<div class="column block-message-text message-text is-{{ 12 - intval(get_sub_field('header_width')) }}">
        			<div class="text-wrapper">
                        {{ the_sub_field('body') }}
        			</div>
        		</div>
        	</article>
        </section>
    @endif
    @if(get_row_layout() == 'list_panel')
    <section>
    	<section class="cd-hero vertical list-panel-slider has-shadow">
    		<ul class="cd-hero-slider">
                <?php $i = 0; ?>
                @while(have_rows('item'))
                    <?php
                    the_row();
                    $selected = $i == 0 ? 'selected' : '';
                    $i++; ?>
        			<li class="{{ $selected }}">
        				<div class="cd-full-width">
                            <h3>{{ the_sub_field('item_header') }}</h3>
                            <hr>
                            {{ the_sub_field('body') }}
        				</div> <!-- .cd-full-width -->
        			</li>
                @endwhile

    		</ul> <!-- .cd-hero-slider -->

    		<div class="cd-slider-nav">
    			<nav>
    				<span class="cd-marker item-1">
                        <span class="triangle"></span>
                    </span>

    				<ul>
                        <?php $i = 0; ?>
                        @while(have_rows('item'))
                            <?php
                            the_row();
                            $selected = $i == 0 ? 'selected' : '';
                            $i++;
                            ?>
        					<li class="{{ $selected }}" style="background-color: {{ the_sub_field('color') }}">
                                <a style="background-image: url({{ the_sub_field('icon') }})"href="#0">
                                    <div>
                                        <h3>{{ the_sub_field('item_header') }}</h3>
                                    </div>
                                    <span>{{ the_sub_field('item_header') }}</span>
                                </a>
                            </li>
                        @endwhile
    				</ul>
    			</nav>
    		</div> <!-- .cd-slider-nav -->
    	</section> <!-- .cd-hero -->
    </section> <!-- .cd-hero -->
    @endif
    @if(get_row_layout() == 'card')
    	<section class="section preview">
            <h1 class="preview-header">{{ the_sub_field('header') }}</h1>
    		<article class="columns is-gapless">
    			<a class="preview-image column is-5">
    				<figure class="image-wrapper" style="background-image: url({{ the_sub_field('image') }})">
    				</figure>
    			</a>
    			<div class="preview-text column is-7">
    				<div class="text-wrapper">
    					<div class="preview-excerpt">{{ the_sub_field('body') }}</div>
    				</div>
    			</div>
    		</article>
    	</section>
    @endif
@endwhile
