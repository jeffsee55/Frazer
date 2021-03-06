<!DOCTYPE html>
<html>
    <head>
        <meta charset="{{ bloginfo( 'charset' ) }}" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="pingback" href="{{ bloginfo('pingback_url') }}" />
        <link rel="alternate" type="application/rss+xml" title="{{ bloginfo('name') }} RSS Feed" href="{{ bloginfo('rss2_url') }}" />
        <link rel="shortcut icon" href="{{ CLASSY_THEME_DIR }}assets/favicon.ico" />
        <script src="https://use.fontawesome.com/855ce7e6ed.js"></script>
        <script src="https://use.typekit.net/xeo3irf.js"></script>
        <script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>
        <script>try{Typekit.load({ async: true });}catch(e){}</script>
        <title>{{ wp_title('|', true, 'right'); }}</title>
        {{ wp_head() }}
    </head>
    <body {{ body_class() }}>

        {{ get_header() }}

        <main>
        	@include ('layout.contact')
            @yield('content')

            {{ get_footer() }}

            {{ wp_footer() }}
        </main>
    </body>
</html>
