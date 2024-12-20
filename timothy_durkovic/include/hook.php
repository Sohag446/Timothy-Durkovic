<?php

function timothy_durkovic_enqueue_scripts() {
    wp_enqueue_style('slick', get_template_directory_uri() . '/assets/css/slick.css', array(), current_time('timestamp'));
    wp_enqueue_style('slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), current_time('timestamp'));
    wp_enqueue_style('custom-a', get_template_directory_uri() . '/assets/css/custom-a.css', array(), current_time('timestamp'));
    wp_enqueue_style('custom-b', get_template_directory_uri() . '/assets/css/custom-b.css', array(), current_time('timestamp'));
    wp_enqueue_style('normalize-style', get_template_directory_uri() . '/assets/css/normalize.css', array(), current_time('timestamp'));
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('slick-js', get_template_directory_uri(). '/assets/js/slick.min.js');
    wp_enqueue_script('custom_script', get_template_directory_uri(). '/assets/js/custom-script.js');
}
add_action('wp_enqueue_scripts', 'timothy_durkovic_enqueue_scripts');





// Enable SVG file upload support
function add_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'add_mime_types');



// Change Default Post Label 
function change_default_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Events';
    $submenu['edit.php'][5][0] = 'Events';
    $submenu['edit.php'][10][0] = 'Add Event';
    echo '';
}
function change_default_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Events';
    $labels->singular_name = 'Event';
    $labels->add_new = 'Add Event';
    $labels->add_new_item = 'Add New Event';
    $labels->edit_item = 'Edit Event';
    $labels->new_item = 'New Event';
    $labels->view_item = 'View Event';
    $labels->search_items = 'Search Events';
    $labels->not_found = 'No Events found';
    $labels->not_found_in_trash = 'No Events found in Trash';
    $labels->name_admin_bar = 'Add Event';
}

add_action( 'init', 'change_default_post_object_label' );
add_action( 'admin_menu', 'change_default_post_menu_label' );


// Change Default Post title
function change_default_title($title) {
    $screen = get_current_screen();
    if ('post' == $screen->post_type) {
        $title = 'Event Name';
    }
    return $title;
}
add_filter('enter_title_here', 'change_default_title');


// change argument for default post
function change_default_post_arguments($args, $post_type) {
    if ($post_type === 'post') {
        // $args['public'] = false;    
        $args['show_ui'] = true;    
        $args['menu_icon'] = 'dashicons-calendar-alt';   
        $args['supports'] = array( 'title', 'thumbnail','custom-fields' );   
    }
    return $args;
}
add_filter('register_post_type_args', 'change_default_post_arguments', 10, 2);


//remove guttenberg from page if not "Default Template"
add_action('admin_init', function () {
    if (!is_admin() || !($post_id = $_GET['post'] ?? $_POST['post_ID'] ?? false)) return;
    $template = get_page_template_slug($post_id);
    if ($template === '' || $template === 'default') {
        add_post_type_support('page', 'editor');
    } else {
        remove_post_type_support('page', 'editor');
    }


    remove_post_type_support('post', 'editor');
});


// block editor for post type Review
function disable_gutenberg_editor( $is_enabled, $post_type ) {
	if ( 'review' === $post_type ) {
		return false;
	}
	return $is_enabled;
}
add_filter( 'use_block_editor_for_post_type', 'disable_gutenberg_editor', 10, 2 );






