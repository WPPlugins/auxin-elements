<?php




/*-----------------------------------------------------------------------------------*/
/*  Add shortcode button to tinymce
/*-----------------------------------------------------------------------------------*/

function auxin_register_shortcode_button( $buttons ) {
    array_push( $buttons, '|', 'phlox_shortcodes_button' );
    return $buttons;
}

/**
 * Add the shortcode button to TinyMCE
 *
 * @param array $plugin_array
 * @return array
 */
function auxin_add_elements_tinymce_plugin( $plugin_array ) {
    $wp_version = get_bloginfo( 'version' );

    $plugin_array['phlox_shortcodes_button'] = AUXELS_ADMIN_URL."/assets/js/tinymce/plugins/auxin-btns.js";

    return $plugin_array;
}


function axion_init_shortcode_manager(){
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
        return;

    add_filter( 'mce_external_plugins', 'auxin_add_elements_tinymce_plugin' );
    add_filter( 'mce_buttons', 'auxin_register_shortcode_button' );
}
add_action("init", "axion_init_shortcode_manager");

/*-----------------------------------------------------------------------------------*/
/*  Add Editor styles
/*-----------------------------------------------------------------------------------*/

function auxin_register_mce_buttons_style(){
    wp_register_style('auxin_mce_buttons'  , AUXELS_ADMIN_URL. '/assets/css/editor.css', NULL, '1.1');
    wp_enqueue_style('auxin_mce_buttons');
}
add_action('admin_enqueue_scripts', 'auxin_register_mce_buttons_style');



/*-----------------------------------------------------------------------------------*/
/*  Adds demos tab in theme about (welcome) page
/*-----------------------------------------------------------------------------------*/

function auxin_welcome_page_display_section_demos(){
    // all the demos information should add into this array
    $demos_list = auxin_get_demo_info_list();

    if( ! empty( $demos_list ) ){
        $wpnonce = wp_create_nonce( 'auxin-import' );
    ?>
        <h2 class="aux-featur"><?php _e('Choose the demo you want.', 'auxin-elements'); ?></h2>
        <h4 class="aux-featur demos-subtitle"><?php _e('Please note that, it is recommended to import a demo on a clean WordPress installation.', 'auxin-elements'); ?></h4>
        <div class="changelog feature-section three-col">
    <?php
        foreach( $demos_list as $demo_id => $demo_info ){
    ?>
            <div class="col" id="<?php echo esc_attr( $demo_info['id'] ); ?>">
                <img class="demos-img" src="<?php echo esc_attr( $demo_info['thumb_url'] ); ?>" alt="<?php echo esc_attr( $demo_info['title'] ); ?>">
                <h3><?php echo $demo_info['title']; ?></h3>
                <p><?php  echo $demo_info['desc' ]; ?></p>
                <a href="<?php echo esc_url( $demo_info['preview_url'] ); ?>" class="button button-primary aux-button" target="_blank"><?php _e('Preview', 'auxin-elements'); ?></a>
                <a href="<?php echo admin_url( 'import.php?import=auxin-importer&demo-id=' . $demo_id. '&_wpnonce=' . $wpnonce ); ?>" class="button button-primary aux-button import-demo">
                    <?php _e( 'Import Demo', 'auxin-elements' ); ?>
                </a>
            </div>
    <?php
        }
        echo '</div>';
    }
}

function auxin_welcome_add_section_demos( $sections ){

    $sections['demos'] = array(
        'label'       => __( 'Demos', 'auxin-elements' ),
        'description' => sprintf(__( 'you can see and import the  %s demos in this section.', 'auxin-elements'), THEME_NAME_I18N ),
        'callback'    => 'auxin_welcome_page_display_section_demos'
    );

    return $sections;
}

add_filter( 'auxin_admin_welcome_sections', 'auxin_welcome_add_section_demos', 60 );

/*-----------------------------------------------------------------------------------*/
/*  Adds system status tab in theme about (welcome) page
/*-----------------------------------------------------------------------------------*/

