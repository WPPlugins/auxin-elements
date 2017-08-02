<?php
/**
 * Divider element
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */

function auxin_get_divider_master_array( $master_array ) {

    $master_array['aux_divider']  = array(
        'name'                    => __('[Phlox] Divider', 'auxin-elements' ),
        'auxin_output_callback'   => 'auxin_widget_divider_callback',
        'base'                    => 'aux_divider',
        'description'             => __('Horizontal seperator', 'auxin-elements'),
        'class'                   => 'aux-widget-divider',
        'show_settings_on_create' => true,
        'weight'                  => 1,
        'is_widget'               => true,
        'is_shortcode'            => true,
        'is_so'                   => true,
        'is_vc'                   => true,
        'category'                => THEME_NAME,
        'group'                   => '',
        'admin_enqueue_js'        => '',
        'admin_enqueue_css'       => '',
        'front_enqueue_js'        => '',
        'front_enqueue_css'       => '',
        'icon'                    => 'auxin-element auxin-divider',
        'custom_markup'           => '',
        'js_view'                 => '',
        'html_template'           => '',
        'deprecated'              => '',
        'content_element'         => '',
        'as_parent'               => '',
        'as_child'                => '',
        'params'                  => array(
            array(
                'heading'            => __('Divider style','auxin-elements'),
                'description'        => '',
                'param_name'         => 'style',
                'type'               => 'aux_visual_select',
                'def_value'          => "solid",
                'holder'             => '',
                'class'              => 'style',
                'admin_label'        => true,
                'dependency'         => '',
                'weight'             => '',
                'group'              => '' ,
                'edit_field_class'   => '',
                'choices'            => array(
                    'white-space'    => array(
                        'label'      => __('White Space', 'auxin-elements'),
                        'image'      => AUX_URL . 'images/visual-select/divider-white-space.svg'
                    ),
                    'solid'          => array(
                        'label'      => __('Solid', 'auxin-elements'),
                        'image'      => AUX_URL . 'images/visual-select/divider-solid.svg'
                    ),
                    'dashed'         => array(
                        'label'      => __('Dashed', 'auxin-elements'),
                        'image'      => AUX_URL . 'images/visual-select/divider-dashed.svg'
                    ),
                    'circle-symbol'  => array(
                        'label'      => __('Circle', 'auxin-elements'),
                        'image'      => AUX_URL . 'images/visual-select/divider-circle.svg'
                    ),
                    'diamond-symbol' => array(
                        'label'      => __('Diamond', 'auxin-elements'),
                        'image'      => AUX_URL . 'images/visual-select/divider-diamond.svg'
                    )
                )
            ),
            array(
                'heading'           => __('Divider width','auxin-elements'),
                'description'       => __('Specifies the width size of divider.', 'auxin-elements'),
                'param_name'        => 'width',
                'type'              => 'dropdown',
                'value'             => array(
                    'large'         => __('Large', 'auxin-elements'),
                    'medium'        => __('Medium', 'auxin-elements'),
                    'small'         => __('Small', 'auxin-elements')
                ),
                'def_value'         => 'medium',
                'holder'            => '',
                'class'             => 'width',
                'admin_label'       => true,
                'dependency'        => array(
                    'element'       => 'style',
                    'value'         => array('solid', 'dashed', 'circle-symbol', 'diamond-symbol')
                ),
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Margin top (px)','auxin-elements'),
                'description'       => __('Adds space above  the divider in pixels.', 'auxin-elements'),
                'param_name'        => 'margin_top',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => 'margin_top',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Margin bottom (px)','auxin-elements'),
                'description'       => __('Adds space below the devider in pixels.', 'auxin-elements'),
                'param_name'        => 'margin_bottom',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => 'margin_bottom',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Extra class name','auxin-elements'),
                'description'       => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. you can add multiple CSS class by separating them with space.', 'auxin-elements'),
                'param_name'        => 'extra_classes',
                'type'              => 'textfield',
                'value'             => '',
                'def_value'         => '',
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

add_filter( 'auxin_master_array_shortcodes', 'auxin_get_divider_master_array', 10, 1 );



// This is the widget call back in fact the front end out put of this widget comes from this function
function auxin_widget_divider_callback( $atts, $shortcode_content = null ){

    $default_atts = array(
        'title'         => '',
        'size'          => '',
        'style'         => 'solid',
        'width'         => 'medium',
        'base_class'    => '',
        'margin_bottom' => '',
        'margin_top'    => '',

        'extra_classes' => '',
        'custom_el_id'  => '',
        'base_class'    => 'aux-widget-divider'
    );

    $result = auxin_get_widget_scafold( $atts, $default_atts, $shortcode_content );
    extract( $result['parsed_atts'] );

    $class_names = "";
    $inline_styles = "";

    switch ($style) {
        case 'solid':
            $class_names = "aux-divider-center";
        break;
        case 'dashed':
            $class_names = "aux-divider-dashed";
        break;
        case 'circle-symbol':
            $class_names = "aux-divider-symbolic-circle";
        break;
        case 'diamond-symbol':
            $class_names = "aux-divider-symbolic-square";
        break;
        case 'white-space':
            $class_names = "aux-divider-space";
        break;
    }

    switch ($width) {
        case 'large':
            $class_names .= "";
        break;
        case 'medium':
            $class_names .= " aux-divider-medium";

        break;
        case 'small':
            $class_names .= " aux-divider-small";
        break;
    }


    if( ! empty( $extra_classes ) ) {
        $class_names .= " $extra_classes";
    }

    if( ! empty( $margin_top ) ) {
        $margin_top = (int)$margin_top;
        $inline_styles .= "margin-top: $margin_top" . "px;";
    }

    if( ! empty( $margin_bottom ) ) {
        $margin_bottom = (int)$margin_bottom;
        $inline_styles .= "margin-bottom:$margin_bottom" . "px;";
    }

    if( ! empty( $inline_styles ) ) {
        $inline_styles = ' style="' . $inline_styles . '" ';
    }

    return '<hr class="'. $class_names . '"' . $inline_styles . ' >';
}

