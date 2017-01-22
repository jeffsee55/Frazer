<footer class="level is-mobile">
    <div class="level-left">
        @while(have_rows('fff_social', 'option'))
            <?php the_row(); ?>
            <a class="nav-item social" href="{{ the_sub_field('username') }}">
                <span class="icon is-large"><i class="fa {{ the_sub_field('icon') }}"></i></span>
            </a>
        @endwhile
    </div>
    <div class="level-right copyright">
        {{ bloginfo('name') }} © {{ date('Y') }}
    </div>
</footer>
