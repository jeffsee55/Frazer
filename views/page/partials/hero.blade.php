@while(have_rows('row'))
    <?php the_row(); ?>
    @if(get_row_layout() == 'image_text')
        <?php $side = get_sub_field('header_right') ? 'even' : 'odd'; ?>
        <section class="section message">
            <div class="container">
            	<article class="level columns image-message message-{{ $side }}">
                    @if($side == 'even')
                		<div class="text-right column message-label is-{{ get_sub_field('header_width') }}">
                            <?php $revealSide = $side == 'odd' ? 'reveal-right' : 'reveal-left'; ?>
                            <img class="scroll-reveal {{ $revealSide }} reveal-rotate" src="{{ wp_get_attachment_image_src( get_sub_field('header'), 'medium')[0] }}">
                		</div>
                		<div class="text-left scroll-reveal reveal-right column message-text is-{{ 12 - intval(get_sub_field('header_width')) }}">
                			<div class="text-wrapper">
                                {{ the_sub_field('body') }}
                			</div>
                		</div>
                    @else
                		<div class="text-right scroll-reveal reveal-left column message-text is-{{ 12 - intval(get_sub_field('header_width')) }}">
                			<div class="text-wrapper">
                                {{ the_sub_field('body') }}
                			</div>
                		</div>
                		<div class="text-left column message-label is-{{ get_sub_field('header_width') }}">
                            <?php $revealSide = $side == 'odd' ? 'reveal-right' : 'reveal-left'; ?>
                            <img class="scroll-reveal {{ $revealSide }} reveal-rotate" src="{{ wp_get_attachment_image_src( get_sub_field('header'), 'medium')[0] }}">
                		</div>
                    @endif
            	</article>
            </div>
        </section>
    @endif
    @if(get_row_layout() == 'block_text')
        <?php $side = get_sub_field('header_right') ? 'even' : 'odd'; ?>
        <section class="section message">
        	<article class="block-message level columns message-{{ $side }}">
                @if($side == 'even')
            		<div class="text-right scroll-reveal reveal-right column message-label is-{{ get_sub_field('header_width') }}">
                        <h1>{{ the_sub_field('header') }}</h1>
                        @if(! empty(get_sub_field('link')))
                            <a class="button" href="{{ the_sub_field('link') }}">{{ the_sub_field('link_text') }}</a>
                        @endif
            		</div>
            		<div class="text-left scroll-reveal reveal-left column block-message-text message-text is-{{ 12 - intval(get_sub_field('header_width')) }}">
            			<div class="text-wrapper">
                            {{ the_sub_field('body') }}
            			</div>
            		</div>
                @else
            		<div class="text-right scroll-reveal reveal-right column block-message-text message-text is-{{ 12 - intval(get_sub_field('header_width')) }}">
            			<div class="text-wrapper">
                            {{ the_sub_field('body') }}
            			</div>
            		</div>
            		<div class="text-left scroll-reveal reveal-left column message-label is-{{ get_sub_field('header_width') }}">
                        <h1>{{ the_sub_field('header') }}</h1>
                        @if(! empty(get_sub_field('link')))
                            <a class="button" href="{{ the_sub_field('link') }}">{{ the_sub_field('link_text') }}</a>
                        @endif
            		</div>
                @endif
        	</article>
        </section>
    @endif
    @if(get_row_layout() == 'list_panel')
    <?php $image = get_sub_field('background_image') ? wp_get_attachment_url(get_sub_field('background_image'), 'large') : ''; ?>
    <section class="section" style="background-image: url({{ $image }}); background-size: cover">
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
            				<div class="text-wrapper">
                                <h3>{{ the_sub_field('item_header') }}</h3>
                                <hr>
                                {{ the_sub_field('body') }}
                            </div>
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
    			<div class="preview-text column is-6">
    				<div class="text-wrapper">
    					<div class="preview-excerpt">{{ the_sub_field('body') }}</div>
    				</div>
    			</div>
    			<a class="preview-image column is-6">
    				<figure class="image-wrapper" style="background-image: url({{ the_sub_field('image') }})">
    				</figure>
    			</a>
    		</article>
    	</section>
    @endif
@endwhile

<div class="container">
    <div class="columns">
        @while(have_rows('grid'))
        <?php the_row(); ?>
            <div class="column is-4">
                <h1>Title</h1>
                <p>Address line 1</p>
                <p>Address line 2</p>
            </div>
        @endwhile
    </div>
</div>