function auxin_about_system_status( $sections ){

    $sections['status'] = array(
        'label'       => __( 'System Status', 'auxin-elements' ),
        'description' => __( 'The informaition about your WordPress installation which can be helpful for debugging or monitoring your website.', 'auxin-elements'),
        'callback'    => 'auxin_get_about_system_status'
    );

    return $sections;
}

add_filter( 'auxin_admin_welcome_sections', 'auxin_about_system_status', 100 );


/*-----------------------------------------------------------------------------------*/
/*  Adds feedback tab in theme about (welcome) page
/*-----------------------------------------------------------------------------------*/

function auxin_welcome_page_display_section_feedback(){
    // the previous rate of the client
    $previous_rate = auxin_get_option( 'user_rating' );
    $support_tab_url = admin_url( 'themes.php?page=auxin-welcome&tab=support' );
    ?>

    <div class="changelog feature-section two-col feedback">

        <form class="aux-feedback-form" action="<?php echo admin_url( 'admin.php?page=auxin-welcome&tab=feedback'); ?>" method="post" >

            <div class="aux-rating-section">
                <h2 class="aux-featur"><?php _e('How likely are you to recommend Phlox to a friend?', 'auxin-elements' ); ?></h2>
                <div class="aux-theme-ratings">
                <?php
                    for( $i = 1; $i <= 5; $i++ ){
                        printf(
                            '<div class="aux-rate-cell"><input type="radio" name="theme_rate" id="theme-rating%1$s" value="%1$s" %2$s/><label class="rating" for="theme-rating%1$s">%1$s</label></div>',
                            $i, checked( $previous_rate, $i, false )
                        );
                    }
                ?>

                </div>
                <div class="aux-ratings-measure">
                    <p>Don't like it</p>
                    <p>Like it so much</p>
                </div>
            </div>

            <div class="aux-feedback-section aux-hide">
                <h2 class="aux-featur"><?php _e('Please explain why you gave this score (optional)', 'auxin-elements'); ?></h2>
                <h4 class="aux-featur feedback-subtitle">
                    <?php
                    printf( __( 'Please do not use this form to get support, in this case please check the %s help section %s', 'auxin-elements' ),
                           '<a href="' . $support_tab_url . '">', '</a>'  ); ?>
                </h4>
                <textarea placeholder="Enter your feedback here" rows="10" name="feedback" class="large-text"></textarea>
                <input type="text" placeholder="Email address (Optional)" name="email" class="text-input" />
                <?php wp_nonce_field( 'phlox_feedback' ); ?>

                <input type="submit" class="button button-primary aux-button" value="Submit feedback" />

                <div class="aux-sending-status">
                    <img  class="ajax-progress aux-hide" src="<?php echo AUX_URL; ?>/css/images/elements/saving.gif" />
                    <span class="ajax-response aux-hide" ><?php _e( 'Submitting your feedback ..', 'auxin-elements' ); ?></span>
                </div>

            </div>

            <?php auxin_send_feedback_mail(); ?>
        </form>
    </div>

    <?php
}

function auxin_welcome_add_section_feedback( $sections ){

    $sections['feedback'] = array(
        'label'       => __( 'Feedback', 'auxin-elements' ),
        'description' => sprintf(__( 'Please leave a feedback and help us to improve %s theme.', 'auxin-elements'), THEME_NAME_I18N ),
        'callback'    => 'auxin_welcome_page_display_section_feedback'
    );

    return $sections;
}

add_filter( 'auxin_admin_welcome_sections', 'auxin_welcome_add_section_feedback', 90 );

