<?php
/**
 * Text element
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */
function  auxin_get_text_master_array( $master_array ) {

    $master_array['aux_text'] = array(
        'name'                          => __('[Phlox] Text', 'auxin-elements'),
        'auxin_output_callback'         => 'auxin_widget_column_callback',
        'base'                          => 'aux_text',
        'description'                   => __('Simple text block.', 'auxin-elements'),
        'class'                         => 'aux-widget-text',
        'show_settings_on_create'       => true,
        'weight'                        => 1,
        'is_widget'                     => false,
        'is_shortcode'                  => true,
        'is_so'                         => true,
        'is_vc'                         => true,
        'so_api'                        => true,
        'category'                      => THEME_NAME,
        'group'                         => '',
        'admin_enqueue_js'              => '',
        'admin_enqueue_css'             => '',
        'front_enqueue_js'              => '',
        'front_enqueue_css'             => '',
        'icon'                          => 'auxin-element auxin-text',
        'custom_markup'                 => '',
        'js_view'                       => '',
        'html_template'                 => '',
        'deprecated'                    => '',
        'content_element'               => '',
        'as_parent'                     => '',
        'as_child'                      => '',
        'params' => array(
            array(
                'heading'           => __('Title','auxin-elements'),
                'description'       => __('Text title, leave it empty if you don`t need title.', 'auxin-elements'),
                'param_name'        => 'title',
                'type'              => 'textfield',
                'value'             => '',
                'def_value'         => '',
                'holder'            => 'textfield',
                'class'             => 'title',
                'description'       => '',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Title link','auxin-elements'),
                'description'       => '',
                'param_name'        => 'title_link',
                'type'              => 'textfield',
                'value'             => '',
                'def_value'         => '',
                'holder'            => 'textfield',
                'class'             => 'title_link',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Text align','auxin-elements'),
                'description'       => '',
                'param_name'        => 'text_align',
                'type'              => 'aux_visual_select',
                'def_value'         => 'top',
                'choices'           => array(
                    ''          => array(
                        'label'     => __('Theme Default', 'auxin-elements'),
                        'css_class' => 'axiAdminIcon-default',
                    ),
                    'left'      => array(
                        'label'     => __('Left', 'auxin-elements'),
                        'css_class' => 'axiAdminIcon-text-align-left',
                    ),
                    'center'    => array(
                        'label'     => __('Center', 'auxin-elements'),
                        'css_class' => 'axiAdminIcon-text-align-center'
                    ),
                    'right'     => array(
                        'label'     => __('Center', 'auxin-elements'),
                        'css_class' => 'axiAdminIcon-text-align-right'
                    )
                ),
                'holder'            => 'dropdown',
                'class'             => 'text_align',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Text color scheme','auxin-elements'),
                'description'       => '',
                'param_name'        => 'text_color_mode',
                'type'              => 'dropdown',
                'def_value'         => 'inherit',
                'value'             => array (
                    'inherit'       => __( 'Inherit'  , 'auxin-elements' ),
                    'light'         => __( 'Light'    , 'auxin-elements' ),
                    'dark'          => __( 'Dark'     , 'auxin-elements' )
                ),
                'holder'            => 'dropdown',
                'class'             => 'text_color_mode',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Wrapper style','auxin-elements'),
                'description'       => '',
                'param_name'        => 'wrapper_style',
                'type'              => 'aux_visual_select',
                'def_value'         => 'simple',
                'choices'           => array(
                    'simple'          => array(
                        'label'     => __('Simple', 'auxin-elements'),
                        'image'     => AUX_URL . 'images/visual-select/text-normal.svg'
                    ),
                    'outline'      => array(
                        'label'     => __('Outlined', 'auxin-elements'),
                        'image'     => AUX_URL . 'images/visual-select/text-outline.svg'
                    ),
                    'box'    => array(
                        'label'     => __('Boxed', 'auxin-elements'),
                        'image'     => AUX_URL . 'images/visual-select/text-boxed.svg'
                    )
                ),
                'holder'            => 'dropdown',
                'class'             => 'wrapper_style',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Block background color','auxin-elements'),
                'description'       => __('Choose a background color for this block.','auxin-elements'),
                'param_name'        => 'wrapper_bg_color',
                'type'              => 'colorpicker',
                'def_value'         => '',
                'value'             => '',
                'holder'            => '',
                'class'             => 'wrapper_bg_color',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Icon or image', 'auxin-elements' ),
                'description'       => __('Please choose an icon from avaialable icons.', 'auxin-elements'),
                'heading'           => __('Display Icon or Image','auxin-elements'),
                'description'       => '',
                'param_name'        => 'icon_or_image',
                'type'              => 'dropdown',
                'def_value'         => 'icon',
                'value'             => array (
                    'icon'          => __( 'Icon'  , 'auxin-elements' ),
                    'image'         => __( 'Image' , 'auxin-elements' ),
                ),
                'holder'            => 'dropdown',
                'class'             => 'icon_or_image',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Icon & Image',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Icon', 'auxin-elements' ),
                'description'       => __('Please choose an icon from the list.', 'auxin-elements'),
                'param_name'        => 'icon',
                'type'              => 'aux_iconpicker',
                'value'             => '',
                'def_value'         => '',
                'holder'            => 'textfield',
                'class'             => 'aux_iconpicker',
                'admin_label'       => true,
                'dependency'        => array(
                    'element'       => 'icon_or_image',
                    'value'         => array('icon')
                ),
                'weight'            => '',
                'group'             => 'Icon & Image',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Icon color','auxin-elements'),
                'description'       => __('Choose a color for icon.','auxin-elements'),
                'param_name'        => 'icon_color',
                'type'              => 'colorpicker',
                'def_value'         => '#888',
                'value'             => '#888',
                'holder'            => '',
                'class'             => 'icon_color',
                'admin_label'       => true,
                'dependency'        => array(
                    'element'       => 'icon_or_image',
                    'value'         => array('icon')
                ),
                'weight'            => '',
                'group'             => 'Icon & Image',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Icon size','auxin-elements'),
                'description'       => '',
                'param_name'        => 'icon_size',
                'type'              => 'dropdown',
                'def_value'         => 'large',
                'value'             => array (
                    'small'   => __( 'Small'   , 'auxin-elements' ),
                    'medium'  => __( 'Medium'  , 'auxin-elements' ),
                    'large'   => __( 'Large'   , 'auxin-elements' ),
                    'x-large' => __( 'X-Large' , 'auxin-elements' )
                ),
                'holder'            => 'dropdown',
                'class'             => 'icon_size',
                'admin_label'       => true,
                 'dependency'        => array(
                    'element'       => 'icon_or_image',
                    'value'         => array('icon')
                ),
                'weight'            => '',
                'group'             => 'Icon & Image',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Icon background shape','auxin-elements'),
                'description'       => '',
                'param_name'        => 'icon_shape',
                'type'              => 'aux_visual_select',
                'def_value'         => 'circle',
                'choices'           => array(
                    'circle'          => array(
                        'label'     => __('Circle', 'auxin-elements'),
                        'image'     => AUX_URL . 'images/visual-select/icon-style-circle.svg'
                    ),
                    'semi-circle'      => array(
                        'label'     => __('Semi-circle', 'auxin-elements'),
                        'image'     => AUX_URL . 'images/visual-select/icon-style-semi-circle.svg'
                    ),
                    'round-rect'    => array(
                        'label'     => __('Round Rectangle', 'auxin-elements'),
                        'image'     => AUX_URL . 'images/visual-select/icon-style-round-rectangle.svg'
                    ),
                    'cross-rect'    => array(
                        'label'     => __('Cross Rectangle', 'auxin-elements'),
                        'image'     => AUX_URL . 'images/visual-select/icon-style-cross-rectangle.svg'
                    ),
                    'rect'    => array(
                        'label'     => __('Rectangle', 'auxin-elements'),
                        'image'     => AUX_URL . 'images/visual-select/icon-style-rectangle.svg'
                    )
                ),
                'holder'            => 'dropdown',
                'class'             => 'icon_shape',
                'admin_label'       => true,
                'dependency'        => array(
                    'element'       => 'icon_or_image',
                    'value'         => array('icon')
                ),
                'weight'            => '',
                'group'             => 'Icon & Image',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Icon background color','auxin-elements'),
                'description'       => __('Choose a color for background of icon.','auxin-elements'),
                'param_name'        => 'icon_bg_color',
                'type'              => 'colorpicker',
                'def_value'         => '',
                'value'             => '',
                'holder'            => '',
                'class'             => 'icon_bg_color',
                'admin_label'       => true,
                'dependency'        => array(
                    'element'       => 'icon_or_image',
                    'value'         => array('icon')
                ),
                'weight'            => '',
                'group'             => 'Icon & Image',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __( 'Icon outline color', 'auxin-elements' ),
                'description'       => __( 'Choose a color for the border around the icon.', 'auxin-elements' ),
                'param_name'        => 'icon_border_color',
                'type'              => 'colorpicker',
                'def_value'         => '',
                'value'             => '',
                'holder'            => '',
                'class'             => 'icon_border_color',
                'admin_label'       => true,
                'dependency'        => array(
                    'element'       => 'icon_or_image',
                    'value'         => array('icon')
                ),
                'weight'            => '',
                'group'             => 'Icon & Image',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Image','auxin-elements'),
                'description'       => '',
                'param_name'        => 'image',
                'type'              => 'attach_image',
                'def_value'         => '',
                'value'             => '',
                'holder'            => '',
                'class'             => 'image',
                'admin_label'       => true,
                'dependency'        => array(
                    'element'       => 'icon_or_image',
                    'value'         => array('image')
                ),
                'weight'            => '',
                'group'             => 'Icon & Image',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Image Size','auxin-elements'),
                'description'       => '',
                'param_name'        => 'image_size',
                'type'              => 'dropdown',
                'def_value'         => 'full',
                'value'             => array (
                    'full'          => __( 'Orginal Size'  , 'auxin-elements' ),
                    'large'         => __( 'Large'         , 'auxin-elements' ),
                    'medium'        => __( 'Medium'        , 'auxin-elements' ),
                    'thumbnail'     => __( 'Thumbnail'     , 'auxin-elements' )
                ),
                'holder'            => 'dropdown',
                'class'             => 'image_size',
                'admin_label'       => true,
                'dependency'        => array(
                    'element'       => 'icon_or_image',
                    'value'         => array('image')
                ),
                'weight'            => '',
                'group'             => 'Icon & Image' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Image or icon position','auxin-elements'),
                'description'       => '',
                'param_name'        => 'image_position',
                'type'              => 'aux_visual_select',
                'def_value'         => 'top',
                'choices'           => array(
                    'top'           => array(
                        'label'     => __('Top', 'auxin-elements'),
                        'image'     => AUX_URL . 'images/visual-select/column-icon-top.svg'
                    ),
                    'left'          => array(
                        'label'     => __('Left', 'auxin-elements'),
                        'image'     => AUX_URL . 'images/visual-select/column-icon-left.svg'
                    ),
                    'right'         => array(
                        'label'     => __('Right', 'auxin-elements'),
                        'image'     => AUX_URL . 'images/visual-select/column-icon-right.svg'
                    )
                ),
                'holder'            => 'dropdown',
                'class'             => 'image_position',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Icon & Image',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Content','auxin-elements'),
                'description'       => __('Enter a text as a text content.','auxin-elements'),
                'param_name'        => 'content',
                'type'              => 'textarea_html',
                'value'             => '',
                'def_value'         => '',
                'holder'            => 'div',
                'class'             => 'content',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Extra class name','auxin-elements'),
                'description'       => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'auxin-elements'),
                'param_name'        => 'extra_classes',
                'type'              => 'textfield',
                'value'             => '',
                'def_value'         => '',
                'holder'            => 'textfield',
                'class'             => 'extra_classes',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            )
        )
    );

    return $master_array;
}

