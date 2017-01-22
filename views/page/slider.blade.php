{{-- Slider. --}}
{{-- Template Name: Slider --}}

@extends('layout.default')

@section('content')
	<section class="hero-slider cd-hero {{ the_field('layout') }} is-large">
		<ul class="cd-hero-slider">
            <?php $i = 0; ?>
            @while(have_rows('slide'))
                <?php the_row(); ?>
                @if(get_sub_field('hide') != 1)
                <?php
                $selected = $i == 0 ? 'selected' : '';
                $scrollReveal = $i == 0 ? 'scroll-reveal reveal-center' : '';
                $i++; ?>
    			<li class="{{ $selected }}"
				style="background: linear-gradient( 0deg, {{ the_sub_field('secondary_color') }}, {{ the_sub_field('color') }});"
				>
    				<div class="cd-full-width {{ $scrollReveal }}">
						<div class="text-wrapper">
	    					<h2>{{ the_sub_field('title') }}</h2>
	    					{{ the_sub_field('description') }}
						</div>
						<div class="slide-bg-title">{{ the_sub_field('title') }}</div>
    				</div> <!-- .cd-full-width -->
    			</li>
                @endif
            @endwhile

		</ul> <!-- .cd-hero-slider -->

		<div class="cd-slider-nav">
			<nav>
				<span class="cd-marker item-1">
                    <span class="triangle"></span>
                </span>

				<ul>
                    <?php $i = 0; ?>
                    @while(have_rows('slide'))
                        <?php
                        the_row();
                        ?>
                        @if(get_sub_field('hide') != 1)
                        <?php
                        $selected = $i == 0 ? 'selected' : '';
                        $i++;
                        ?>
    					<li class="scroll-reveal reveal-bottom {{ $selected }}">
                            <a style="background-image: url({{ the_sub_field('icon') }})"href="#0"><div>{{ the_sub_field('title') }}</div></a>
                        </li>
                        @endif
                    @endwhile
				</ul>
			</nav>
		</div> <!-- .cd-slider-nav -->
	</section> <!-- .cd-hero -->
	@include ('page.partials.hero')
@stop