function auxin_send_feedback_mail(){
    if  ( ! ( ! isset( $_POST['phlox_feedback'] ) || ! wp_verify_nonce( $_POST['phlox_feedback'], 'feedback_send') ) ) {

        $email    = ! empty( $_POST["email"]    ) ? sanitize_email( $_POST["email"]  ) : 'Empty';
        $feedback = ! empty( $_POST["feedback"] ) ? esc_textarea( $_POST["feedback"] ) : '';

        if( $feedback ){
            wp_mail( 'info@averta.net', 'feedback from phlox dashboard', $feedback . chr(0x0D).chr(0x0A) . 'Email: ' . $email );
            $text = __( 'Thanks for your feedback', 'auxin-elements' );
        } else{
            $text = __('Please try again and fill up at least the feedback field.', 'auxin-elements');
        }

        printf('<p class="notification">%s</p>', $text);
    }
}

/*-----------------------------------------------------------------------------------*/
/*  Adds subtitle meta field to 'Title setting' tab
/*-----------------------------------------------------------------------------------*/

function auxin_add_metabox_field_to_title_setting_tab( $fields, $id, $type ){

    if( 'general-title' == $id ){
        array_unshift(
            $fields,
            array(
                'title'         => __('Subtitle', 'auxin-elements'),
                'description'   => __('Second Title (optional). Note: You have to enable "Display Title Bar Section" option in order to display the subtitle.', 'auxin-elements'),
                'id'            => 'page_subtitle',
                'type'          => 'editor',
                'default'       => ''
            )
        );
    }

    return $fields;
}
add_filter( 'auxin_metabox_fields', 'auxin_add_metabox_field_to_title_setting_tab', 10, 3 );


/*-----------------------------------------------------------------------------------*/
/*  Adds Custom JavaScript meta field to 'Advanced setting' tab
/*-----------------------------------------------------------------------------------*/

function auxin_add_metabox_field_to_advanced_setting_tab( $fields, $id, $type ){

    if( 'general-advanced' == $id ){
        $fields[] = array(
            'title'         => __('Custom JavaScript Code', 'auxin-elements'),
            'description'   => __('Attention: The following custom JavaScript code will be applied ONLY to this page.', 'auxin-elements').'<br />'.
                               __('For defining global JavaScript roles, please use custom javaScript field on option panel.', 'auxin-elements' ),
            'id'            => 'aux_page_custom_js',
            'type'          => 'code',
            'mode'          => 'javascript',
            'default'       => ''
        );
    }
    return $fields;
}
add_filter( 'auxin_metabox_fields', 'auxin_add_metabox_field_to_advanced_setting_tab', 10, 3 );


/*-----------------------------------------------------------------------------------*/
/*  Adding fallback for deprecated theme option name
/*-----------------------------------------------------------------------------------*/

function auxels_sync_deprecated_options(){

    $old_theme_options = get_option( THEME_ID . '_formatted_options' );
    if( false === $old_theme_options ){
        return;
    }

    $new_theme_options = get_option( THEME_ID . '_theme_options' );
    if( false === $new_theme_options ){
        update_option( THEME_ID . '_theme_options', $old_theme_options );
    }
}
add_action( 'admin_init', 'auxels_sync_deprecated_options' );

/*-----------------------------------------------------------------------------------*/
/*  Add allowed custom mieme types
/*-----------------------------------------------------------------------------------*/

