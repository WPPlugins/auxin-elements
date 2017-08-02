<?php
/**
 * Filterable gallery with lightbox
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */
function auxin_get_gallery_master_array( $master_array ) {

    $master_array['aux_gallery']  = array(
        'name'                    => __('[Phlox] Gallery', 'auxin-elements'),
        'auxin_output_callback'   => 'auxin_widget_gallery_callback',
        'base'                    => 'aux_gallery',
        'description'             => __('Filterable and grid gallery with lightbox', 'auxin-elements'),
        'class'                   => 'aux-widget-gallery',
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
        'icon'                    => 'auxin-element auxin-gallery',
        'custom_markup'           => '',
        'js_view'                 => '',
        'html_template'           => '',
        'deprecated'              => '',
        'content_element'         => '',
        'as_parent'               => '',
        'as_child'                => '',
        'params'                  => array(
            array(
                'heading'          => __('Title','auxin-elements'),
                'description'      => '',
                'param_name'       => 'title',
                'type'             => 'textfield',
                'value'            => '',
                'holder'           => 'textfield',
                'class'            => 'title',
                'admin_label'      => false,
                'dependency'       => '',
                'weight'           => '',
                'group'            => '' ,
                'edit_field_class' => ''
            ),
            array(
                'heading'          => __('Images','auxin-elements'),
                'description'      => '',
                'param_name'       => 'include',
                'type'             => 'attach_images',
                'value'            => '',
                'def_value'        => '',
                'holder'           => '',
                'class'            => 'include',
                'admin_label'      => false,
                'dependency'       => '',
                'weight'           => '',
                'group'            => '' ,
                'edit_field_class' => ''
            ),
            array(
                'heading'          => __('Gallery layout','auxin-elements'),
                'description'      => '',
                'param_name'       => 'layout',
                'type'             => 'aux_visual_select',
                'def_value'        => 'grid',
                'choices'            => array(
                    'grid'           => array(
                        'label'      => __('Grid', 'auxin-elements'),
                        'image'      => AUX_URL . 'images/visual-select/gallery-grid.svg'
                    ),
                    'masonry'        => array(
                        'label'      => __('Masonry', 'auxin-elements'),
                        'image'      => AUX_URL . 'images/visual-select/gallery-masonry.svg'
                    ),
                    'tiles'          => array(
                        'label'      => __('Tiles', 'auxin-elements'),
                        'image'      => AUX_URL . 'images/visual-select/gallery-tile.svg'
                    ),
                    // 'justify-rows' => array(
                    //     'label'      => __('Justify rows', 'auxin-elements'),
                    //     'image'      => AUX_URL . 'images/visual-select/divider-diamond.svg'
                    // )
                ),
                'holder'           => '',
                'class'            => 'layout',
                'admin_label'      => true,
                'dependency'       => '',
                'weight'           => '',
                'group'            => '' ,
                'edit_field_class' => ''
            ),
            array(
                'heading'          => __('Order images by query','auxin-elements'),
                'description'      => '',
                'param_name'       => 'wp_order',
                'type'             => 'aux_switch',
                'value'            => '0',
                'class'            => '',
                'admin_label'      => false,
                'dependency'       => '',
                'weight'           => '',
                'group'            => '' ,
                'edit_field_class' => ''
            ),
            array(
                'heading'          => __('Order','auxin-elements'),
                'description'      => __('Order images ascending or descending','auxin-elements'),
                'param_name'       => 'order',
                'type'             => 'dropdown',
                'def_value'        => 'ASC',
                'value'            => array(
                    'ASC'          => __('ASC' , 'auxin-elements'),
                    'DESC'         => __('DESC', 'auxin-elements')
                ),
                'holder'           => '',
                'class'            => 'order',
                'admin_label'      => false,
                'dependency'       => array(
                    'element'      => 'wp_order',
                    'value'        => '1'
                ),
                'weight'           => '',
                'group'            => '' ,
                'edit_field_class' => ''
            ),
            array(
                'heading'          => __('Order images by','auxin-elements'),
                'description'      => '',
                'param_name'       => 'orderby',
                'type'             => 'dropdown',
                'def_value'        => 'menu_order ID',
                'value'             => array(
                    'menu_order ID' => __('Menu Order' , 'auxin-elements'),
                    'date'          => __('Date'       , 'auxin-elements'),
                    'ID'            => __('ID'         , 'auxin-elements'),
                    'none'          => __('None'       , 'auxin-elements')
                ),
                'dependency'        => array(
                    'element'       => 'wp_order',
                    'value'         => '1'
                ),
                'holder'           => '',
                'class'            => 'orderby',
                'admin_label'      => false,
                'weight'           => '',
                'group'            => '' ,
                'edit_field_class' => ''
            ),
            array(
                'heading'     => __('Number of columns', 'auxin-elements'),
                'description' => '',
                'param_name'  => 'columns',
                'type'        => 'dropdown',
                'def_value'   => '4',
                'holder'      => '',
                'class'       => 'columns',
                'value'       => array(
                    '1'  => '1', '2' => '2', '3' => '3',
                    '4'  => '4', '5' => '5', '6' => '6'
                ),
                'admin_label'       => false,
                'dependency'       => array(
                    'element'       => 'layout',
                    'value'         => array( 'grid', 'masonry' )
                ),
                'weight'            => '',
                'group'             => 'Layout' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'     => __('Number of columns in tablet size', 'auxin-elements'),
                'description' => '',
                'param_name'  => 'tablet_cnum',
                'type'        => 'dropdown',
                'def_value'   => 'inherit',
                'holder'      => '',
                'class'       => 'tablet_cnum',
                'value'       => array(
                    'inherit' => 'Inherited from larger',
                    '1'  => '1', '2' => '2', '3' => '3',
                    '4'  => '4', '5' => '5', '6' => '6'
                ),
                'admin_label'       => false,
                'dependency'       => array(
                    'element'       => 'layout',
                    'value'         => array( 'grid', 'masonry' )
                ),
                'weight'            => '',
                'group'             => 'Layout' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'     => __('Number of columns in phone size', 'auxin-elements'),
                'description' => '',
                'param_name'  => 'phone_cnum',
                'type'        => 'dropdown',
                'def_value'   => '1',
                'holder'      => '',
                'class'       => 'phone_cnum',
                'value'       => array(
                    '1' => '1' , '2' => '2', '3' => '3'
                ),
                'admin_label'       => false,
                'dependency'       => array(
                    'element'       => 'layout',
                    'value'         => array( 'grid', 'masonry' )
                ),
                'weight'            => '',
                'group'             => 'Layout' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Space','auxin-elements'),
                'description'       => __('Space between gallery items in pixel.', 'auxin-elements'),
                'param_name'        => 'space',
                'type'              => 'textfield',
                'value'             => '10',
                'def_value'         => '',
                'holder'            => '',
                'class'             => 'space',
                'admin_label'       => false,
                'dependency'       => array(
                    'element'       => 'layout',
                    'value'         => array( 'grid', 'masonry' )
                ),
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Image aspect ratio', 'auxin-elements'),
                'description'       => '',
                'param_name'        => 'image_aspect_ratio',
                'type'              => 'dropdown',
                'def_value'         => '0.75',
                'holder'            => '',
                'class'             => 'order',
                'value'             =>array (
                    '0.75'          => __('Horizontal 4:3' , 'auxin-elements'),
                    '0.56'          => __('Horizontal 16:9', 'auxin-elements'),
                    '1.00'          => __('Square 1:1'     , 'auxin-elements'),
                    '1.33'          => __('Vertical 3:4'   , 'auxin-elements')
                ),
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'layout',
                    'value'         => array( 'grid' )
                ),
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'          => __('Link images to','auxin-elements'),
                'description'      => '',
                'param_name'       => 'link',
                'type'             => 'dropdown',
                'def_value'        => 'lightbox',
                'value'            => array(
                    'lightbox'     => __('Lightbox', 'auxin-elements'),
                    'none'         => __('None'    , 'auxin-elements'),
                    ''             => __('Attachment Page' , 'auxin-elements'),
                    'file'         => __('File'    , 'auxin-elements')
                ),
                'holder'           => '',
                'class'            => 'link',
                'admin_label'      => false,
                'dependency'       => '',
                'weight'           => '',
                'group'            => '' ,
                'edit_field_class' => ''
            ),
            array(
                'heading'          => __('Enable pagination','auxin-elements'),
                'description'      => '',
                'param_name'       => 'pagination',
                'type'             => 'aux_switch',
                'value'            => '0',
                'class'            => '',
                'admin_label'      => false,
                'dependency'       => '',
                'weight'           => '',
                'group'            => '' ,
                'edit_field_class' => ''
            ),
            array(
                'heading'          => __('Enable lazyload','auxin-elements'),
                'description'      => __('Only load images that are in visible page','auxin-elements'),
                'param_name'       => 'lazyload',
                'type'             => 'aux_switch',
                'value'            => '0',
                'class'            => '',
                'admin_label'      => false,
                'dependency'        => array(
                    'element'       => 'pagination',
                    'value'         => '1'
                ),
                'weight'           => '',
                'group'            => '' ,
                'edit_field_class' => ''
            ),
            array(
                'heading'           => __('Images per page','auxin-elements'),
                'description'       => '',
                'param_name'        => 'perpage',
                'type'              => 'textfield',
                'value'             => '24',
                'def_value'         => '',
                'holder'            => '',
                'class'             => 'id',
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'pagination',
                    'value'         => '1'
                ),
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

add_filter( 'auxin_master_array_shortcodes', 'auxin_get_gallery_master_array', 10, 1 );

// This is the widget call back in fact the front end out put of this widget comes from this function
function auxin_widget_gallery_callback( $attr, $shortcode_content = null ){
    if ( ! empty( $attr['ids'] ) ) {
        $attr['include'] = $attr['ids'];
    }

    static $instance = 0;
    $instance++;
    $selector = "aux-gallery-{$instance}";

    global $post;

    // Defining default attributes
    $default_atts = array(
        'order'               => 'ASC',
        'orderby'             => 'menu_order ID',
        'id'                  => $post ? $post->ID : 0,
        'columns'             => 4,
        'tablet_cnum'         => 'inherit',
        'phone_cnum'          => 1,
        'space'               => 10,
        'image_aspect_ratio'  => 0.75,
        'layout'              => 'grid', // grid, masonry, justify-rows, packery
        'include'             => '',
        'link'                => 'lightbox', // none, file, empty(attachment), lightbox
        'perpage'             => 24,
        'pagination'          => false,
        'lazyload'            => false,
        'wp_order'            => false,
        'title'         => '', // header title
        'extra_classes' => '', // custom css class names for this element
        'custom_el_id'  => '', // custom id attribute for this element
        'base_class'    => 'aux-widget-gallery'  // base class name for container
    );

    $result = auxin_get_widget_scafold( $attr, $default_atts );
    extract( $result['parsed_atts'] );

    // ------------------------------------------

    if ( !$wp_order && empty( $ids ) ) {
        $order = 'ASC';
        $orderby = 'post__in';
    }

    $attachments = array();

    if ( ! empty( $include ) ) {
        $_attachments = get_posts(
            array(
                'include'        => $include,
                'post_status'    => 'inherit',
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'order'          => $order,
                'orderby'        => $orderby
            )
        );

        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if ( empty( $attachments ) ) {
        return '';
    }

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment ) {
            $output .= wp_get_attachment_link( $att_id, 'medium', true ) . "\n";
        }
        return $output;
    }

    ob_start();

    // widget header ------------------------------
    echo $result['widget_header'];
    echo $result['widget_title'];

    $crop = false;

    if ( 'grid' == $layout ) {
        $crop = true;
    }

    if ( empty( $layout ) || 'grid' == $layout ){
        $isotop_layout = 'masonry';
    } elseif ( 'justify-rows' == $layout ) {
        $isotop_layout = 'justifyRows';
    } elseif ( 'tiles' == $layout ) {
        $isotop_layout = 'packery';
        $space = 0;
    } else {
        $isotop_layout = 'masonry';
    }

    $add_lightbox = ( $link == 'lightbox' );
    $add_caption = false;

    echo "<div id='$selector' class='aux-gallery galleryid-{$id} gallery-columns-{$columns} " . ( $add_lightbox ? 'aux-lightbox-gallery' : '' ) . "'>";

    // isotope attributes
    $isotope_attrs = ' data-pagination="' . $pagination . '"'.
                     ' data-lazyload="' . ( $lazyload ? 'true' : 'false' ) . '"'.
                     ' data-perpage="' . $perpage . '"'.
                     ' data-layout="' . $isotop_layout . '"'.
                     ' data-space="' . $space . '"';

    if ( 'tiles' == $layout ) {
        $column_class  = 'aux-tiles-layout';
        $column_media_width = auxin_get_content_column_width( 4, $space );
        $isotope_item_classes = 'aux-iso-item';
    } else {
        $column_class  = 'aux-row aux-de-col' . $columns;
        if ( 'inherit' == $tablet_cnum ) {
            $tablet_cnum = $columns;
        }

        $column_class .= ' aux-tb-col'. $tablet_cnum;
        $column_class .= ' aux-mb-col'. $phone_cnum;
        $column_media_width = auxin_get_content_column_width( $columns, $space );
        $isotope_item_classes = 'aux-iso-item aux-col';
    }

    $column_media_width = round( $column_media_width );

    echo "<div class='aux-gallery-container aux-isotope-animated $column_class aux-no-gutter aux-layout-$isotop_layout' $isotope_attrs >";


    if ( $lazyload ) {
        $isotope_item_classes .= ' aux-loading';
    }

    $index = 0;

    foreach ( $attachments as $id => $attachment ) {

        $isotope_item_attrs = '';
        $attachment_meta = wp_get_attachment_metadata( $id );

        if ( $add_lightbox || 'file' == $link ) {
            $attachment_url  = auxin_get_attachment_url( $id, 'full' );
        } elseif ( 'attachment' == $link ) {
            $attachment_url = get_attachment_link( $id );
        }

        if ( $add_lightbox ) {
            $lightbox_attrs = 'data-original-width="' . $attachment_meta['width'] . '" data-original-height="' . $attachment_meta['height'] . '" ' .
                              'data-caption="' . esc_attr( auxin_attachment_caption( $id ) ) . '"';
        }

        if ( 'tiles' == $layout ) {
            $item_pattern_info = auxin_get_tile_pattern( 'default', $index, $column_media_width );
            $attachment_media = auxin_get_the_responsive_attachment(
                $id,
                array(
                    'upscale'            => true,
                    'preloadable'        => $lazyload,
                    'crop'               => true,
                    'add_hw'             => false, // whether add width and height attr or not
                    'size'               => $item_pattern_info['size'],
                    'image_sizes'    => $item_pattern_info['image_sizes'],
                    'srcset_sizes'   => $item_pattern_info['srcset_sizes']
                )

            );

        } else {
            if ( 'masonry' == $layout ) {
                $image_aspect_ratio = 0;
            }

            $attachment_media = auxin_get_the_responsive_attachment(
                $id,
                array(
                    'upscale'            => true,
                    'preloadable'        => $lazyload,
                    'crop'               => $crop,
                    'size'               => array( 'width' => $column_media_width, 'height' => $column_media_width * $image_aspect_ratio ),
                    'add_hw'             => true, // whether add width and height attr or not
                    'image_sizes'        => array(
                        array( 'min' => '',      'max' => '767px', 'width' => round( 100 / $phone_cnum ).'vw' ),
                        array( 'min' => '768px', 'max' => '992px', 'width' => round( 100 / $tablet_cnum ).'vw' ),
                        array( 'min' => ''     , 'max' => '',      'width' => $column_media_width.'px' )
                    ),
                    'srcset_sizes'  => array(
                        array( 'width' =>     $column_media_width, 'height' =>     $column_media_width * $image_aspect_ratio ),
                        array( 'width' => 2 * $column_media_width, 'height' => 2 * $column_media_width * $image_aspect_ratio ),
                        array( 'width' => 4 * $column_media_width, 'height' => 4 * $column_media_width * $image_aspect_ratio )
                    )
                )
            );
        }

        $index ++;
        if ( $pagination && $index > $perpage ) {
            $item_classes = 'aux-iso-hidden';
        } else {
            $item_classes = '';
        }

        if ( 'tiles' == $layout ) {
            $item_classes .= ' aux-image-box '. $item_pattern_info['classname'];
        }

        include( locate_template( 'templates/theme-parts/entry/gallery-image.php' ) );
    }

    echo "</div></div>";

    // widget footer ------------------------------
    echo $result['widget_footer'];

    return ob_get_clean();
}
