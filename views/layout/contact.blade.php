<form id="contact-form" action="/wp-admin/admin-post.php">
    <input type="hidden" name="action" value="send_contact">
    <div class="contact columns has-shadow">
        <div class="contact-form column is-7">
            <div>
                <h4>Send Us A Message</h4>
                <hr>
            </div>
            <div class="inputs">
                <label class="label">Name</label>
                <p class="control has-icon has-icon-right">
                    <input class="input" name="name" type="text">
                </p>
                <label class="label">Email</label>
                <p class="control has-icon has-icon-right">
                    <input class="input" name="email" type="text">
                </p>
                <label class="label">Message</label>
                <p class="control">
                    <textarea class="textarea" name="message"></textarea>
                </p>
            </div>
            <button type="submit" id="contact-submit" class="contact-submit button" style="background-color: {{ get_field('fff_contact_color', 'option') ? the_field('fff_contact_color', 'option') : '#da4242' }}"><i class="fa fa-send"></i></button>
        </div>
        <div class="contact-info column is-5" style="background-color: {{ get_field('fff_contact_color', 'option') ? the_field('fff_contact_color', 'option') : '#da4242' }}">
            <div>
                <h4>Contact Info</h4>
                <hr>
            </div>
            <div class="level is-mobile">
                <div class="level-item is-narrow">
                    <span class="icon is-large"><i class="fa fa-map-marker"></i></span>
                </div>
                <div class="level-item">
                    {{ the_field('fff_address', 'option') }}
                </div>
            </div>
            @while(have_rows('fff_links', 'option'))
                <?php the_row(); ?>
                <div>
                    <a href="{{ the_sub_field('link_url') }}" class="button is-large button-outline inverse button-block">{{ the_sub_field('link_text') }}</a>
                </div>
            @endwhile
            <div class="nav-center">
                @while(have_rows('fff_social', 'option'))
                    <?php the_row(); ?>
                    <a class="nav-item social" href="{{ the_sub_field('username') }}">
                        <span class="icon is-large"><i class="fa {{ the_sub_field('icon') }}"></i></span>
                    </a>
                @endwhile
            </div>
        </div>
    </div>
</form>
