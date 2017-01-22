<?php
/**
 * Init our WordPress Theme.
 */
require_once( __DIR__ . '/vendor/autoload.php' );

\Classy\Classy::get_instance();

WP_Dependency_Installer::instance()->run( __DIR__ );


if(! function_exists('dump') ) {
    function dump($item) {
        echo '<pre>';
        var_dump($item);
        echo '</pre>';
    }
}

if(! function_exists('dd') ) {

    function dd($item) {
        echo '<pre>';
        var_dump($item);
        echo '</pre>';
        exit();
    }
}

if( function_exists('acf_add_options_page') ) {

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'parent_slug'	=> 'options-general.php',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Contact Form Settings',
		'menu_title'	=> 'Contact',
		'parent_slug'	=> 'options-general.php',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Social Media Settings',
		'menu_title'	=> 'Social Media',
		'parent_slug'	=> 'options-general.php',
	));
}
