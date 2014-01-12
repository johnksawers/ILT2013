<?php
    // This function loads the plugin.
    function ilt_load_plugin() {
        
        if (!class_exists('wp_hero_unit_widget')) {
            include_once(STYLESHEETPATH.'/plugins/hero-unit-widget/hero-unit-widget.php');
        }
        if (!class_exists('wp_poovey_widget')) {
            include_once(trailingslashit( get_stylesheet_directory() ).'plugins/poovey-widget/poovey-widget.php');
        }
    }
    // Run this code on 'after_theme_setup', when plugins have already been loaded.
    add_action('after_setup_theme', 'ilt_load_plugin');
    /**
     * Register our sidebars and widgetized areas.
     *
     */
    function arphabet_widgets_init() {
        
        register_sidebar( array(
                                'name' => 'Home Top Widget Area',
                                'id' => 'home_top_1',
                                'before_widget' => '<div class="home_widget">',
                                'after_widget' => '</div>',
                                'before_title' => '<h2>',
                                'after_title' => '</h2>',
                                ) );
    }
    add_action( 'widgets_init', 'arphabet_widgets_init' );
?>