add_filter( 'auxin_master_array_shortcodes', 'auxin_get_text_master_array', 10, 1 );

// This is the widget call back in fact the front end out put of this widget comes from this function
function auxin_widget_column_callback( $atts, $shortcode_content = null ){

    // Defining default attributes
    $default_atts = array(
        'title'             => '', // section title
        'title_link'        => '', // the link on title
        'content'           => '', // the link on title
        'text_align'        => '', // left, right, center
        'text_color_mode'   => 'inherit', // inherit, dark, light

        'wrapper_style'     => '', // box, outline,
        'wrapper_bg_color'  => '', // box, outline,

        'icon'              => '', // icon on column side
        'icon_color'        => '#888',
        'icon_size'         => 'large', // small, medium, large, x-large
        'icon_shape'        => 'circle', // circle, semi-circle, round-rect, rect, hexa,
        'icon_bg_color'     => '', // empty mean inherit,
        'icon_border_color' => '', // color or 'icon' (same color as icon)

        'image'             => '', // image on column side
        'image_size'        => 'full', // image on column side
        'image_position'    => 'top', // top,left,right

        'extra_classes'     => '', // custom css class names for this element
        'custom_el_id'      => '', // custom id attribute for this element
        'base_class'        => 'aux-widget-text'  // base class name for container
    );

    if( ! empty( $atts['wrapper_style'] ) ){
        $atts['extra_classes'] .= ' aux-wrap-style-' . esc_attr( $atts['wrapper_style'] );
    } else if( ! empty( $default_atts['wrapper_style'] ) ){
        $atts['extra_classes'] .= ' aux-wrap-style-' . esc_attr( $default_atts['wrapper_style'] );
    }
    //axpp( $default_atts['extra_classes'] );
    $result                = auxin_get_widget_scafold( $atts, $default_atts );
    extract( $result['parsed_atts'] );

    $icon_border_color     = 'icon' == $icon_border_color ? $icon_color : $icon_border_color;
    $content               = empty( $content    ) ? $shortcode_content : $content;

    $main_inline_style     = empty( $wrapper_bg_color   ) ? '' : 'background-color:'.$wrapper_bg_color.' !important;';
    $main_inline_style     .= empty( $main_inline_style ) ? '' : ' style="'.$main_inline_style.'";';
    $main_classes          = 'aux-text-inner aux-ico-pos-'. ( $image_position ? esc_attr( $image_position ) : 'top' );
    $main_classes          .= empty( $text_align ) ? '' : ' aux-text-align-' . esc_attr( $text_align );
    $main_classes          .= empty( $text_color_mode ) || 'inherit' == $text_color_mode ? '' : ' aux-text-color-'. esc_attr( $text_color_mode );

    $icon_box_inline_style = empty( $icon_bg_color      )     ? '' : 'background-color:'.$icon_bg_color.' !important;';
    $icon_box_inline_style .= empty( $icon_border_color )     ? '' : 'border-color:'.$icon_border_color.';';
    $icon_box_inline_style .= empty( $icon_box_inline_style ) ? '' : ' style="'.$icon_box_inline_style.'";';
    $icon_box_classes      = 'aux-ico-' . esc_attr( $icon_size );
    $icon_box_classes      .= ' aux-ico-shape-' . esc_attr( $icon_shape );

    $icon_classes          = empty( $icon ) || $icon == 'none' ? '' : esc_attr( $icon );
    $icon_inline_style     = empty( $icon_color ) ? '' : 'style="color:'.$icon_color.' !important;"';

    $icon_border_style_tag = '';
    if( ! empty( $icon_border_color ) && 'cross-rect' == $icon_shape ){
        $icon_uid = uniqid( 'auxt' );
        $icon_box_inline_style .= ' id="'. $icon_uid .'"';
        $icon_border_style_tag = "<style>#$icon_uid:before,#$icon_uid:after{border-color:$icon_border_color;}</style>";
    }


    if( ! empty( $image ) && is_numeric( $image ) ) {
        // $image  = auxin_get_the_resized_attachment( $image );
        $image  = wp_get_attachment_image( $image, $image_size );

    }

    ob_start();

    // widget header ------------------------------
    echo $result['widget_header'];
?>
        <div class="<?php echo $main_classes; ?>" <?php echo $main_inline_style; ?>>
            <?php if( ! empty( $icon ) && empty( $image ) ) { ?>
            <div class="aux-ico-box <?php echo $icon_box_classes; ?>" <?php echo $icon_box_inline_style; ?>>
                <?php echo $icon_border_style_tag; ?>
                <span class="aux-ico <?php echo $icon_classes; ?>" <?php echo $icon_inline_style; ?> > </span>
            </div>
            <?php
                } elseif( !empty( $image ) ) { ?>
                    <div class="aux-ico-box <?php echo $icon_box_classes; ?>" <?php echo $icon_box_inline_style; ?>>
                    <?php echo $image; ?>
                    </div>
               <?php } if( ! empty( $title ) && empty( $title_link ) ) {
            ?>
            <h4 class="col-title"><?php echo $title; ?></h4>
            <?php } elseif( ! empty( $title ) && ! empty( $title_link ) ) { ?>
            <h4 class="col-title"><a href="<?php echo $title_link; ?>"><?php echo $title; ?></a></h4>
            <?php } if( ! empty( $content ) ) { ?>
            <div class="entry-content">
                <?php $encoding_flag =  defined('ENT_HTML401') ? ENT_HTML401 : ENT_QUOTES; ?>
                <p><?php echo do_shortcode( html_entity_decode( $content, $encoding_flag, 'UTF-8') ); ?></p>
            </div>
            <?php } ?>
        </div>

<?php
    // widget footer ------------------------------
    echo $result['widget_footer'];

    return ob_get_clean();
}
