<sidebar class="sidebar">
    <?php 
    if( is_active_sidebar( 'sidebar-widget-area' ) ) :
        dynamic_sidebar( 'sidebar-widget-area' );
    endif;
    ?>
</sidebar>