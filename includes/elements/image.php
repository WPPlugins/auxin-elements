<?php
/**
 * Image element
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */
function auxin_get_image_master_array( $master_array ) {

    $master_array['aux_image'] = array(
         'name'                    => __("[Phlox] Image", 'auxin-elements' ),
         'auxin_output_callback'   => 'auxin_widget_image_callback',
         'base'                    => 'aux_image',
         'description'             => __('Image with lightbox option', 'auxin-elements' ),
         'class'                   => 'aux-widget-image',
         'show_settings_on_create' => true,
         'weight'                  => 1,
         'is_widget'               => true,
         'is_shortcode'            => true,
         'is_so'                   => true,
         'is_vc'                   => false,
         'category'                => THEME_NAME,
         'group'                   => '',
         'admin_enqueue_js'        => '',
         'admin_enqueue_css'       => '',
         'front_enqueue_js'        => '',
         'front_enqueue_css'       => '',
         'icon'                    => 'auxin-element auxin-image',
         'custom_markup'           => '',
         'js_view'                 => '',
         'html_template'           => '',
         'deprecated'              => '',
         'content_element'         => '',
         'as_parent'               => '',
         'as_child'                => '',
         'params'                  => array(
            array(
                'heading'           => __('Title','auxin-elements' ),
                'description'       => __('Image title, leave it empty if you don`t need title.', 'auxin-elements'),
                'param_name'        => 'title',
                'type'              => 'textfield',
                'value'             => '',
                'def_value'         => '',
                'holder'            => 'textfield',
                'class'             => 'id',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Image','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'attach_id',
                'type'              => 'attach_image',
                'value'             => '',
                'def_value'         => '',
                'holder'            => 'textfield',
                'class'             => 'attach_id',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Image hover','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'attach_id_hover',
                'type'              => 'attach_image',
                'value'             => '',
                'def_value'         => '',
                'holder'            => 'textfield',
                'class'             => 'attach_id_hover',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),

            array(
                'heading'           => __('Width','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'width',
                'type'              => 'textfield',
                'value'             => '',
                'def_value'         => '',
                'holder'            => 'textfield',
                'class'             => 'width',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Height','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'height',
                'type'              => 'textfield',
                'value'             => '',
                'def_value'         => '',
                'holder'            => 'textfield',
                'class'             => 'height',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Alignment','auxin-elements' ),
                'description'       => __('Image alignment in content.', 'auxin-elements' ),
                'param_name'        => 'align',
                'type'              => 'dropdown',
                'def_value'         => 'alignnone',
                'value'             => array(
                    'alignleft'     => __('Left'  , 'auxin-elements' ),
                    'alignright'    => __('Right'  , 'auxin-elements' ),
                    'alignnone'     => __('None'  , 'auxin-elements' )
                ),
                'holder'            => 'dropdown',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Iconic button','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'icon',
                'type'              => 'dropdown',
                'def_value'         => 'plus',
                'value'             => array(
                    ''              => __('None', 'auxin-elements' ),
                    'plus'          => __('Plus', 'auxin-elements' )

                ),
                'holder'            => 'dropdown',
                'class'             => 'icon',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Open large image in lightbox','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'lightbox',
                'type'              => 'aux_switch',
                'value'             => '0',
                'holder'            => 'dropdown',
                'class'             => 'lightbox',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),

            array(
                'heading'           => __('Link URL','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'link',
                'type'              => 'textfield',
                'value'             => '',
                'def_value'         => '',
                'holder'            => 'textfield',
                'class'             => 'link',
                'admin_label'       => true,
                'dependency'        => array(
                    'element'       => 'lightbox',
                    'value'         => array('0', 'false')
                ),
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Target','auxin-elements' ),
                'description'       => __('Open in new page or this page.','auxin-elements' ),
                'param_name'        => 'target',
                'type'              => 'dropdown',
                'def_value'         => '_self',
                'value'             => array(
                    '_self'         => __('Self'  , 'auxin-elements' ) ,
                    '_blank'        => __('Blank'  , 'auxin-elements' )
                ),
                'holder'            => 'dropdown',
                'class'             => 'target',
                'admin_label'       => true,
                'dependency'        => array(
                    'element'       => 'lightbox',
                    'value'         => array('0', 'false')
                ),
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
                ),
            array(
                'heading'           => __('Extra class name','auxin-elements' ),
                'description'       => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'auxin-elements' ),
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

add_filter( 'auxin_master_array_shortcodes', 'auxin_get_image_master_array', 10, 1 );

// This is the widget call back in fact the front end out put of this widget comes from this function
function auxin_widget_image_callback( $atts, $shortcode_content = null ){

    // Defining default attributes
    $default_atts = array(
        'title'           => '', // header title

        'attach_id'       => '', // attachment id for main image
        'attach_id_hover' => '', // attachment id for hover image
        'link'            => '', // link on image
        'target'          => '_self', // link target
        'alt'             => '', // alternative text
        'width'           => '', // final width of image
        'height'          => '', // final height of image
        'align'           => 'alignnone',
        'icon'            => 'plus', // icon type. plus, zoom, none
        'lightbox'        => 'no', // open in lightbox or not

        'extra_classes'   => '', // custom css class names for this element
        'custom_el_id'    => '', // custom id attribute for this element
        'base_class'      => 'aux-widget-image'  // base class name for container
    );

    $result = auxin_get_widget_scafold( $atts, $default_atts, $shortcode_content );
    extract( $result['parsed_atts'] );

    $image_primary      = '';
    $image_primary_full = '';
    $image_secondary    = '';
    $lightbox_attrs     = '';

    global $aux_content_width;

    $width  = ! empty( $width ) && is_numeric( $width ) ? $width : $aux_content_width;
    $height = ! empty( $height) && is_numeric( $height) ? $height: $aux_content_width * 0.75;

    if( ! empty( $attach_id ) && is_numeric( $attach_id ) ) {
        $image_primary          = auxin_get_the_resized_attachment( $attach_id, $width, $height, true );
        $image_primary_full_src = auxin_get_attachment_url( $attach_id, 'full' );
        $image_primary_meta     = wp_get_attachment_metadata( $attach_id );
        $lightbox_attrs         = 'data-original-width="' . $image_primary_meta['width'] . '" data-original-height="' . $image_primary_meta['height'] . '" ' .
                                  'data-caption="' . auxin_attachment_caption( $attach_id ) . '"';
    }

    if( ! empty( $attach_id_hover ) && is_numeric( $attach_id_hover ) ) {
        $image_secondary = auxin_get_the_resized_attachment( $attach_id_hover, $width, $height, true );
    }

    $anchor_link  = auxin_is_true( $lightbox ) ? $image_primary_full_src : esc_attr( $link );
    $anchor_class = auxin_is_true( $lightbox ) ? 'aux-lightbox-btn' : '';
    $target = ($target == 'target="_self"')? : 'target="_blank"';

    // hover effect
    $hover_class = '';
    if ( !empty($anchor_link) ) {
        $hover_class = 'aux-hover-active';
    }

    // add alignment class on main element
    $result['widget_header'] = str_replace( $base_class, $base_class.' aux-'.$align, $result['widget_header'] );

    ob_start();

    // widget header ------------------------------
    echo $result['widget_header'];
    echo $result['widget_title'];

    // widget output -----------------------
?>
    <div class="aux-media-hint-frame ">
        <div class="aux-media-frame aux-media-image aux-lightbox-frame <?php echo $hover_class; ?>" >

            <?php if( !empty($anchor_link) ) { ?>
                <a class="<?php echo $anchor_class; ?>" href="<?php echo $anchor_link; ?>" <?php echo $lightbox_attrs  . ' ' . $target; ?> >
            <?php } ?>

            <?php if( 'plus' == $icon ) { ?>
                <div class='aux-hover-scale-circle-plus'>
                    <span class='aux-symbol-plus'></span>
                    <span class='aux-symbol-circle'></span>
                </div>
            <?php } ?>

            <?php if ( !empty( $image_secondary ) ) { ?>
                <div class="aux-image-holder aux-image-has-secondary">
                    <?php echo $image_primary; ?>
                    <?php echo $image_secondary; ?>
                </div>
            <?php } else { ?>
                <div class="aux-frame-mask aux-frame-darken">
                    <?php echo $image_primary; ?>
                </div>
            <?php } ?>

            <?php if( !empty($anchor_link) ) { ?>
                </a>
            <?php } ?>

        </div>
    </div>

<?php

    // widget footer ------------------------------
    echo $result['widget_footer'];

    return ob_get_clean();
}
