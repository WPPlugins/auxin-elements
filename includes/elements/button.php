<?php
/**
 * Button element
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */

function auxin_get_button_master_array( $master_array ) {

    $master_array['aux_button'] = array(
        'name'                    => __("[Phlox] Button", 'auxin-elements'  ),
        'auxin_output_callback'   => 'auxin_widget_button_callback',
        'base'                    => 'aux_button',
        'description'             => __('It adds a button element.', 'auxin-elements' ),
        'class'                   => 'aux-widget-button',
        'show_settings_on_create' => true,
        'weight'                  => 1,
        'is_widget'               => false,
        'is_shortcode'            => true,
        'is_so'                   => true,
        'is_vc'                   => true,
        'category'                => THEME_NAME,
        'group'                   => '',
        'admin_enqueue_js'        => '',
        'admin_enqueue_css'       => '',
        'front_enqueue_js'        => '',
        'front_enqueue_css'       => '',
        'icon'                    => 'auxin-element auxin-button',
        'custom_markup'           => '',
        'js_view'                 => '',
        'html_template'           => '',
        'deprecated'              => '',
        'content_element'         => '',
        'as_parent'               => '',
        'as_child'                => '',
        'params'                  => array(
            array(
                'heading'           => __('Button label','auxin-elements' ),
                'description'       => __('The label of button.','auxin-elements' ),
                'param_name'        => 'label',
                'type'              => 'textfield',
                'value'             => 'Button',
                'holder'            => 'textfield',
                'class'             => 'label',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Button size','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'size',
                'type'              => 'dropdown',
                'def_value'         => 'medium',
                'value'             => array(
                    'exlarge' => __('Exlarge', 'auxin-elements' ),
                    'large'   => __('Large'  , 'auxin-elements' ),
                    'medium'  => __('Medium' , 'auxin-elements' ),
                    'small'   => __('Small'  , 'auxin-elements' ),
                    'tiny'    => __('Tiny'   , 'auxin-elements' )
                ),
                'holder'            => '',
                'class'             => 'round',
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'          => __('Button shape style','auxin-elements' ),
                'description'      => '',
                'param_name'       => 'border',
                'type'             => 'aux_visual_select',
                'value'            => '',
                'class'            => 'border',
                'admin_label'      => false,
                'dependency'       => '',
                'weight'           => '',
                'group'            => 'Appearance' ,
                'edit_field_class' => '',
                'choices'          => array(
                    ''          => array(
                        'label' => __('Box', 'auxin-elements' ),
                        'image' => AUX_URL . 'images/visual-select/button-normal.svg'
                    ),
                    'round'     => array(
                        'label' => __('Round', 'auxin-elements' ),
                        'image' => AUX_URL . 'images/visual-select/button-curved.svg'
                    ),
                    'curve'     => array(
                        'label' => __('Curve', 'auxin-elements' ),
                        'image' => AUX_URL . 'images/visual-select/button-rounded.svg'
                    )
                )
            ),
            array(
                'heading'          => __('Button style','auxin-elements' ),
                'description'      => '',
                'param_name'       => 'style',
                'type'             => 'aux_visual_select',
                'value'            => '',
                'class'            => 'style',
                'admin_label'      => false,
                'dependency'       => '',
                'weight'           => '',
                'group'            => 'Appearance' ,
                'edit_field_class' => '',
                'choices'          => array(
                    ''          => array(
                        'label' => __('Normal', 'auxin-elements' ),
                        'image' => AUX_URL . 'images/visual-select/button-normal.svg'
                    ),
                    '3d'        => array(
                        'label' => __('3D', 'auxin-elements' ),
                        'image' => AUX_URL . 'images/visual-select/button-3d.svg'
                    ),
                    'outline'   => array(
                        'label' => __('Outline', 'auxin-elements' ),
                        'image' => AUX_URL . 'images/visual-select/button-outline.svg'
                    )
                )
            ),
            array(
                'heading'           => __('Uppercase label','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'uppercase',
                'type'              => 'aux_switch',
                'value'             => '1',
                'class'             => 'uppercase',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Darken the label','auxin-elements' ),
                'description'       => __('Darken label of button while mouse over it.','auxin-elements' ),
                'param_name'        => 'dark',
                'type'              => 'aux_switch',
                'value'             => '0',
                'class'             => 'dark',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Icon for button','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'icon',
                'type'              => 'aux_iconpicker',
                'value'             => '',
                'class'             => 'icon-name',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Icon alignment','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'icon_align',
                'type'              => 'dropdown',
                'def_value'         => 'default',
                'value'             => array(
                   'default'        =>  __('Default'            , 'auxin-elements' ),
                   'left'           =>  __('Left'               , 'auxin-elements' ),
                   'right'          =>  __('Right'              , 'auxin-elements' ),
                   'over'           =>  __('Over'               , 'auxin-elements' ),
                   'left-animate'   =>  __('Animate from Left'  , 'auxin-elements' ),
                   'right-animate'  =>  __('Animate from Right' , 'auxin-elements' )
                ),
                'holder'            => '',
                'class'             => 'icon-align',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Color of button','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'color_name',
                'type'              => 'aux_visual_select',
                'value'             => 'carmine-pink',
                'choices'           => auxin_get_famous_colors_list(),
                'holder'            => '',
                'class'             => 'color',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Appearance' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Link','auxin-elements' ),
                'description'       => __('If you want to link your button.', 'auxin-elements' ),
                'param_name'        => 'link',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => 'link',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Open link in','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'target',
                'type'              => 'dropdown',
                'def_value'         => '_self',
                'value'             => array(
                    '_self'  => __('Current page' , 'auxin-elements' ),
                    '_blank' => __('New page', 'auxin-elements' )
                ),
                'holder'            => '',
                'class'             => 'target',
                'admin_label'       => false,
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
                'holder'            => '',
                'class'             => 'extra_classes',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            )
        )
    );

    return $master_array;
}

