<?php
/*
Plugin Name: Poovey Widget
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Provides little modules for the ILT site
Version: 1.0
Author: John Sawers
Author URI: http://johnksawers.com
License: MIT
*/

class wp_poovey_widget extends WP_Widget {
    
	// constructor
	function wp_poovey_widget() {
        parent::WP_Widget(false, $name = __('Poovey Widget', 'wp_poovey_widget'));
	}
    
	// widget form creation
    function form($instance) {
        
        // Check values
        if( $instance) {
            $title = esc_attr($instance['title']);
            $target_url = esc_attr($instance['target_url']);
            $image_url = esc_attr($instance['image_url']);
            $body = apply_filters( 'widget_textarea', empty( $instance['body'] ) ? '' : $instance['body'], $instance );
        } else {
            $title = '';
            $target_url = '';
            $image_url = '';
            $body = '';
        }
        ?>

        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        
        <p>
        <label for="<?php echo $this->get_field_id('target_url'); ?>"><?php _e('Target URL:', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('target_url'); ?>" name="<?php echo $this->get_field_name('target_url'); ?>" type="text" value="<?php echo $target_url; ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('image_url'); ?>"><?php _e('Image URL:', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo $image_url; ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('body'); ?>"><?php _e('Body:', 'wp_widget_plugin'); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('body'); ?>" name="<?php echo $this->get_field_name('body'); ?>"><?php echo $body; ?></textarea>
        </p>
        <?php
    }
    
    // update widget
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        // Fields
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['target_url'] = strip_tags($new_instance['target_url']);
        $instance['image_url'] = strip_tags($new_instance['image_url']);
        if ( current_user_can('unfiltered_html') )
            $instance['body'] =  $new_instance['body'];
        else
            $instance['body'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['body'])));
        
        return $instance;
    }


    // display widget
    function widget($args, $instance) {
        extract( $args );
        // these are the widget options
        $title = apply_filters('widget_title', $instance['title']);
        $target_url = $instance['target_url'];
        $image_url = $instance['image_url'];
        $body = $instance['body'];
        echo $before_widget;
        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box"><div class="poovey_widget">';

        // Check if title is set
        if ( $image_url && $target_url ) {
            echo '<div class="image">';
            echo '<a href="' . $target_url . '">';
            echo '<img src="' . $image_url . '" alt="' . $title . '"/>';
            echo '</a>';
            echo '</div>';
        }

        // Check if title is set
        if ( $title ) {
            echo '<div class="promo-meta">';
            echo '  <div class="name">';
            echo '    <a href="">' . $title . '</a>';
            echo '  </div>';
            echo '</div>';
        }

        // Check if textarea is set
        if( $body ) {
            echo '<div class="description">';
            echo wpautop($body);
            echo '</div>';
        }

        if ( $target_url ) {
            echo '<a href="' . $target_url . '" class="button">';
            echo 'Read More';
            echo '</a>';
        }
        echo '</div></div>';
        echo $after_widget;
    }
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_poovey_widget");'));

