<?php
/**
 * Code highlighter element
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */

function auxin_get_recent_posts_land_master_array( $master_array ) {

    $categories = get_terms( 'category', 'orderby=count&hide_empty=0' );
    $categories_list = array( ' ' => __('All Categories', 'auxin-elements' ) )  ;
    foreach ( $categories as $key => $value ) {
        $categories_list[$value->term_id] = $value->name;
    }

    // $tags = get_terms( 'post_tag', 'orderby=count&hide_empty=0' );
    // $tags_list;
    // foreach ($tags as $key => $value) {
    //     $tags_list["$value->term_id"] = $value->name;
    // }


    $master_array['aux_recent_posts_land_style'] = array(
        'name'                          => __('[Phlox] Land Style Recent Posts', 'auxin-elements' ),
        'auxin_output_callback'         => 'auxin_widget_recent_posts_land_style_callback',
        'base'                          => 'aux_recent_posts_land_style',
        'description'                   => __('It adds recent posts in land style.', 'auxin-elements' ),
        'class'                         => 'aux-widget-recent-posts-land',
        'show_settings_on_create'       => true,
        'weight'                        => 1,
        'is_widget'                     => false,
        'is_shortcode'                  => true,
        'is_so'                         => true,
        'is_vc'                         => true,
        'category'                      => THEME_NAME,
        'group'                         => '',
        'admin_enqueue_js'              => '',
        'admin_enqueue_css'             => '',
        'front_enqueue_js'              => '',
        'front_enqueue_css'             => '',
        'icon'                          => 'auxin-element auxin-land',
        'custom_markup'                 => '',
        'js_view'                       => '',
        'html_template'                 => '',
        'deprecated'                    => '',
        'content_element'               => '',
        'as_parent'                     => '',
        'as_child'                      => '',
        'params' => array(
            array(
                'heading'          => __('Title','auxin-elements' ),
                'description'      => __('Recent post title, leave it empty if you don`t need title.', 'auxin-elements'),
                'param_name'       => 'title',
                'type'             => 'textfield',
                'std'              => '',
                'value'            => '',
                'holder'           => 'textfield',
                'class'            => 'title',
                'admin_label'      => false,
                'dependency'       => '',
                'weight'           => '',
                'group'            => '',
                'edit_field_class' => ''
            ),
            array(
                'heading'           => __('Categories', 'auxin-elements'),
                'description'       => __('Specifies a category that you want to show posts from it.', 'auxin-elements' ),
                'param_name'        => 'cat',
                'type'              => 'aux_select2_multiple',
                'def_value'         => ' ',
                'holder'            => '',
                'class'             => 'cat',
                'value'             => $categories_list,
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Number of posts to show', 'auxin-elements'),
                'description'       => '',
                'param_name'        => 'num',
                'type'              => 'textfield',
                'value'             => '8',
                'holder'            => '',
                'class'             => 'num',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
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
                'dependency'        => '',
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Exclude posts without media','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'exclude_without_media',
                'type'              => 'aux_switch',
                'value'             => '0',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Exclude custom post formats','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'exclude_custom_post_formats',
                'type'              => 'aux_switch',
                'value'             => '0',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Exclude quote and link post formats','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'exclude_quote_link',
                'type'              => 'aux_switch',
                'value'             => '0',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'exclude_custom_post_formats',
                    'value'         => array('0', 'false')
                ),
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'            => __('Order by', 'auxin-elements'),
                'description'        => '',
                'param_name'         => 'order_by',
                'type'               => 'dropdown',
                'def_value'          => 'date',
                'holder'             => '',
                'class'              => 'order_by',
                'value'              => array (
                    'date'            => __('Date', 'auxin-elements'),
                    'menu_order date' => __('Menu Order', 'auxin-elements'),
                    'title'           => __('Title', 'auxin-elements'),
                    'ID'              => __('ID', 'auxin-elements'),
                    'rand'            => __('Random', 'auxin-elements'),
                    'comment_count'   => __('Comments', 'auxin-elements'),
                    'modified'        => __('Date Modified', 'auxin-elements'),
                    'author'          => __('Author', 'auxin-elements'),
                    'post__in'        => __('Inserted Post IDs', 'auxin-elements')
                ),
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Order', 'auxin-elements'),
                'description'       => '',
                'param_name'        => 'order',
                'type'              => 'dropdown',
                'def_value'         => 'DESC',
                'holder'            => '',
                'class'             => 'order',
                'value'             =>array (
                    'DESC'          => __('Descending', 'auxin-elements'),
                    'ASC'           => __('Ascending', 'auxin-elements'),
                ),
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Only posts','auxin-elements' ),
                'description'       => __('If you intend to display ONLY specific posts, you should specify the posts here. You have to insert the post IDs that are separated by comma (eg. 53,34,87,25).', 'auxin-elements' ),
                'param_name'        => 'only_posts__in',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Include posts','auxin-elements' ),
                'description'       => __('If you intend to include additional posts, you should specify the posts here. You have to insert the Post IDs that are separated by comma (eg. 53,34,87,25)', 'auxin-elements' ),
                'param_name'        => 'include',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Exclude posts','auxin-elements' ),
                'description'       => __('If you intend to exclude specific posts from result, you should specify the posts here. You have to insert the Post IDs that are separated by comma (eg. 53,34,87,25)', 'auxin-elements' ),
                'param_name'        => 'exclude',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Start offset','auxin-elements' ),
                'description'       => __('Number of post to displace or pass over.', 'auxin-elements' ),
                'param_name'        => 'offset',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Display post media (image, video, etc)', 'auxin-elements' ),
                'param_name'        => 'show_media',
                'type'              => 'aux_switch',
                'def_value'         => '',
                'value'             => '1',
                'holder'            => '',
                'class'             => 'show_media',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Display post title','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'display_title',
                'type'              => 'aux_switch',
                'value'             => '1',
                'class'             => 'display_title',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Display post meta','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'show_info',
                'type'              => 'aux_switch',
                'value'             => '1',
                'class'             => '',
                'admin_label'       => false,
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Display like button','auxin-elements' ),
                'description'       => sprintf(__('Enable it to display %s like button%s on gride template blog. Please note WP Ulike plugin needs to be activaited to use this option.', 'auxin-elements'), '<strong>', '</strong>'),
                'param_name'        => 'display_like',
                'type'              => 'aux_switch',
                'value'             => '1',
                'holder'            => '',
                'class'             => 'display_like',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Excerpt length','auxin-elements' ),
                'description'       => __('Specify summary content in character.','auxin-elements' ),
                'param_name'        => 'excerpt_len',
                'type'              => 'textfield',
                'value'             => '160',
                'holder'            => '',
                'class'             => 'excerpt_len',
                'admin_label'       => false,
                // @TODO: bcz of this dependency its value does not save on VC
                'dependency'        => array(
                    'element'       => 'show_excerpt',
                    'value'         => '1'
                ),
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Display author or read more', 'auxin-elements'),
                'description'       => __('Specifies whether to show author or read more on each post.', 'auxin-elements'),
                'param_name'        => 'author_or_readmore',
                'type'              => 'dropdown',
                'def_value'         => 'readmore',
                'holder'            => '',
                'class'             => 'author_or_readmore',
                'value'             =>array (
                    'readmore'      => __('Read More', 'auxin-elements'),
                    'author'        => __('Author Name', 'auxin-elements'),
                ),
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Extra class name','auxin-elements' ),
                'description'       => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'auxin-elements' ),
                'param_name'        => 'extra_classes',
                'type'              => 'textfield',
                'value'             => '',
                'def_value'         => '',
                'holder'            => '',
                'class'             => 'extra_classes',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            )
        )
    );

    return $master_array;
}

