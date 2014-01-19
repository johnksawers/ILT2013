<?php
    /*
     Plugin Name: Hero Unit Widget
     Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
     Description: Provides header/hero modules for the ILT site
     Version: 1.0
     Author: John Sawers
     Author URI: http://johnksawers.com
     License: MIT
     */

    class wp_hero_unit_widget extends WP_Widget {

        // constructor
        function wp_hero_unit_widget() {
            parent::WP_Widget(false, $name = __('Hero Unit Widget', 'wp_hero_unit_widget'));
        }

        // widget form creation
        function form($instance) {

            // Check values
            if( $instance) {
                $title = esc_attr($instance['title']);
                $color = esc_attr($instance['color']);
                $image_url = esc_attr($instance['image_url']);

            } else {
                $title = '';
                $color = '';
                $image_url = '';
            }
            ?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Color:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" type="text" value="<?php echo $color; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('image_url'); ?>"><?php _e('Image Url:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo $image_url; ?>" />
</p>
<?php
    }

    // update widget
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        // Fields
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['color'] = strip_tags($new_instance['color']);
        $instance['image_url'] = strip_tags($new_instance['image_url']);

        return $instance;
    }

    // display widget
    function widget($args, $instance) {
        extract( $args );
        // these are the widget options
        $title = $instance['title'];
        $color = $instance['color'];
        $image_url = $instance['image_url'];
        echo $before_widget;
        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box"><div class="hero_unit_widget">';

        // Check if text is set
        if( $color && $image_url && $title ) {
            echo '<div class="background" style="color: '.$color.'; background-image: url('.$image_url.');">'.$title.'</div>';
        }


        echo '</div></div>';
        echo $after_widget;
    }
    }

    // register widget
    add_action('widgets_init', create_function('', 'return register_widget("wp_hero_unit_widget");'));

