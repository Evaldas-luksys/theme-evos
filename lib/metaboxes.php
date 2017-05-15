<?php
/**
 * Sparkling Meta Boxes
 *
 */
add_action('add_meta_boxes', 'evos_add_custom_metaboxes');
/**
 * Add Meta Boxes.
 *
 * Add Meta box in page and post post types.
 */
function evos_add_custom_metaboxes()
{   
    add_meta_box('evos_singular_options',
    __('Choose the layout for this specific page', 'evos'),
    'evos_add_singular_options',
    array('page', 'post')
    );
}

/**
 * Displays metabox to for sidebar layout
 */
function evos_add_singular_options(){
    evos_add_layout_options();
    evos_display_top_banner();
}

add_action('save_post', 'evos_save_custom_metaboxes');
/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function evos_save_custom_metaboxes($post_id){

    // Verify the nonce before proceeding.
    if (!isset($_POST['custom_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    $metaboxes = array( 'evos_layout_options', 'evos_display_top_banner' );

    foreach ($metaboxes as $key) :
        if( isset( $_POST[$key] ) ) :
            update_post_meta($post_id, $key, $_POST[$key]);
        else :
            delete_post_meta($post_id, $key);
        endif;
    endforeach;
}

/**
 * Displays metabox to for sidebar layout
 */
function evos_add_layout_options(){
    global $evos_extra_options, $post;
    // Use nonce for verification
    wp_nonce_field(basename(__FILE__), 'custom_meta_box_nonce');
    $layout_option = get_post_meta($post->ID, 'evos_layout_options', true);
?>
    <p>
    <label class="description" for="evos_layout_options">Choose layout option:</label>
         <select name="evos_layout_options" id="evos_layout_options">
            <option value="">Default</option><?php
            foreach( $evos_extra_options['evos_layout_options'] as $key=>$val ) { ?>
            <option value="<?php echo $key; ?>" <?php echo $layout_option === $key ? 'selected="selected"': '';?>><?php echo $val; ?></option><?php
            }?>
        </select>
    </p>
    
<?php
}

/**
 * Displays metabox to for sidebar layout
 */
function evos_display_top_banner(){
    global $post;

    wp_nonce_field(basename(__FILE__), 'custom_meta_box_nonce'); ?>

    <?php $evos_banner = get_post_meta($post->ID, 'evos_display_top_banner', true);?>
    <form action="">
      <p>Display top banner?</p>
      <input type="radio" name="evos_display_top_banner" value=""<?php echo empty($evos_banner) ? ' checked' : '';?>>Default<br>
      <input type="radio" name="evos_display_top_banner" value="on"<?php echo $evos_banner === 'on' ? ' checked' : '';?>>Enable<br>
      <input type="radio" name="evos_display_top_banner" value="off"<?php echo $evos_banner === 'off' ? ' checked' : '';?>>Disable
    </form>
   
    <?php
}


/****************************************************************************************/


// add_action('save_post', 'evos_save_custom_metaboxes');
// /**
//  * save the custom metabox data
//  * @hooked to save_post hook
//  */
// function evos_save_custom_metaboxes($post_id)
// {
//     if( !isset( $_POST['evos_layout_options'] ) )
//         return;

//     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
//         return;

//     // Verify the nonce before proceeding.
//     if (!isset($_POST['custom_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
//         return;

//     global $evos_layout_options, $post;

//     update_post_meta($post_id, 'evos_layout_options', $_POST['evos_layout_options']);
    


//     // if ('page' == $_POST['post_type']) {
//     //     if (!current_user_can('edit_page', $post_id))
//     //         return $post_id;
//     // } elseif (!current_user_can('edit_post', $post_id)) {
//     //     return $post_id;
//     // }
// }