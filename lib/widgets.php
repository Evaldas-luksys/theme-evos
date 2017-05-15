<?php
function evos_widgets_init() {
    $widgets[] = array(
        'name' => __( 'Top bar left widget area', 'evos' ),
        'id' => 'topbar-left-widget-area',
        'description' => __( 'This is left top bar widget area', 'evos' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    );

    $widgets[] = array(
        'name' => __( 'Top bar right widget area', 'evos' ),
        'id' => 'topbar-right-widget-area',
        'description' => __( 'This is right top bar widget area', 'evos' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    );

    $widgets[] = array(
        'name' => __( 'Sidebar widget area', 'evos' ),
        'id' => 'sidebar-widget-area',
        'description' => __( 'This is right sidebar widget', 'evos' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    );

    $widgets[] = array(
        'name' => __( 'Footer widget 1', 'evos' ),
        'id' => 'footer-widget-area-1',
        'description' => __( 'This is Footer widget 1', 'evos' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    );

    $widgets[] = array(
        'name' => __( 'Footer widget 2', 'evos' ),
        'id' => 'footer-widget-area-2',
        'description' => __( 'This is Footer widget 2', 'evos' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    );


    $widgets[] = array(
        'name' => __( 'Footer widget 3', 'evos' ),
        'id' => 'footer-widget-area-3',
        'description' => __( 'This is Footer widget 3', 'evos' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    );


    foreach ($widgets as $key => $widget) :
        register_sidebar($widget);
    endforeach;
}
add_action( 'widgets_init', 'evos_widgets_init' );


// Creating the widget 
class evos_social_widget extends WP_Widget {

    private $socials = array('facebook', 'twitter', 'instagram', 'pinterest', 'linkedin', 'youtube');
    private $link_target = array( '_blank' => 'New Tab' );

    function __construct() {
        parent::__construct(
        'evos_social_widget', 
        __('Evos: Social widget', 'evos'), 
        array( 'description' => __( 'This widget displays social links', 'evos' ), ) 
        );
    }

    // Creating widget front-end
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        ?>
        <h3 class="widget-title"><?php echo $instance['title'];?></h3>

        <ul class="icons">
            <?php
                foreach ($this->socials as $key => $social_index) :
                    if( !empty($instance[$social_index]) )
                        printf( '<li class="item-icons"><a href="%s" target="%s"></a></li>', $instance[$social_index], $instance['link_target'] );
                endforeach;
            ?>
        </ul>
        <?php echo $args['after_widget'];?>

        <?php
    }
            
    // Widget Backend
    public function form( $instance ) {
        $title = isset($instance[ 'title' ]) ? $instance[ 'title' ] : '';
        $link_target = isset($instance[ 'link_target' ]) ? $instance[ 'link_target' ] : '';
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <?php
        /**
        * Social icons fields
        */
        foreach ($this->socials as $key => $social_index) :
            $social_value  = isset($instance[ $social_index ]) ? $instance[ $social_index ] : '';
            ?>
            <p>
                <label for="<?php echo $social_index;?>"><?php _e( "{$social_index}:" ); ?></label> 
                <input class="widefat" id="<?php echo $social_index;?>" name="<?php echo $this->get_field_name( $social_index );?>" type="text" value="<?php echo esc_attr( $social_value ); ?>" />
            </p>
            <?php
        endforeach;
        ?>

        <?php
        /**
        * Link target options
        */
        ?>
        <select name="<?php echo $this->get_field_name( 'link_target' );?>">
            <?php if( $instance[ 'link_target' ] === '_self' || empty($instance[ 'link_target' ]) ) : ?>
                <option value="_self" selected="selected">Same page</option>
            <?php else : ?>
                 <option value="_self">Same page</option>
            <?php endif;?>
            
            <?php 
                foreach ($this->link_target as $key => $value) :
                    printf( '<option value="%s" %s>%s</option>', $key, ($key === $instance[ 'link_target' ]) ? 'selected="selected"' : '', $value );
                endforeach; 
            ?>
        </select>

        <?php
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['link_target'] = ( ! empty( $new_instance['link_target'] ) ) ? strip_tags( $new_instance['link_target'] ) : '';

        foreach ($this->socials as $key => $social_index) :
            $instance[$social_index] = ( ! empty( $new_instance[$social_index] ) ) ? strip_tags( $new_instance[$social_index] ) : '';
        endforeach;

        return $instance;
    }
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
    register_widget( 'evos_social_widget' );
    register_widget( 'evos_widget_recent_posts' );
    register_widget( 'evos_widget_call_to_action' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

/**
 * Widget API: WP_Widget_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */
/**
 * Core class used to implement a Recent Posts widget.
 * 
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Evos_Widget_Recent_Posts extends WP_Widget {
    /**
     * Sets up a new Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'evos_widget_recent_entries',
            'description' => __( 'Your site&#8217;s most recent Posts.' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'evos_widget_recent_posts', __( 'Evos: Recent Posts' ), $widget_ops );
        $this->alt_option_name = 'evos_widget_recent_posts';
    }
    /**
     * Outputs the content for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Posts widget instance.
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
        /**
         * Filters the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );
        if ($r->have_posts()) :
        ?>
        <?php echo $args['before_widget']; ?>
        <?php if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>
        <ul class="evos-recent-posts">
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <li class="item-widget">
                <div class="frow justify-between">
                    <?php if( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail');?></a>
                    <?php endif;?>
                    <div class="item-widget-inner">
                        <h4 class="item-widget-title">
                            <a href="<?php the_permalink(); ?>" class="post-title-wrapper">
                                <?php get_the_title() ? the_title() : the_ID(); ?>
                            </a>
                        </h4>
                         <?php if ( $show_date ) : ?>
                            <div class="item-post-date">
                                <i class="fa fa-clock-o icon" aria-hidden="true"></i>
                                <span class="item-post-date-inner">
                                    <?php echo get_the_date(); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    <span class="item-widget-content"><?php echo substr(get_the_excerpt(), 0, 80);?>...</span> 
                    </div>
                    </div>
            </li>
        <?php endwhile; ?>
        </ul>
        <?php echo $args['after_widget']; ?>
        <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();
        endif;
    }
    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
        return $instance;
    }
    /**
     * Outputs the settings form for the Recent Posts widget.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
        <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
    }
}

/**
 * Widget API: WP_Widget_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */
/**
 * Core class used to implement a Recent Posts widget.
 * 
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Evos_Widget_Call_To_Action extends WP_Widget {
    /**
     * Sets up a new Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'evos_widget_call_to_action',
            'description' => __( 'Call to action widget.' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'evos_widget_call_to_action', __( 'Call To Action' ), $widget_ops );
        $this->alt_option_name = 'evos_widget_recent_entries';
    }
    /**
     * Outputs the content for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Posts widget instance.
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        // $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
        // /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        // $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        // $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        // if ( ! $number )
        //     $number = 5;
        // $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
        /**
         * Filters the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
    }
    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['description'] = sanitize_text_field( $new_instance['description'] );
        return $instance;
    }
    /**
     * Outputs the settings form for the Recent Posts widget.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        
        $title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $description  = isset( $instance['description'] ) ? esc_attr( $instance['description'] ) : '';
?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo $description; ?>" /></p>

<?php
    }
}