add_filter( 'auxin_master_array_shortcodes', 'auxin_get_recent_posts_land_master_array', 10, 1 );




/**
 * Element without loop and column
 * The front-end output of this element is returned by the following function
 *
 * @param  array  $atts              The array containing the parsed values from shortcode, it should be same as defined params above.
 * @param  string $shortcode_content The shorcode content
 * @return string                    The output of element markup
 */
function auxin_widget_recent_posts_land_style_callback( $atts, $shortcode_content = null ){

    global $aux_content_width;

    // Defining default attributes
    $default_atts = array(
        'title'                       => '', // header title
        'cat'                         => ' ',
        'num'                         => '8',
        'only_posts__in'              => '', // display only these post IDs. array or string comma separated
        'include'                     => '',  // include these post IDs in result too. array or string comma separated
        'exclude'                     => '',  // exclude these post IDs from result. array or string comma separated
        'posts_per_page'              => -1,
        'paged'                       => '',
        'offset'                      => '',
        'order_by'                    => 'date',
        'order'                       => 'DESC',
        'exclude_without_media'       => 0,
        'exclude_custom_post_formats' => 0,
        'exclude_quote_link'          => 0,
        'exclude_post_formats_in'     => array(), // the list od post formats to exclude
        'show_media'                  => true,
        'show_excerpt'                => true,
        'excerpt_len'                 => '160',
        'display_title'               => true,
        'display_like'                => true,
        'display_categories'          => true,
        'show_info'                   => true,
        'author_or_readmore'          => 'readmore',
        'image_aspect_ratio'          => 0.75,
        'tag'                         => '',
        'extra_classes'               => '',
        'custom_el_id'                => '',
        'reset_query'                 => true,
        'use_wp_query'                => false, // true to use the global wp_query, false to use internal custom query
        'wp_query_args'               => array(), // additional wp_query args
        'base_class'                  => 'aux-widget-recent-posts-land'
    );


    $result = auxin_get_widget_scafold( $atts, $default_atts, $shortcode_content );
    extract( $result['parsed_atts'] );


    // get content width
    global $aux_content_width;

    // post-olumn needs to have below variables
    if( $author_or_readmore == 'readmore') {
        $show_readmore      = true;
        $show_author_footer = false;
    } else {
        $show_author_footer = true;
        $show_readmore      = false;
    }

    // specify the post formats that should be excluded -------
    $exclude_post_formats_in = (array) $exclude_post_formats_in;

    if( $exclude_custom_post_formats ){
        $exclude_post_formats_in = array_merge( $exclude_post_formats_in, array( 'aside', 'gallery', 'image', 'link', 'quote', 'video', 'audio' ) );
    }
    if( $exclude_quote_link ){
        $exclude_post_formats_in[] = 'quote';
        $exclude_post_formats_in[] = 'link';
    }
    $exclude_post_formats_in = array_unique( $exclude_post_formats_in );

    // --------------


    ob_start();

    global $wp_query;

    if( ! $use_wp_query ){

        // create wp_query to get latest items -----------
        $args = array(
            'post_type'               => 'post',
            'orderby'                 => $order_by,
            'order'                   => $order,
            'offset'                  => $offset,
            'paged'                   => $paged,
            'cat'                     => $cat,
            'post_status'             => 'publish',
            'posts_per_page'          => $num,
            'ignore_sticky_posts'     => 1,
            'include_posts__in'       => $include, // include posts in this liat
            'posts__not_in'           => $exclude, // exclude posts in this list
            'posts__in'               => $only_posts__in, // only posts in this list

            'exclude_without_media'   => $exclude_without_media,
            'exclude_post_formats_in' => $exclude_post_formats_in
        );

        // ---------------------------------------------------------------------

        // add the additional query args if available
        if( $wp_query_args ){
            $args = wp_parse_args( $args, $wp_query_args );
        }

        // pass the args through the auxin query parser
        $wp_query = new WP_Query( auxin_parse_query_args( $args ) );
    }

    // widget header ------------------------------
    echo $result['widget_header'];
    echo $result['widget_title'];


    $phone_break_point  = 767;
    $tablet_break_point = 992;

    $show_comments      = true; // shows comments icon
    $post_counter       = 0;
    $wrapper_class      = 'aux-blog-land-style';
    $item_class         = 'aux-block';
    $post_classes       = 'aux-column-post-entry land-post-style';

    $column_media_width = auxin_get_content_column_width( 2, 15 );

    // whether any result was found or not
    $have_posts = $wp_query->have_posts();

    if( $wp_query->have_posts() ){
        echo sprintf( '<div class="%s">', $wrapper_class );

        while ( $wp_query->have_posts() ) {

            $wp_query->the_post();
            $post      = $wp_query->post;
            $post_vars = auxin_get_post_format_media(
                $post,
                array(
                    'request_from'  => 'archive',
                    'media_width'   => $phone_break_point,
                    'upscale_image' => true,
                    'srcset_sizes'  => array(
                        array( 'width' =>     $column_media_width, 'height' =>     $column_media_width * $image_aspect_ratio ),
                        array( 'width' => 2 * $column_media_width, 'height' => 2 * $column_media_width * $image_aspect_ratio ),
                        array( 'width' => 4 * $column_media_width, 'height' => 4 * $column_media_width * $image_aspect_ratio )
                    )
                )
            );

            extract( $post_vars );

            $the_format = get_post_format( $post );
            include( locate_template( 'templates/theme-parts/entry/post-column.php' ) );
        }

        echo '</div>';
    }

    if( $reset_query ){
        wp_reset_query();
    }

    // return false if no result found
    if( ! $have_posts ){
        ob_get_clean();
        return false;
    }

    // widget footer ------------------------------
    echo $result['widget_footer'];

    return ob_get_clean();
}
