<?php
/**
 * Before Single Products Summary Div
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */



/**
 * Adds a mian css class indicator to body tag
 *
 * @param  array $classes  List of body css classes
 * @return array           The modified list of body css classes
 */
function auxels_body_class( $classes ) {
  $classes[]      = '_auxels';

  return $classes;
}
add_filter( 'body_class', 'auxels_body_class' );



/**
 * Add meta custom field types for vc
 *
 * @return void
 */
function auxin_add_vc_field_types(){

    if ( defined( 'WPB_VC_VERSION' ) ) {

        // aux_iconpicker field type definition for VC
        vc_add_shortcode_param( 'aux_iconpicker', 'auxin_aux_iconpicker_settings_field', ADMIN_JS_URL . 'scripts.js' );
        function auxin_aux_iconpicker_settings_field( $settings, $value ) {

            $font_icons = Auxin()->Font_Icons->get_icons_list('fontastic');
            $output = '<div class="aux-element-field aux-iconpicker">';
            $output .= sprintf( '<select name="%1$s" id="%1$s" class="aux-fonticonpicker aux-select wpb_vc_param_value wpb-select  ' .
                    esc_attr( $settings['param_name'] ) . ' ' . $settings['type'] . '_field" >',  esc_attr($settings['param_name'])  );
            $output .= '<option value="">' . __('Choose ..', 'auxin-elements') . '</option>';

            if( is_array( $font_icons ) ) {
                foreach ( $font_icons as $icon ) {
                    $icon_id = trim( $icon->classname, '.' );
                    // $output .= '<option value="'. $icon_id .'" '. selected( $instance[$id], $icon_id, false ) .' >'. $icon->name . '</option>';
                    $output .= '<option value="'. $icon_id .'" '. selected( esc_attr( $value ) , $icon_id, false ) .' >'. $icon->name . '</option>';

                }
            }

            $output .= '</select>';
            $output .= '</div>';

           return   $output; // This is html markup that will be outputted in content elements edit form
        }

        // aux_visual_select field type definition for VC
        vc_add_shortcode_param( 'aux_visual_select', 'auxin_aux_visual_select_settings_field', ADMIN_JS_URL . 'scripts.js' );
        function auxin_aux_visual_select_settings_field( $settings, $value ) {
         
            $output = '<select name="' . esc_attr($settings['param_name']) .
            '" class="aux-element-field visual-select-wrapper wpb_vc_param_value wpb-select  ' .
            esc_attr( $settings['param_name'] ) . ' ' . $settings['type'] . '_field" '.
            ' id="' . esc_attr($settings['param_name']) .
            '" data-option="' . esc_attr( $value ) .  '" >';
            foreach ( $settings['choices'] as $id => $option_info ) {
                $active_attr = ( $id == esc_attr( $value ) ) ? 'selected' : '';
                $data_class  = isset( $option_info['css_class'] ) && ! empty( $option_info['css_class'] ) ? 'data-class="'. $option_info['css_class'].'"' : '';
                $data_symbol = empty( $data_class ) && isset( $option_info['image'] ) && ! empty( $option_info['image'] ) ? 'data-symbol="'. $option_info['image'].'"' : '';
                $css_classs  =  'class="'. ($id) .'"';
                $output     .= sprintf( '<option value="%s" %s %s %s %s>%s</option>', $id,$css_classs, $active_attr, $data_symbol, $data_class, $option_info['label']  );
            }
            $output .= '</select>';

            return   $output; // This is html markup that will be outputted in content elements edit form
        }

        // aux_select_audio field type definition for VC
        vc_add_shortcode_param( 'aux_select_audio', 'aux_select_audio_settings_field', ADMIN_JS_URL . 'scripts.js' );
        function aux_select_audio_settings_field( $settings, $value ) {

            // Store attachment src for avertaAttachMedia field
            if( !empty( $value) ) {
                $att_ids = explode( ',', $value );
                $attach_ids_list = auxin_get_the_resized_attachment_src( $att_ids, 80, 80, true );
                    if(!empty($att_ids)) {
                        printf( "<script>auxin.attachmedia = jQuery.extend( auxin.attachmedia, %s );</script>", json_encode( array_unique( $attach_ids_list ) ) );
                    }
            }
            $output = '';
            $output .= '<div class="aux-element-field av3_container aux_select_image axi-attachmedia-wrapper">'.
                                '<input type="text" class="wpb-multiselect wpb_vc_param_value ' . esc_sql($settings['param_name']) . ' ' .  $settings['type'] . '_field"  name="' . esc_attr($settings['param_name']) . '" ' . 'id="' . esc_attr($settings['param_name']) . '" '
                                . 'value="' . esc_attr( $value ) . '" data-media-type="audio" data-limit="1" data-multiple="0"'
                                .'data-add-to-list="'.__('Add Audio', 'auxin-elements').'" '
                                .'data-uploader-submit="'.__('Add Audio', 'auxin-elements').'"'
                                .'data-uploader-title="'.__('Select Audio', 'auxin-elements').'"> '
                        .'</div>';

            return   $output; // This is html markup that will be outputted in content elements edit form
        }

         // aux_select_video field type definition for VC
        vc_add_shortcode_param( 'aux_select_video', 'aux_select_video_settings_field', ADMIN_JS_URL . 'scripts.js' );
        function aux_select_video_settings_field( $settings, $value ) {

            // Store attachment src for avertaAttachMedia field
            if( !empty( $value) ) {
                $att_ids = explode( ',', $value );
                $attach_ids_list = auxin_get_the_resized_attachment_src( $att_ids, 80, 80, true );
                if(!empty($att_ids)) {
                    printf( "<script>auxin.attachmedia = jQuery.extend( auxin.attachmedia, %s );</script>", json_encode( array_unique( $attach_ids_list ) ) );
                }
            }
            $output = '';
            $output .= '<div class="aux-element-field av3_container aux_select_image axi-attachmedia-wrapper">'.
                                '<input type="text" class="wpb-multiselect wpb_vc_param_value ' . esc_sql($settings['param_name']) . ' ' .  $settings['type'] . '_field"  name="' . esc_attr($settings['param_name']) . '" ' . 'id="' . esc_attr($settings['param_name']) . '" '
                                . 'value="' . esc_attr( $value ) . '" data-media-type="video" data-limit="1" data-multiple="0"'
                                .'data-add-to-list="'.__('Add Video', 'auxin-elements').'" '
                                .'data-uploader-submit="'.__('Add Video', 'auxin-elements').'"'
                                .'data-uploader-title="'.__('Select Video', 'auxin-elements').'"> '
                        .'</div>';

           return   $output; // This is html markup that will be outputted in content elements edit form
        }

        // aux_select2_multiple field type definition for VC
        vc_add_shortcode_param( 'aux_select2_multiple', 'aux_multiple_selector_settings_field', ADMIN_JS_URL . 'scripts.js' );
        function aux_multiple_selector_settings_field( $settings, $value ) {

            if( gettype( $value ) === "string" ) {
                $value = explode( ",", $value);
            }
            $select = $value;
            $output = '';
            $output .= '<select multiple="multiple" name="' . esc_sql($settings['param_name']) . '"  style="width:100%" '  . ' class="wpb-multiselect wpb_vc_param_value aux-select2-multiple ' . esc_sql($settings['param_name']) . ' ' .  $settings['type'] . '_field" '. '>';
                    foreach ( $settings['value'] as $id => $option_info ) {
                       $active_attr = in_array( $id, $select) ? 'selected="selected"' : '';
                       $output     .= sprintf( '<option value="%s" %s >%s</option>', $id, $active_attr, $option_info  );
                    }
            $output.= '</select>';

            return   $output; // This is html markup that will be outputted in content elements edit form
        }

        // aux_taxonomy field type definition for VC
        vc_add_shortcode_param( 'aux_taxonomy', 'aux_taxonomy_selector_settings_field', ADMIN_JS_URL . 'scripts.js' );
        function aux_taxonomy_selector_settings_field( $settings, $value ) {
            
            $categories = get_terms(
                array( 'taxonomy'   => $settings['taxonomy'],
                        'orderby'    => 'count',
                        'hide_empty' => true
                ));

            $categories_list = array( ' ' => __('All Categories', AUXPFO_DOMAIN ) );
            foreach ( $categories as $key => $value_id ) {
                $categories_list[$value_id->term_id] = $value_id->name;
            }
            if( gettype( $value ) === "string" ) {
                $value = explode( ",", $value);
            }
            $selected = $value;
            $output = '';
            $output .= '<select multiple="multiple" name="' . $settings['param_name'] . '"  style="width:100%" '  . ' class="wpb-multiselect wpb_vc_param_value aux-select2-multiple ' . esc_sql($settings['param_name']) . ' '  . 'aux-admin-select2 ' . $settings['type'] . '_field" '. '>';
            foreach ( $categories_list as $id => $options_info ) {
                $active_attr = in_array( $id, $selected) ? 'selected="selected"' : '';
                $output     .= sprintf( '<option value="%s" %s >%s</option>', $id, $active_attr, $options_info  );
            }
            $output.= '</select>';

           return   $output; // This is html markup that will be outputted in content elements edit form
        }

        vc_add_shortcode_param( 'aux_switch', 'auxin_aux_switch_settings_field', ADMIN_JS_URL . 'scripts.js' );
        function auxin_aux_switch_settings_field( $settings, $value ) {
            $active_attr =  auxin_is_true( $value ) ? 'checked="checked"' : '';
            return  '<div class="av3_container aux_switch">'.
                         '<input type="checkbox" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb_checkbox checkbox '.
                            esc_attr( $settings['param_name'] ) . ' ' .
                            esc_attr( $settings['type'] ) . '_field' .
                         '" value="' . esc_attr( $value ) . '" ' . $active_attr . ' >' .
                    '</div>'; // This is html markup that will be outputted in content elements edit form
        }



    }

    /**
     * Enqueue all my widget's admin scripts
     */
    function auxin_widgets_enqueue_scripts(){
        wp_enqueue_script('auxin_widget');

    }
    add_action( 'admin_print_scripts-widgets.php', 'auxin_widgets_enqueue_scripts' );

    // Add this to enqueue your scripts on Page Builder too
    add_action('siteorigin_panel_enqueue_admin_scripts', 'auxin_widgets_enqueue_scripts');

    /**
     * This part is for adding Auxin font icon to Visual composer icon
     * this is just temporary and need to move and write in a better manner when it is compelete
     * TODO: just for now to see it is working
     */

        // Add Auxin icons to Visual Composer icons
        $settings = array(
          'name'     => __( 'Auxin Icons', 'auxin-elements' ),
          'category' => THEME_NAME,
          'params'   => array(
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Icon library', 'auxin-elements' ),
                    'value' => array(
                        __( 'Font Awesome', 'auxin-elements' ) => 'fontawesome',
                        __( 'Open Iconic', 'auxin-elements' )  => 'openiconic',
                        __( 'Typicons', 'auxin-elements' )     => 'typicons',
                        __( 'Entypo', 'auxin-elements' )       => 'entypo',
                        __( 'Linecons', 'auxin-elements' )     => 'linecons',
                        __( 'Auxin', 'auxin-elements' )        => 'auxin'
                    ),
                    'admin_label' => true,
                    'param_name'  => 'type',
                    'description' => __( 'Select icon library.', 'auxin-elements' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon', 'auxin-elements' ),
                    'param_name' => 'icon_auxin',
                    'value'      => 'auxin-icon-basket-1', // default value to backend editor admin_label
                    'settings'   => array(
                        'emptyIcon'    => false,
                        // default true, display an "EMPTY" icon?
                        'type'         => 'auxin',
                        'iconsPerPage' => 4000
                        // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'auxin'
                    ),
                    'description' => __( 'Select icon from library.', 'auxin-elements' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon', 'auxin-elements' ),
                    'param_name' => 'icon_fontawesome',
                    'value'      => 'fa fa-adjust', // default value to backend editor admin_label
                    'settings'   => array(
                        'emptyIcon' => false,
                        // default true, display an "EMPTY" icon?
                        'iconsPerPage' => 4000
                        // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'fontawesome'
                    ),
                    'description' => __( 'Select icon from library.', 'auxin-elements' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon', 'auxin-elements' ),
                    'param_name' => 'icon_openiconic',
                    'value'      => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                    'settings'   => array(
                        'emptyIcon'    => false, // default true, display an "EMPTY" icon?
                        'type'         => 'openiconic',
                        'iconsPerPage' => 4000   // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'openiconic'
                    ),
                    'description' => __( 'Select icon from library.', 'auxin-elements' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon', 'auxin-elements' ),
                    'param_name' => 'icon_typicons',
                    'value'      => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                    'settings'   => array(
                        'emptyIcon'    => false, // default true, display an "EMPTY" icon?
                        'type'         => 'typicons',
                        'iconsPerPage' => 4000 // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'typicons'
                    ),
                    'description' => __( 'Select icon from library.', 'auxin-elements' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon', 'auxin-elements' ),
                    'param_name' => 'icon_entypo',
                    'value'      => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
                    'settings'   => array(
                        'emptyIcon'    => false, // default true, display an "EMPTY" icon?
                        'type'         => 'entypo',
                        'iconsPerPage' => 4000 // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'entypo'
                    ),
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon', 'auxin-elements' ),
                    'param_name' => 'icon_linecons',
                    'value'      => 'vc_li vc_li-heart', // default value to backend editor admin_label
                    'settings'   => array(
                        'emptyIcon'    => false, // default true, display an "EMPTY" icon?
                        'type'         => 'linecons',
                        'iconsPerPage' => 4000   // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'linecons'
                    ),
                    'description' => __( 'Select icon from library.', 'auxin-elements' ),
                ),

                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Custom color', 'auxin-elements' ),
                    'param_name'  => 'custom_color',
                    'description' => __( 'Select custom icon color.', 'auxin-elements' ),
                    'dependency'  => array(
                        'element' => 'color',
                        'value'   => 'custom'
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Background shape', 'auxin-elements' ),
                    'param_name' => 'background_style',
                    'value'      => array(
                        __( 'None', 'auxin-elements' )            => '',
                        __( 'Circle', 'auxin-elements' )          => 'rounded',
                        __( 'Square', 'auxin-elements' )          => 'boxed',
                        __( 'Rounded', 'auxin-elements' )         => 'rounded-less',
                        __( 'Outline Circle', 'auxin-elements' )  => 'rounded-outline',
                        __( 'Outline Square', 'auxin-elements' )  => 'boxed-outline',
                        __( 'Outline Rounded', 'auxin-elements' ) => 'rounded-less-outline'
                    ),
                    'description' => __( 'Select background shape and style for icon.', 'auxin-elements' )
                ),

                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Custom background color', 'auxin-elements' ),
                    'param_name'  => 'custom_background_color',
                    'description' => __( 'Select custom icon background color.', 'auxin-elements' ),
                    'dependency'  => array(
                        'element' => 'background_color',
                        'value'   => 'custom'
                    ),
                ),

                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Icon alignment', 'auxin-elements' ),
                    'param_name' => 'align',
                    'value'      => array(
                        __( 'Left', 'auxin-elements' )   => 'left',
                        __( 'Right', 'auxin-elements' )  => 'right',
                        __( 'Center', 'auxin-elements' ) => 'center'
                    ),
                    'description' => __( 'Select icon alignment.', 'auxin-elements' ),
                ),

            ),

        );

        if ( defined( 'WPB_VC_VERSION' ) ) {

        // vc_map_update('vc_icon', $settings );

        //  TODO: This is a sample we need to create an array for all the icons and also enque its css file
        // add_filter( 'vc_iconpicker-type-auxin', 'vc_iconpicker_type_auxin' );
        function vc_iconpicker_type_auxin( $icons ) {
            $auxin_icons = array(
                "Test" => array(
                    array( 'auxin-icon auxin-icon-2-arrows' => __( 'Arrow', 'auxin-elements' ) ),
                    array( 'auxin-icon auxin-icon-basket-1' => __( 'Arrow', 'auxin-elements' ) ),
                    array( 'auxin-icon auxin-icon-back-pack' => __( 'Back', 'auxin-elements' ) )
                )
            );

            return array_merge( $icons, $auxin_icons );
        }

        // add_action( 'vc_backend_editor_enqueue_js_css', 'auxin_vc_iconpicker_editor_jscss' );
        // @see Vc_Frontend_Editor::enqueueAdmin (wp-content/plugins/js_composer/include/classes/editors/class-vc-frontend-editor.php),
        // used to enqueue needed js/css files when frontend editor is rendering
        // add_action( 'vc_frontend_editor_enqueue_js_css', 'auxin_vc_iconpicker_editor_jscss' );
        function auxin_vc_iconpicker_editor_jscss () {
            wp_enqueue_style( 'auxin_font' );
        }

        // @see Vc_Base::frontCss, used to append actions when frontCss(frontend editor/and real view mode) method called
        // This action registers all styles(fonts) to be enqueue later
        add_action( 'vc_base_register_front_css', 'auxin_vc_iconpicker_base_register_css' );

        // @see Vc_Base::registerAdminCss, used to append action when registerAdminCss(backend editor) method called
        // This action registers all styles(fonts) to be enqueue later
        add_action( 'vc_base_register_admin_css', 'auxin_vc_iconpicker_base_register_css' );
        function auxin_vc_iconpicker_base_register_css () {
            wp_register_style( 'auxin_font', vc_asset_url( 'css/lib/auxin-font/auxin-font.css' ), false, WPB_VC_VERSION, 'screen' );
        }


    }

}
add_action( 'auxin_admin_loaded', 'auxin_add_vc_field_types' );


/**
 * load custom shortcodes, templates and element in visual composer start
 *
 * @return void
 */
function auxin_on_vc_plugin_loaded(){
    global $vc_manager;
    if( ! is_null( $vc_manager ) ) {
        $auxin_shortcodes_template_dir = AUXELS_PUB_DIR . '/templates/vcomposer';
        $vc_manager->setCustomUserShortcodesTemplateDir( $auxin_shortcodes_template_dir );
    }
}
add_action( 'plugins_loaded', 'auxin_on_vc_plugin_loaded' );



function auxin_add_theme_options_in_plugin( $fields_sections_list ){

    // Sub section - Custom JS ------------------------------------

    $fields_sections_list['sections'][] = array(
        'id'          => 'general-section-custom-js',
        'parent'      => 'general-section', // section parent's id
        'title'       => __( 'Custom JS Code', 'auxin-elements'),
        'description' => __( 'Your Custom Javascript', 'auxin-elements')
    );

    $fields_sections_list['fields'][] = array(
        'title'         => __('Custom Javascript in Head', 'auxin-elements'),
        'description'   => sprintf( __('You can add your custom javascript code here.%s DO NOT use %s tag.', 'auxin-elements'), '<br />' , '<code>&lt;script&gt;</code>' )."<br />".
                           __('In order to save your custom javascript code, you are expected to execute the code prior for saving.', 'auxin-elements'),
        'id'            => 'auxin_user_custom_js_head',
        'section'       => 'general-section-custom-js',
        'dependency'    => array(),
        'default'       => '',
        'transport'     => 'postMessage',
        'button_labels' => array( 'label' => __('Execute', 'auxin-elements') ),
        'mode'          => 'javascript',
        'type'          => 'code'
    );

    $fields_sections_list['fields'][] = array(
        'title'         => __('Custom Javascript in Footer', 'auxin-elements'),
        'description'   => sprintf( __('You can add your custom javascript code here.%s DO NOT use %s tag.', 'auxin-elements'), '<br />' , '<code>&lt;script&gt;</code>' )."<br />".
                           __('In order to save your custom javascript code, you are expected to execute the code prior for saving.', 'auxin-elements'),
        'id'            => 'auxin_user_custom_js',
        'section'       => 'general-section-custom-js',
        'dependency'    => array(),
        'default'       => '',
        'transport'     => 'postMessage',
        'button_labels' => array( 'label' => __('Execute', 'auxin-elements') ),
        'mode'          => 'javascript',
        'type'          => 'code'
    );


    // Sub section - SEO ----------------------------------

    $fields_sections_list['sections'][] = array(
        'id'          => 'general-section-seo',
        'parent'      => 'general-section', // section parent's id
        'title'       => __( 'Google API Keys & SEO', 'auxin-elements'),
        'description' => __( 'Google API Keys & SEO', 'auxin-elements')
    );


    $fields_sections_list['fields'][] = array(
        'title'         => __('Built in SEO', 'auxin-elements'),
        'description'   => __('In case of using SEO plugins like "WordPress SEO by Yoast" or "All in One SEO Pack" you can disable built-in SEO for maximum compatibility.',
                              'auxin-elements'),
        'id'            => 'enable_theme_seo',
        'section'       => 'general-section-seo',
        'dependency'    => array(),
        'default'       => '1',
        'type'          => 'switch'
    );

    $fields_sections_list['fields'][] = array(
        'title'         => __('Google analytics code', 'auxin-elements'),
        'description'   => sprintf( __('You can add your Google analytics code here.%s DO NOT use %s tag.', 'auxin-elements'), '<br />' , '<code>&lt;script&gt;</code>' ),
        'id'            => 'auxin_user_google_analytics',
        'section'       => 'general-section-seo',
        'dependency'    => array(),
        'default'       => '',
        'transport'     => 'postMessage',
        'mode'          => 'javascript',
        'button_labels' => array( 'label' => false ),
        'type'          => 'code'
    );

    $fields_sections_list['fields'][] = array(
        'title'         => __('Google maps API key', 'auxin-elements'),
        'description'   => sprintf(
                            __( 'In order to use google maps on your website,  you have to %s create an api key %s and insert it in this field.', 'auxin-elements' ),
                            '<a href="https://developers.google.com/maps/documentation/javascript/" target="_blank">',
                            '</a>'
                        ),
        'id'            => 'auxin_google_map_api_key',
        'section'       => 'general-section-seo',
        'dependency'    => array(),
        'default'       => '',
        'transport'     => 'postMessage',
        'mode'          => 'javascript',
        'type'          => 'text'
    );

    $fields_sections_list['fields'][] = array(
        'title'         => __('Google marketing code', 'auxin-elements'),
        'description'   => sprintf( __('You can add your Google marketing code here.%s DO NOT use %s tag.', 'auxin-elements'), '<br />' , '<code>&lt;script&gt;</code>' ),
        'id'            => 'auxin_user_google_marketing',
        'section'       => 'general-section-seo',
        'dependency'    => array(),
        'default'       => '',
        'transport'     => 'postMessage',
        'mode'          => 'javascript',
        'button_labels' => array( 'label' => false ),
        'type'          => 'code'
    );



    $fields_sections_list['fields'][] = array(
        'title'       => __('Footer Brand Image', 'auxin-elements'),
        'description' => __('This image appears as site brand image on footer section.', 'auxin-elements'),
        'id'          => 'site_secondary_logo_image',
        'section'     => 'footer-section-footer',
        'dependency'  => array(
            array(
                 'id'      => 'show_site_footer',
                 'value'   => array('1'),
                 'operator'=> '=='
            )
        ),
        'default'     => '',
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.aux-logo-footer .aux-logo-anchor',
            'container_inclusive'   => false,
            'render_callback'       => function(){ echo _auxin_get_footer_logo_image(); }
        ),
        'type'        => 'image'
    );

    $fields_sections_list['fields'][] = array(
        'title'       => __('Footer Brand Height', 'auxin-elements'),
        'description' => __('Specifies maximum height of logo in footer.', 'auxin-elements'),
        'id'          => 'site_secondary_logo_max_height',
        'section'     => 'footer-section-footer',
        'dependency'  => array(
            array(
                 'id'      => 'show_site_footer',
                 'value'   => array('1'),
                 'operator'=> '=='
            )
        ),
        'default'        => '50',
        'transport'      => 'postMessage',
        'post_js'        => '$(".aux-logo-footer .aux-logo-anchor img").css( "max-height", $.trim(to) + "px" );',
        'style_callback' => function( $value = null ){
            if( ! $value ){
                $value = auxin_get_option( 'site_secondary_logo_max_height' );
            }
            $value = trim( $value, 'px');
            return $value ? ".aux-logo-footer .aux-logo-anchor img { max-height:{$value}px; }" : '';
        },
        'type'        => 'text'
    );




    // Sub section - Login page customizer -------------------------------

    $fields_sections_list['sections'][] = array(
        'id'          => 'tools-section-login',
        'parent'      => 'tools-section', // section parent's id
        'title'       => __( 'Login Page', 'auxin-elements'),
        'description' => __( 'Preview login page', 'auxin-elements') . ' '. sprintf(
            '<a href="%s" class="section-title-icon axicon-link-ext" target="_self" title="%s" ></a>',
            '?url='.wp_login_url(), __('Preview login page', 'auxin-elements')
        )
    );



    $fields_sections_list['fields'][] = array(
        'title'       => __('Login Skin', 'auxin-elements'),
        'description' => __('Specifies a skin for login page of your website.', 'auxin-elements'),
        'id'          => 'auxin_login_skin',
        'section'     => 'tools-section-login',
        'dependency'  => array(),
        'choices'     => array(
            'default'   =>  array(
                'label' => __('Default', 'auxin-elements'),
                'image' => AUX_URL . 'images/visual-select/login-skin-default.svg'
            ),
            'clean-white'   =>  array(
                'label' => __('Clean white', 'auxin-elements'),
                'image' => AUX_URL . 'images/visual-select/login-skin-light.svg'
            ),
            'simple-white'   =>  array(
                'label' => __('Simple white', 'auxin-elements'),
                'image' => AUX_URL . 'images/visual-select/login-skin-simple-light.svg'
            ),
            'simple-gray'   =>  array(
                'label' => __('Simple gray', 'auxin-elements'),
                'image' => AUX_URL . 'images/visual-select/login-skin-simple-gray.svg'
            )
        ),
        'transport' => 'refresh',
        'default'   => 'default',
        'type'      => 'radio-image'
    );

    $fields_sections_list['fields'][] = array(
        'title'       => __('Login message', 'auxin-elements'),
        'description' => __('Enter a text to display above of login form.', 'auxin-elements'),
        'id'          => 'auxin_login_message',
        'section'     => 'tools-section-login',
        'dependency'  => array(),
        'transport'   => 'refresh',
        'type'        => 'textarea',
        'default'     => ''
    );

    //--------------------------------

    $fields_sections_list['fields'][] = array(
        'title'       =>  __('Login Page Logo', 'auxin-elements'),
        'description' =>  __('Specifies a logo to display on login page.(width of logo image could be up to 320px)', 'auxin-elements'),
        'id'          =>  'auxin_login_logo_image',
        'section'     =>  'tools-section-login',
        'dependency'  => array(),
        'transport'   => 'refresh',
        'default'     =>  '',
        'type'        =>  'image'
    );


    $fields_sections_list['fields'][] = array(
        'title'       => __('Logo Width', 'auxin-elements'),
        'description' => __('Specifies width of logo image in pixel.', 'auxin-elements'),
        'id'          => 'auxin_login_logo_width',
        'section'     => 'tools-section-login',
        'dependency'  => array(),
        'transport'   => 'refresh',
        'default'     => '84',
        'type'        => 'text'
    );


    $fields_sections_list['fields'][] = array(
        'title'       => __('Logo Height', 'auxin-elements'),
        'description' => __('Specifies height of logo image in pixel.', 'auxin-elements'),
        'id'          => 'auxin_login_logo_height',
        'section'     => 'tools-section-login',
        'dependency'  => array(),
        'transport'   => 'refresh',
        'default'     => '84',
        'type'        => 'text'
    );

    //--------------------------------

    $fields_sections_list['fields'][] = array(
        'title'         => __('Enable Background', 'auxin-elements'),
        'description'   => __('Enable it to display custom background on login page.', 'auxin-elements'),
        'id'            => 'auxin_login_bg_show',
        'section'       => 'tools-section-login',
        'type'          => 'switch',
        'transport'     => 'refresh',
        'wrapper_class' => 'collapse-head',
        'default'       => '0'
    );


    $fields_sections_list['fields'][] = array(
        'title'       => __( 'Background Color', 'auxin-elements'),
        'description' => __( 'Specifies background color of website.', 'auxin-elements'),
        'id'          => 'auxin_login_bg_color',
        'section'     => 'tools-section-login',
        'type'        => 'color',
        'dependency'  => array(
            array(
                'id' => 'auxin_login_bg_show',
                'value' => array( '1' )
            )
        ),
        'transport'   => 'refresh',
        'default'     => ''
    );

    $fields_sections_list['fields'][] = array(
        'title'       =>  __('Background Image', 'auxin-elements'),
        'description' =>  __('You can upload custom image for background of login page', 'auxin-elements'),
        'id'          => 'auxin_login_bg_image',
        'section'     => 'tools-section-login',
        'type'        => 'image',
        'dependency'  => array(
            array(
                'id' => 'auxin_login_bg_show',
                'value' => array( '1' )
            )
        ),
        'transport'   => 'refresh',
        'default'     => ''
    );

    $fields_sections_list['fields'][] = array(
        'title'       =>  __('Background Size', 'auxin-elements'),
        'description' =>  __('Specifies background size on login page.', 'auxin-elements'),
        'id'          => 'auxin_login_bg_size',
        'section'     => 'tools-section-login',
        'type'        => 'radio-image',
        'choices'     => array(
            'auto' => array(
                'label'     => __('Auto', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-bg-size-1',
            ),
            'contain' => array(
                'label'     => __('Contain', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-bg-size-2'
            ),
            'cover' => array(
                'label'     => __('Cover', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-bg-size-3'
            )
        ),
        'dependency'  => array(
            array(
                'id' => 'auxin_login_bg_show',
                'value' => array( '1' )
            )
        ),
        'transport'  => 'refresh',
        'default'    => 'auto'
    );

    $fields_sections_list['fields'][] = array(
        'title'       => __('Background Pattern', 'auxin-elements'),
        'description' => sprintf(__('You can select one of these patterns as login background image. %s Some of these can be used as a pattern over your background image.', 'auxin-elements'), '<br>'),
        'id'          => 'auxin_login_bg_pattern',
        'section'     => 'tools-section-login',
        'choices'     => auxin_get_background_patterns( array( 'none' => array( 'label' =>__('None', 'auxin-elements'), 'image' => AUX_URL . 'images/visual-select/none-pattern.svg' ) ), 'before' ),
        'type'        => 'radio-image',
        'dependency'  => array(
            array(
                'id' => 'auxin_login_bg_show',
                'value' => array( '1' )
            )
        ),
        'transport'   => 'refresh',
        'default'     => ''
    );

    $fields_sections_list['fields'][] = array(
        'title'       =>  __( 'Background Repeat', 'auxin-elements'),
        'description' =>  __( 'Specifies how background image repeats.', 'auxin-elements'),
        'id'          => 'auxin_login_bg_repeat',
        'section'     => 'tools-section-login',
        'choices'     =>  array(
            'no-repeat' => array(
                'label'     => __('No repeat', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-none',
            ),
            'repeat' => array(
                'label'     => __('Repeat horizontally and vertically', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-repeat-xy',
            ),
            'repeat-x' => array(
                'label'     => __('Repeat horizontally', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-repeat-x',
            ),
            'repeat-y' => array(
                'label'     => __('Repeat vertically', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-repeat-y',
            )
        ),
        'type'       => 'radio-image',
        'dependency'  => array(
            array(
                'id' => 'auxin_login_bg_show',
                'value' => array( '1' )
            )
        ),
        'transport'  => 'refresh',
        'default'    => 'no-repeat'
    );

    $fields_sections_list['fields'][] = array(
        'title'       => __( 'Background Position', 'auxin-elements'),
        'description' => __('Specifies background image position.', 'auxin-elements'),
        'id'          => 'auxin_login_bg_position',
        'section'     => 'tools-section-login',
        'choices'     => array(
            'left top' => array(
                'label'     => __('Left top', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-top-left'
            ),
            'center top' => array(
                'label'     => __('Center top', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-top-center'
            ),
            'right top' => array(
                'label'     => __('Right top', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-top-right'
            ),

            'left center' => array(
                'label'     => __('Left center', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-center-left'
            ),
            'center center' => array(
                'label'     => __('Center center', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-center-center'
            ),
            'right center' => array(
                'label'     => __('Right center', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-center-right'
            ),

            'left bottom' => array(
                'label'     => __('Left bottom', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-bottom-left'
            ),
            'center bottom' => array(
                'label'     => __('Center bottom', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-bottom-center'
            ),
            'right bottom' => array(
                'label'     => __('Right bottom', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-bottom-right'
            )
        ),
        'type'       => 'radio-image',
        'dependency'  => array(
            array(
                'id' => 'auxin_login_bg_show',
                'value' => array( '1' )
            )
        ),
        'transport'  => 'refresh',
        'default'    => 'left top'
    );

    $fields_sections_list['fields'][] = array(
        'title'       => __('Background Attachment', 'auxin-elements'),
        'description' => __('Specifies whether the background is fixed or scrollable as user scrolls the page.', 'auxin-elements'),
        'id'          => 'auxin_login_bg_attach',
        'section'     => 'tools-section-login',
        'type'        => 'radio-image',
        'choices'     => array(
            'scroll' => array(
                'label'     => __('Scroll', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-bg-attachment-scroll',
            ),
            'fixed' => array(
                'label'     => __('Fixed', 'auxin-elements'),
                'css_class' => 'axiAdminIcon-bg-attachment-fixed',
            )
        ),
        'dependency'  => array(
            array(
                'id' => 'auxin_login_bg_show',
                'value' => array( '1' )
            )
        ),
        'transport'  => 'refresh',
        'default'    => 'scroll'
    );

    //--------------------------------

    $fields_sections_list['fields'][] = array(
        'title'       => __('Custom CSS class name', 'auxin-elements'),
        'description' => __('In this field you can define custom CSS class name for login page.
                          This class name will be added to body classes in login page and is useful for advance custom styling purposes.', 'auxin-elements'),
        'id'         => 'auxin_login_body_class',
        'section'    => 'tools-section-login',
        'dependency' => array(),
        'transport'  => 'refresh',
        'default'    => '',
        'type'       => 'text'
    );


    return $fields_sections_list;
}

add_filter( 'auxin_defined_option_fields_sections', 'auxin_add_theme_options_in_plugin', 12, 1 );





/*-----------------------------------------------------------------------------------*/
/*  Injects JavaScript codes from theme options in head
/*-----------------------------------------------------------------------------------*/

function auxin_ele_add_js_to_head() {
    if( $inline_js = auxin_get_option( 'auxin_user_custom_js_head' ) ){
        echo '<script>'. $inline_js .'</script>';
    }
}
add_action( 'wp_head','auxin_ele_add_js_to_head' );


/*-----------------------------------------------------------------------------------*/
/*  Injects JavaScript codes from theme options in JS file
/*-----------------------------------------------------------------------------------*/

function auxin_ele_add_theme_options_to_js_file( $js ){
    $js['theme_options_custom'] = auxin_get_option( 'auxin_user_custom_js' );

    $js['theme_options_google_analytics'] = auxin_get_option( 'auxin_user_google_analytics' );
    $js['theme_options_google_marketing'] = auxin_get_option( 'auxin_user_google_marketing' );

    // Will be deprecated in version 1.4
    unset( $js['option_panel_custom'] );
    unset( $js['option_panel_google_analytics'] );
    unset( $js['option_panel_google_marketing'] );

    return $js;
}
add_filter( 'auxin_custom_js_file_content', 'auxin_ele_add_theme_options_to_js_file' );


/*-----------------------------------------------------------------------------------*/
/*  Adds the custom CSS class of the login page to body element
/*-----------------------------------------------------------------------------------*/

function auxin_login_body_class( $classes ){

    if( $custom_class = auxin_get_option('auxin_login_body_class' ) ){
        $classes['auxin_custom'] = $custom_class;
    }

    if( $custom_skin = auxin_get_option('auxin_login_skin' ) ){
        $classes['auxin_skin'] = esc_attr( 'auxin-login-skin-' . $custom_skin );
    }

    return $classes;
}
add_action( 'auxin_functions_ready', function(){
    add_filter( 'login_body_class', 'auxin_login_body_class' );
});



/*-----------------------------------------------------------------------------------*/
/*  Adds proper styles for background and logo on login page
/*-----------------------------------------------------------------------------------*/

function auxin_login_head(){

    $styles     = '';

    if( $bg_image_id = auxin_get_option( 'auxin_login_logo_image' ) ){
        $bg_image = wp_get_attachment_url( $bg_image_id );
        $styles   .= "background-image: url( $bg_image ); ";

        $bg_width  = auxin_get_option( 'auxin_login_logo_width' , '84' );
        $bg_height = auxin_get_option( 'auxin_login_logo_height', '84' );

        $bg_width  = rtrim( $bg_width , 'px' ) . 'px';
        $bg_height = rtrim( $bg_height, 'px' ) . 'px';

        $styles   .= "background-size: $bg_width $bg_height; ";
        $styles   .= "width: $bg_width; height: $bg_height; ";

        echo "<style>#login h1 a { $styles }</style>";
    }

    if( auxin_get_option( 'auxin_login_bg_show' ) ){

        // get styles for background image
        $bg_styles = auxin_generate_styles_for_backgroud_fields( 'auxin_login_bg', 'option', array(
            'color'      => 'auxin_login_bg_color',
            'image'      => 'auxin_login_bg_image',
            'repeat'     => 'auxin_login_bg_repeat',
            'size'       => 'auxin_login_bg_size',
            'position'   => 'auxin_login_bg_position',
            'attachment' => 'auxin_login_bg_attachment',
            'clip'       => 'auxin_login_bg_clip'
        ) );

        $pattern_style = auxin_generate_styles_for_backgroud_fields( 'auxin_login_bg', 'option', array(
            'pattern'    => 'auxin_login_bg_pattern'
        ) );

        echo "<style>body.login { $bg_styles } body.login:before { $pattern_style }</style>";
    }

}
add_action( 'auxin_functions_ready', function(){
    add_action( 'login_head', 'auxin_login_head' );
});


/*-----------------------------------------------------------------------------------*/
/*  Changes the login header url to home url
/*-----------------------------------------------------------------------------------*/

function auxin_login_headerurl( $login_header_url ){

    if ( ! is_multisite() ) {
        $login_header_url   = home_url();
    }
    return $login_header_url;
}
add_action( 'auxin_functions_ready', function(){
    add_filter( 'login_headerurl', 'auxin_login_headerurl' );
});

/*-----------------------------------------------------------------------------------*/
/*  Changes the login header url to home url
/*-----------------------------------------------------------------------------------*/

function auxin_login_headertitle( $login_header_title ){

    if ( ! is_multisite() ) {
        $login_header_title = get_bloginfo( 'name' );
    }
    return $login_header_title;
}
add_action( 'auxin_functions_ready', function(){
    add_filter( 'login_headertitle', 'auxin_login_headertitle' );
});

/*-----------------------------------------------------------------------------------*/
/*  Adds custom message above the login form
/*-----------------------------------------------------------------------------------*/

function auxin_login_message( $login_message ){

    if( $custom_message = auxin_get_option( 'auxin_login_message' ) ){

        $message_wrapper_start = '<div class="message">';
        $message_wrapper_end   = "</div>\n";

        $custom_message_markup = $message_wrapper_start . $custom_message . $message_wrapper_end;

        /**
         * Filter instructional messages displayed above the login form.
         *
         * @param string $custom_message Login message.
         */
        $login_message .=  apply_filters( 'auxin_login_message', $custom_message_markup, $custom_message, $message_wrapper_start, $message_wrapper_end );
    }

    return $login_message;
}
add_action( 'auxin_functions_ready', function(){
    add_filter( 'login_message', 'auxin_login_message' );
});


/*-----------------------------------------------------------------------------------*/
/*  Prints the custom js codes of a single page to the source page
/*-----------------------------------------------------------------------------------*/

function auxin_custom_js_for_pages( $js, $post ){
    // The custom JS code for specific page
    if( $post && ! is_404() && is_singular() ) {
        $js .= get_post_meta( $post->ID, 'aux_page_custom_js', true );
    }

}
add_filter( 'auxin_footer_inline_script', 'auxin_custom_js_for_pages', 15, 2 );


/*-----------------------------------------------------------------------------------*/
/*  Add preconnect for Google Fonts.
/*-----------------------------------------------------------------------------------*/

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function auxin_resource_hints( $urls, $relation_type ) {
        if ( wp_style_is( 'auxin-fonts-google', 'queue' ) && 'preconnect' === $relation_type ) {
                $urls[] = array(
                        'href' => 'https://fonts.gstatic.com',
                        'crossorigin',
                );
        }
        return $urls;
}
//add_filter( 'wp_resource_hints', 'auxin_resource_hints', 10, 2 );


/*-----------------------------------------------------------------------------------*/
/*  Setup Header
/*-----------------------------------------------------------------------------------*/

function auxin_after_setup_theme_extra(){
    // gererate shortcodes in widget text
    add_filter('widget_text', 'do_shortcode');
}
add_action( 'after_setup_theme', 'auxin_after_setup_theme_extra' );

/*-----------------------------------------------------------------------------------*/
/*  add excerpts to pages
/*-----------------------------------------------------------------------------------*/

function auxin_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'auxin_add_excerpts_to_pages' );


/*-----------------------------------------------------------------------------------*/
/*  Add some user contact fields
/*-----------------------------------------------------------------------------------*/

function auxin_user_contactmethods($user_contactmethods){
    $user_contactmethods['twitter']    = __('Twitter'    , 'auxin-elements');
    $user_contactmethods['facebook']   = __('Facebook'   , 'auxin-elements');
    $user_contactmethods['googleplus'] = __('Google Plus', 'auxin-elements');
    $user_contactmethods['flickr']     = __('Flickr'     , 'auxin-elements');
    $user_contactmethods['delicious']  = __('Delicious'  , 'auxin-elements');
    $user_contactmethods['pinterest']  = __('Pinterest'  , 'auxin-elements');
    $user_contactmethods['github']     = __('GitHub'     , 'auxin-elements');
    $user_contactmethods['skills']     = __('Skills'     , 'auxin-elements');

    return $user_contactmethods;
}
add_filter('user_contactmethods', 'auxin_user_contactmethods');


/*-----------------------------------------------------------------------------------*/
/*  Add home page menu arg to menu item list
/*-----------------------------------------------------------------------------------*/

function auxin_add_home_page_to_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'auxin_add_home_page_to_menu_args' );

/*-----------------------------------------------------------------------------------*/
/*  Print meta tags to preview post while sharing on facebook
/*-----------------------------------------------------------------------------------*/

if( ! defined('WPSEO_VERSION') && ! class_exists('All_in_One_SEO_Pack') ){

    function auxin_facebook_header_meta (){

        if( ! defined('AUXIN_VERSION') ){
            return;
        }

        // return if built-in seo is disabled or "SEO by yoast" is active
        if( ! auxin_get_option( 'enable_theme_seo', 1 ) ) return;

        global $post;
        if( ! isset( $post ) || ! is_singular() || is_search() || is_404() ) return;
        setup_postdata( $post );

        $featured_image = auxin_get_the_post_thumbnail_src( $post->ID, 90, 90, true, 90 );
        $post_excerpt   = get_the_excerpt();
        ?>
    <meta name="title"       content="<?php echo esc_attr( $post->post_title ); ?>" />
    <meta name="description" content="<?php echo esc_attr( $post_excerpt ); ?>" />
    <?php if( $featured_image) { ?>
    <link rel="image_src"    href="<?php echo $featured_image; ?>" />
    <?php }

    }

    add_action( 'wp_head', 'auxin_facebook_header_meta' );
}

/*-----------------------------------------------------------------------------------*/
/*  Add SiteOrigin class prefix and custom field classes path
/*-----------------------------------------------------------------------------------*/
if ( auxin_is_plugin_active( 'so-widgets-bundle/so-widgets-bundle.php') ) {

    function register_auxin_siteorigin_class_prefix( $class_prefixes ) {
        $class_prefixes[] = 'Auxin_SiteOrigin_Field_';
        return $class_prefixes;
    }

    add_filter( 'siteorigin_widgets_field_class_prefixes', 'register_auxin_siteorigin_class_prefix' );


    function register_custom_fields( $class_paths ) {
        $class_paths[] = AUXELS_ADMIN_DIR . '/includes/compatibility/siteorigin/fields/';
        return $class_paths;
    }

    add_filter( 'siteorigin_widgets_field_class_paths', 'register_custom_fields' );
}


/**
 * Replace WooCommerce Default Pagination with auxin pagination
 *
 */
remove_action( 'woocommerce_pagination' , 'woocommerce_pagination', 10 );
add_action   ( 'woocommerce_pagination', 'auxin_woocommerce_pagination' , 10 );

function auxin_woocommerce_pagination() {
    auxin_the_paginate_nav(
        array( 'css_class' => auxin_get_option('archive_pagination_skin') )
    );
}




function auxels_add_post_type_metafields(){

    $all_post_types = auxin_get_possible_post_types(true);

    $auxin_is_admin  = is_admin();

    foreach ( $all_post_types as $post_type => $is_post_type_allowed ) {

        if( ! $is_post_type_allowed ){
            continue;
        }

        // define metabox args
        $metabox_args = array( 'post_type' => $post_type );

        switch( $post_type ) {

            case 'page':

                $metabox_args['hub_id']        = 'axi_meta_hub_page';
                $metabox_args['hub_title']     = __('Page Options', 'auxin-elements');
                $metabox_args['to_post_types'] = array( $post_type );

                break;

            case 'post':

                $metabox_args['hub_id']        = 'axi_meta_hub_post';
                $metabox_args['hub_title']     = __('Post Options', 'auxin-elements');
                $metabox_args['to_post_types'] = array( $post_type );

            default:
                break;
        }

        // Load metabox fields on admin
        if( $auxin_is_admin ){
            auxin_maybe_render_metabox_hub_for_post_type( $metabox_args );
        }

    }

}

//add_action( 'init', 'auxels_add_post_type_metafields' );




/*-----------------------------------------------------------------------------------*/
/*  Filtering wp_title to improve seo and letting seo plugins to filter the output too
/*-----------------------------------------------------------------------------------*/

if( ! defined( 'WPSEO_VERSION') ){

    function auxin_wp_title($title, $sep, $seplocation) {
        global $page, $paged, $post;

        // Don't affect feeds
        if ( is_feed() )  return $title;

        // Add the blog name
        if ( 'right' == $seplocation )
            $title  .= get_bloginfo( 'name' );
        else
            $title   = get_bloginfo( 'name' ) . $title;

        // Add the blog description for the home/front page
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title .= " $sep $site_description";

        // Add a page number if necessary
        if ( $paged >= 2 || $page >= 2 )
            $title .= " $sep " . sprintf( __( 'Page %s', 'auxin-elements'), max( $paged, $page ) );

        return $title;
    }

    add_filter( 'wp_title', 'auxin_wp_title', 10, 3 );
}