function auxin_mime_types( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

add_filter('upload_mimes', 'auxin_mime_types');

/*======================================================================*/

function auxin_elements_add_post_metabox_models( $models ){

    // Load general metabox models
    include_once( 'metaboxes/metabox-fields-post-audio.php'   );
    include_once( 'metaboxes/metabox-fields-post-gallery.php' );
    include_once( 'metaboxes/metabox-fields-post-quote.php'   );
    include_once( 'metaboxes/metabox-fields-post-video.php'   );

    $models[] = array(
        'model'     => auxin_metabox_fields_post_gallery(),
        'priority'  => 20
    );

    $models[] = array(
        'model'     => auxin_metabox_fields_post_video(),
        'priority'  => 22
    );

    $models[] = array(
        'model'     => auxin_metabox_fields_post_audio(),
        'priority'  => 24
    );

    $models[] = array(
        'model'     => auxin_metabox_fields_post_quote(),
        'priority'  => 26
    );

    return $models;
}

add_filter( 'auxin_admin_metabox_models_post', 'auxin_elements_add_post_metabox_models' );


/*-----------------------------------------------------------------------------------*/
/*  Add theme tab in siteorigin page builder
/*-----------------------------------------------------------------------------------*/

function auxin_add_widget_tabs($tabs) {
    $tabs[] = array(
        'title'  => THEME_NAME,
        'filter' => array(
            'groups' => array('auxin')
        )
    );

    if (isset($tabs['recommended'])){
        unset($tabs['recommended']);
    }


    return $tabs;
}
add_filter( 'siteorigin_panels_widget_dialog_tabs', 'auxin_add_widget_tabs', 20 );

// =============================================================================


function auxin_admin_footer_text( $footer_text ) {

    // the admin pages that we intent to display theme footer text on
    $admin_pages = array(
        'toplevel_page_auxin',
        'appearance_page_auxin',
        'toplevel_page_auxin-welcome',
        'appearance_page_auxin-welcome',
        'page',
        'post',
        'widgets',
        'dashboard',
        'edit-post',
        'edit-page',
        'edit-portfolio'
    );

    if( ! ( function_exists('auxin_is_theme_admin_page') && auxin_is_theme_admin_page( $admin_pages ) ) ){
        return $footer_text;
    }

    $welcome_tab_url = admin_url( 'themes.php?page=auxin-welcome&tab=' );

    $auxin_text = sprintf(
        __( 'Quick access to %sdashboard%s, %soptions%s, %ssupport%s and %sfeedback%s page.', 'auxin-elements' ),
        '<a href="'. $welcome_tab_url .'features" title="Version ' . THEME_NAME_I18N . '" >' . THEME_NAME_I18N . ' ',
        '</a>',
        '<a href="'. admin_url( 'customize.php' ). '?url=' . $welcome_tab_url .'features" title="'. __('Theme Customizer', 'auxin-elements' ) .'" >',
        '</a>',
        '<a href="'. $welcome_tab_url .'support">',
        '</a>',
        '<a href="'. $welcome_tab_url .'feedback">',
        '</a>'
    );

    return '<span id="footer-thankyou">' . $auxin_text . '</span>';
}
add_filter( 'admin_footer_text',  'auxin_admin_footer_text' );



/*-----------------------------------------------------------------------------------*/
/*  Assign menus on start or after demo import
/*-----------------------------------------------------------------------------------*/

/**
 * Automatically assigns the appropriate menus to menu locations
 * Known Locations:
 *  - header-primary  : There should be a menu with the word "Primary" Or "Mega" in its name
 *  - header-secondary: There should be a menu with the word "Secondary" in its name
 *  - footer          : There should be a menu with the word "Footer" in its name
 *
 * @return bool         True if at least one menu was assigned, false otherwise
 */
function auxin_assign_default_menus(){

    $assinged = false;
    $locations = get_theme_mod('nav_menu_locations');
    $nav_menus = wp_get_nav_menus();

    foreach ( $nav_menus as $nav_menu ) {
        $menu_name = strtolower( $nav_menu->name );

        if( empty( $locations['header-secondary'] ) && preg_match( '(secondary)', $menu_name ) ){
            $locations['header-secondary'] = $nav_menu->term_id;
            $assinged = true;
        } else if( empty( $locations['header-primary'] ) && preg_match( '(primary|mega|header)', $menu_name ) ){
            $locations['header-primary'] = $nav_menu->term_id;
            $assinged = true;
        } else if( empty( $locations['footer'] ) && preg_match( '(footer)', $menu_name ) ){
            $locations['footer'] = $nav_menu->term_id;
            $assinged = true;
        }
    }

    set_theme_mod( 'nav_menu_locations', $locations );
    return $assinged;
}

add_action( 'after_switch_theme', 'auxin_assign_default_menus' ); // triggers when theme will be actived, WP 3.3
add_action( 'import_end', 'auxin_assign_default_menus' ); // triggers when the theme data was imported
