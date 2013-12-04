<?php
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