add_filter( 'auxin_master_array_shortcodes', 'auxin_get_button_master_array', 10, 1 );


function auxin_widget_button_callback( $atts, $shortcode_content = null ){

    // Defining default attributes
    $default_atts = array(
        'label'         => 'Button',
        'size'          => 'medium',
        'border'        => '',
        'style'         => '',
        'uppercase'     => '1',
        'dark'          => '0',
        'icon'          => '',
        'icon_align'    => 'default',
        'color_name'    => 'carmine-pink',
        'link'          => '',
        'target'        => '_self',

        'extra_classes' => '', // custom css class names for this element
        'custom_el_id'  => '',
        'base_class'    => 'aux-widget-button'
    );

    $result = auxin_get_widget_scafold( $atts, $default_atts, $shortcode_content );
    extract( $result['parsed_atts'] );




    // --------------------------------------------
    $btn_css_classes = array( 'aux-button' );
    $btn_css_classes[] = 'aux-' . $size;    // size
    $btn_css_classes[] = 'aux-' . $border;  // border form
    $btn_css_classes[] = 'aux-' . $style;   // appearance
    $btn_css_classes[] = 'aux-' . $color_name;   // appearance


    if( auxin_is_true( $uppercase ) ){
        $btn_css_classes[] = 'aux-uppercase';   // text form
    }
    if( auxin_is_true( $dark ) ){
        $btn_css_classes[] = 'aux-dark-text';   // text color
    }
    if( $icon_align !== "default" ){
        $btn_css_classes[] = 'aux-icon-' . $icon_align;   // icon align
    }

    if( ! empty( $extra_classes ) ) {
        $btn_css_classes[] =  $extra_classes;
    }

    $button_class_attr = auxin_make_html_class_attribute( $btn_css_classes );


    $label = empty( $label ) ? $shortcode_content : $label;

    $btn_content  = '<span class="aux-overlay"></span>';
    $btn_label    = '<span class="aux-text">'. auxin_do_cleanup_shortcode( $label ) .'</span>';
    $btn_icon     = $icon ? '<span class="aux-icon '. esc_attr($icon) .'"></span>' : '';

    // if icon is aligned on left
    if( false !== strpos( $icon_align, 'left') ){
        $btn_content .= $btn_icon . $btn_label;
    } else {
        $btn_content .= $btn_label. $btn_icon;
    }

    $btn_tag  = empty( $link ) ? 'button' : 'a';
    $btn_href = empty( $link ) ? '' : ' href="'. $link .'" target="'. $target .'" ';


    $output = '';

    // widget custom output -----------------------

    $output .= "<$btn_tag $btn_href $button_class_attr>";
    $output .= $btn_content;
    $output .= "</$btn_tag>";

    return $output;
}
