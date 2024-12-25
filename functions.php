<?php


function enqueue_custom_theme_assets() {
    // Enqueue the main stylesheet
    wp_enqueue_style('custom-theme-style', get_stylesheet_uri());
    
    // Enqueue SweetAlert2 JS
    wp_enqueue_script('sweetalert2-script', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', array('jquery'), null, true);

    // Enqueue the main JavaScript file
    wp_enqueue_script('custom-theme-script', get_template_directory_uri() . '/main.js', array(), '1.0', true);

}
add_action('wp_enqueue_scripts', 'enqueue_custom_theme_assets');
?>