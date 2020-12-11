<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/*
 * Create custom CF7 form
 */

add_filter('wpcf7_default_template', function( $template, $prop ) {
	if ( 'form' == $prop ) {
		return implode( '', array(
			'<div class=”row”>',
			'<div class=”col”>',
			'[text* your-name placeholder”Name”]',
			'[email* your-email placeholder”Email”]',
			'[text* your-subject placeholder”Subject”]',
			'</div>',
			'<div class=”col”>',
			'[textarea* your-message placeholder”Message”]',
			'</div>',
			'</div>',
			'<div class=”row”>',
			'[submit class:btn “Send Mail”]',
			'</div>'
		) );
	} else {
		return $template;
	}
});

add_filter('wpcf7_contact_form_default_pack', function ($template) {
	$template->set_title( 'Contact us now' );
    return $template;
});

/**
 * Filter for options page
 */

add_action('acf/init', function() {

	// Check function exists.
	if( function_exists('acf_add_options_page') ) {

		// Register options page.
		$option_page = acf_add_options_page(array(
			'page_title'    => __('Theme General Settings'),
			'menu_title'    => __('Theme Settings'),
			'menu_slug'     => 'theme-general-settings',
			'capability'    => 'edit_posts',
			'redirect'      => false
		));
	}
});

/**
 * Filter for array of users to have ACF menu
 */

add_filter('acf/settings/show_admin', function ( $show ) {

	$current_user = wp_get_current_user();
	$allowed_users = array(
		'admin',
	);

	return in_array($current_user->user_login, $allowed_users);

}, 10, 1);