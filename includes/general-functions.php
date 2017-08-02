<?php
/**
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */

/**
 * Whether a plugin is active or not
 *
 * @param  string $plugin_basename  plugin directory name and mail file address
 * @return bool                     True if plugin is active and FALSE otherwise
 */
if( ! function_exists( 'auxin_is_plugin_active' ) ){
    function auxin_is_plugin_active( $plugin_basename ){
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        return is_plugin_active( $plugin_basename );
    }
}


/**
 * Retrieves the markup for footer logo element
 *
 * @param  array  $args The properties fort this element
 *
 * @return string       The markup for logo element
 */
function auxin_get_footer_logo_block( $args = array() ){

    $defaults = array(
        'css_class'      => '',
        'middle'         => true
    );

    $args = wp_parse_args( $args, $defaults );

ob_start();
?>
    <div class="aux-logo <?php echo $args['css_class']; ?>">
        <a class="aux-logo-anchor <?php echo ($args['middle'] ? 'aux-middle' : ''); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <?php echo _auxin_get_footer_logo_image(); ?>
        </a>
    </div><!-- end logo aux-fold -->

<?php
    return ob_get_clean();
}


/**
 * Retrieves the footer logo image tag
 *
 * @return string        The markup for logo image
 */
function _auxin_get_footer_logo_image(){

    return wp_get_attachment_image( auxin_get_option('site_secondary_logo_image'), 'full', false, array(
        'class'    => 'aux-logo-image aux-logo-dark',
        'itemprop' => 'logo',
        'alt'      => esc_attr( get_bloginfo( 'name', 'display' ) )
    ) );

}

//// is absolute url ///////////////////////////////////////////////////////////////////

/**
 * Whether it's absolute url or not
 *
 * @param  string $url  The URL
 * @return bool   TRUE if the URL is absolute
 */

if( ! function_exists( "auxin_is_absolute_url" ) ){

    function auxin_is_absolute_url( $url ){
        return preg_match( "~^(?:f|ht)tps?://~i", $url );
    }

}


//// create absolute url if the url is relative ////////////////////////////////////////

/**
 * Print absolute URL for media file even if the URL is relative
 *
 * @param  string $url  The link to media file
 * @return void
 */
function auxin_the_absolute_image_url( $url ){
    echo auxin_get_the_absolute_image_url( $url );
}

    /**
     * Get absolute URL for media file event if the URL is relative
     *
     * @param  string $url  The link to media file
     * @return string   The absolute URL to media file
     */
    if( ! function_exists( 'auxin_get_the_absolute_image_url' ) ){

        function auxin_get_the_absolute_image_url( $url ){
            if( ! isset( $url ) || empty( $url ) )    return '';

            if( auxin_is_absolute_url( $url ) || auxin_contains_upload_dir( $url ) ) return $url;

            $uploads = wp_get_upload_dir();
            return trailingslashit( $uploads['baseurl'] ) . $url;
        }

    }

//// get all registerd siderbar ids ///////////////////////////////////////////////////

if( ! function_exists( 'auxin_get_all_sidebar_ids' ) ){

    function auxin_get_all_sidebar_ids(){
        $sidebars = get_theme_mod( 'auxin_sidebars');
        $output   = array();

        if( isset( $auxin_sidebars ) && ! empty( $auxin_sidebars ) ){
            foreach( $sidebars as $key => $value ) {
                $output[] = THEME_ID .'-'. strtolower( str_replace(' ', '-', $value) );
            }
        }
        return $output;
    }

}

//// remove all auto generated p tags from shortcode content //////////////////////////

if( ! function_exists( "auxin_do_cleanup_shortcode" ) ){

    function auxin_do_cleanup_shortcode( $content ) {

        /* Parse nested shortcodes and add formatting. */
        $content = trim( wpautop( do_shortcode( $content ) ) );

        /* Remove any instances of '<p>' '</p>'. */
        $content = auxin_cleanup_content( $content );

        return $content;
    }

}


//// remove all p tags from string ////////////////////////////////////////////////////

if( ! function_exists( 'auxin_cleanup_content' ) ){

    function auxin_cleanup_content( $content ) {
        /* Remove any instances of '<p>' '</p>'. */
        return str_replace( array('<p>','</p>'), array('','') , $content );
    }

}

/*-----------------------------------------------------------------------------------*/
/*  A function that makes excluding featured image, post formats and post ids simpler
/*-----------------------------------------------------------------------------------*/

if( ! function_exists( 'auxin_parse_query_args' ) ){


    /**
     * A function that makes excluding featured image, post formats and post ids simpler
     *
     * @param  array $args  The list of options and query params
     * @return array        The parsed args as array
     */
    function auxin_parse_query_args( $args ){

        $defaults = array(
            'post_type'               => 'post',
            'post_status'             => 'publish',
            'posts_per_page'          => -1,
            'ignore_sticky_posts'     => 1,

            'posts__in'               => '', // display only these post IDs. array or string comma separated
            'posts__not_in'           => '', // exclude these post IDs from result. array or string comma separated

            'include_posts__in'       => '', // include these post IDs in result too. array or string comma separated
            'exclude_without_media'   => 0,  // exclude the posts without featured image
            'exclude_post_formats_in' => '', // exclude the post with these post formats
        );

        // parse and merge the passed args
        $parsed_args = wp_parse_args( $args, $defaults );


        // Exclude post formats ----------------------------------------------------

        // exclude post formats if specified
        if( ! empty( $parsed_args['exclude_post_formats_in'] ) ){

            // generate post-format terms (i.e post-format-aside)
            $post_format_terms = array();
            foreach ( $parsed_args['exclude_post_formats_in'] as $_post_format ) {
                $post_format_terms[] = 'post-format-' . $_post_format;
            }

            // exclude the redundant taxonomies (post-format)
            $parsed_args['tax_query'] = array(
                array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => $post_format_terms,
                    'operator' => 'NOT IN'
                )
            );

        }

        // Exclude posts without featured image ------------------------------------

        // whether to exclude posts without featured-image or not
        if( $parsed_args['exclude_without_media'] ){
            $parsed_args['meta_query'] = array(
                array(
                    'key'       => '_thumbnail_id',
                    'value'     => '',
                    'compare'   => '!='
                )
            );
        }


        // Include, Exclude & Replace Post IDs -------------------------------------

        // get the list of custom post ids to display
        $only_posts    = $parsed_args['posts__in'] ? wp_parse_id_list( $parsed_args['posts__in'] ) : array();

        // get the list of custom post ids to include
        $include_posts = $parsed_args['include_posts__in'] ? wp_parse_id_list( $parsed_args['include_posts__in'] ) : array();

        // get the list of custom post ids to exclude
        $exclude_posts = $parsed_args['posts__not_in'] ? wp_parse_id_list( $parsed_args['posts__not_in'] ) : array();


        // if both of post__in and post__not_in options are defined, we have to array_diff the arrays,
        // because we cannot use post__in & post__not_in at the time in WordPress

        if( $only_posts ){

            if( $exclude_posts ){
                // remove the excluded post ids from post__in list
                if( $only_posts = array_filter( array_diff( $only_posts, $exclude_posts ) ) ){
                    $parsed_args['post__in'] = $only_posts;
                }
            } else {
                $parsed_args['post__in'] = $only_posts;
            }
            $parsed_args['posts__not_in'] = '';

        // if include_posts__in was specified
        } else if( $include_posts ){

            $extra_query_args = $parsed_args;

            // query the posts other than the ones we intend to include
            $include_and_exclude_posts = array_unique( array_filter( array_merge( $include_posts, $exclude_posts ) ) );
            // remove the excluded post ids from include_posts__in list
            $the_posts_to_include      = array_diff( $include_posts, $exclude_posts );

            $extra_query_args['fields']       = 'ids'; // just get IDs, for better performance
            $extra_query_args['post__in']     = '';    // forget post__in in this pre query
            $extra_query_args['post__not_in'] = $include_and_exclude_posts; // dont select our include adn exclude posts in this query, we will prepend them later

            // get the post ids other than our include and exclude list
            $other_post_ids  = get_posts( $extra_query_args );

            // prepend the included post ids
            $merged_post_ids = array_merge( $the_posts_to_include, $other_post_ids );

            // change the main query base on previous result
            $parsed_args = array(
                'post__in'            => $merged_post_ids,
                'orderby'             => 'post__in', // query base on the order of defined post ids
                'posts_per_page'      => $parsed_args['posts_per_page'],
                'ignore_sticky_posts' => 1
            );

        // if just "post__not_in" option is specified
        } else if( $exclude_posts ) {
            $parsed_args['post__not_in'] = $exclude_posts;
        }

        // Remove extra query args -------------------------------------------------

        unset( $parsed_args['include_posts__in'] );
        unset( $parsed_args['exclude_without_media'] );
        unset( $parsed_args['exclude_post_formats_in'] );

        return $parsed_args;
    }

}



/*-----------------------------------------------------------------------------------*/
/*  Extract only raw text - remove all special charecters, html tags, js and css codes
/*-----------------------------------------------------------------------------------*/

function auxin_extract_text( $content = null ) {
    // decode encoded html tags
    $content = htmlspecialchars_decode($content);
    // remove script tag and inline js content
    $content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);
    // remove style tag and inline css content
    $content = preg_replace('#<style(.*?)>(.*?)</style>#is'  , '', $content);
    // remove iframe content
    $content = preg_replace('#<if'.'rame(.*?)>(.*?)</iframe>#is', '', $content);
    // remove extra white spaces
    $content = preg_replace('/[\s]+/', ' ', $content );
    // strip html tags and escape special charecters
    $content = esc_attr(strip_tags($content));
    // remove double space
    $content = preg_replace('/\s{3,}/',' ', $content );
    return $content;
}

/*-----------------------------------------------------------------------------------*/
/*  Tiles layout patterns
/*-----------------------------------------------------------------------------------*/

/**
 * Defines the size of post tile based on pattern and given index
 * @param  string   $pattern
 * @param  int      $index
 * @return Array    classname, image size
 */
function auxin_get_tile_pattern( $pattern = 'default', $index, $column_media_width ) {

    $div_index = $index % 12;
    $return_value = array();

    switch ( $div_index ) {

        // large squares
        case 0:
        case 7:
            $return_value = array(
                'classname'  => 'aux-tile-2-2 aux-t-tile-4-2 aux-m-tile-4-2',
                'size' => array( 'width' => 2 * $column_media_width, 'height' => 2 * $column_media_width ),
                'image_sizes' => array(
                    array( 'min' => '' , 'max' => '992px', 'width' => '100vw' ),
                    array( 'min' => '' , 'max' => '',      'width' => 2 * $column_media_width . 'px' )
                ),
                'srcset_sizes'  => array(
                    array( 'width' => 2 * $column_media_width, 'height' => 2 * $column_media_width ),
                    array( 'width' => 4 * $column_media_width, 'height' => 4 * $column_media_width ),
                    array( 'width' => 8 * $column_media_width, 'height' => 8 * $column_media_width )
                )
            );
            break;

        // full width
        case 5:
        case 11:
            $return_value = array(
                'classname'  => 'aux-tile-4-2',
                'size' => array( 'width' =>     $column_media_width, 'height' =>     $column_media_width * 0.5 ),
                'image_sizes' => array(

                ),
                'srcset_sizes'  => array(
                    array( 'width' =>     $column_media_width, 'height' =>     $column_media_width * 0.5),
                    array( 'width' => 2 * $column_media_width, 'height' => 2 * $column_media_width * 0.5),
                    array( 'width' => 4 * $column_media_width, 'height' => 4 * $column_media_width * 0.5 )
                )
            );
            break;

        // small squares
        default:
            $return_value = array(
                'classname'  => 'aux-tile-1-1 aux-t-tile-2-2 aux-m-tile-4-2',
                'size' => array( 'width' =>     $column_media_width, 'height' =>     $column_media_width ),
                'image_sizes' => array(
                    array( 'min' => '',  'max' => '767px', 'width' => '100vw' ),
                    array( 'min' => '' , 'max' => '992px', 'width' => '50vw' ),
                    array( 'min' => '' , 'max' => '',      'width' => $column_media_width . 'px' )
                ),
                'srcset_sizes'  => array(
                    array( 'width' =>     $column_media_width, 'height' =>     $column_media_width ),
                    array( 'width' => 2 * $column_media_width, 'height' => 2 * $column_media_width ),
                    array( 'width' => 4 * $column_media_width, 'height' => 4 * $column_media_width )
                )
            );

    }

    return $return_value;
}


/*-----------------------------------------------------------------------------------*/
/*  Retrieves the provider from an embed code link
/*-----------------------------------------------------------------------------------*/


function auxin_extract_embed_provider_name( $src ){
    require_once( ABSPATH . WPINC . '/class-oembed.php' );
    $oembed   = _wp_oembed_get_object();
    if( ! $provider = $oembed->get_provider( $src ) ){
        return '';
    }

    $provider_info = parse_url( $provider );
    if( $provider_info['host'] ){
        $host_parts = explode( '.', $provider_info['host'] );
        $host_parts_num = count( $host_parts );
        if( $host_parts_num > 1 ){
            return $host_parts[ $host_parts_num -2 ];
        }
    }

    return '';
}



//// Store content in file  ////////////////////////////////////////////////////////

/**
 * Creates and stores content in a file (#admin)
 *
 * @param  string $content    The content for writing in the file
 * @param  string $file_location  The address that we plan to create the file in.
 *
 * @return boolean            Returns true if the file is created and updated successfully, false on failure
 */
function auxin_put_contents( $content, $file_location = '', $chmode = 0644 ){

    if( empty( $file_location ) ){
        return false;
    }

    /**
     * Initialize the WP_Filesystem
     */
    global $wp_filesystem;
    if ( empty( $wp_filesystem ) ) {
        require_once ( ABSPATH.'/wp-admin/includes/file.php' );
        WP_Filesystem();
    }

    // Write the content, if possible
    if ( wp_mkdir_p( dirname( $file_location ) ) && ! $wp_filesystem->put_contents( $file_location, $content, $chmode ) ) {
        // If writing the content in the file was not successful
        return false;
    } else {
        return true;
    }

}


//// Stores content in custom js file   /////////////////////////////////////////////


/**
 * Stores JavaScript content in custom js file (#admin)
 *
 * @return boolean            Returns true if the file is created and updated successfully, false on failure
 */
function auxin_save_custom_js(){

    $js_string = get_theme_mod( 'custom_js_string' );

    ob_start();
    ?>
/*
===============================================================
 #CUSTOM JavaScript
- Please do not edit this file. This file is generated from admin area.
- Every changes here will be overwritten by theme
===============================================================*/
    <?php

    $js_string = ob_get_clean() . $js_string;


    if ( auxin_put_contents_dir( $js_string, 'custom.js' ) ) {
        set_theme_mod( 'custom_js_ver', rand(10, 99)/10 ); // disable inline css output
        set_theme_mod( 'use_inline_custom_js' , false ); // disable inline css output

        return true;
    } else {
        // if the directory is not writable, try inline css fallback
        set_theme_mod( 'use_inline_custom_js' , true ); // save css rules as option to print as inline css

        return false;
    }
}


/**
 * Removes an specific content from custom js file (#admin)
 *
 * @param  string $ref_name   The reference name for referring a content in $js_array array
 *
 * @return boolean            Returns true if the content was removed successfully, false on failure
 */
function auxin_remove_custom_js( $ref_name = '' ){

    // retrieve the js array list
    $js_array = get_theme_mod( 'custom_js_array', array() );

    if( isset( $js_array[ $ref_name ] ) ){
        unset( $js_array[ $ref_name ] );

        set_theme_mod( 'custom_js_array'  , $js_array  );
        // update the file content too
        auxin_add_custom_js();
    }
}


/**
 * Retrieves the list of custom scripts generated with themes options
 *
 * @param  string $exclude_ref_names   The reference names that are expected to be excluded from result
 *
 * @return boolean    The list of custom scripts generated with themes options
 */
function auxin_get_custom_js_array( $exclude_ref_names = array() ){
    // retrieve the css array list
    $js_array = get_theme_mod( 'custom_js_array', array() );

    return array_diff_key( $js_array, array_flip( (array) $exclude_ref_names ) );
}



//// Stores content in custom css file  /////////////////////////////////////////////


/**
 * Stores css content in custom css file (#admin)
 *
 * @return boolean            Returns true if the file is created and updated successfully, false on failure
 */
function auxin_save_custom_css(){

    $css_string = get_theme_mod( 'custom_css_string' );

    ob_start();
    ?>
/*
===============================================================
 #CUSTOM CSS
- Please do not edit this file. This file is generated from admin area.
- Every changes here will be overwritten by theme
===============================================================*/
    <?php

    $css_string = ob_get_clean() . $css_string;

    if ( auxin_put_contents_dir( $css_string, 'custom.css' ) ) {

        set_theme_mod( 'custom_css_ver', rand(10, 99)/10 );
        set_theme_mod( 'use_inline_custom_css' , false ); // disable inline css output

        return true;
    // if the directory is not writable, try inline css fallback
    } else {
        set_theme_mod( 'use_inline_custom_css' , true ); // save css rules as option to print as inline css
        return false;
    }
}


/**
 * Removes an specific content from custom css file (#admin)
 *
 * @param  string $ref_name   The reference name for referring a content in $css_array array
 *
 * @return boolean            Returns true if the content was removed successfully, false on failure
 */
function auxin_remove_custom_css( $ref_name = '' ){

    // retrieve the css array list
    $css_array = get_theme_mod( 'custom_css_array', array() );

    if( isset( $css_array[ $ref_name ] ) ){
        unset( $css_array[ $ref_name ] );

        set_theme_mod( 'custom_css_array', $css_array  );
        // update the file content too
        auxin_add_custom_css();
    }
}


/**
 * Retrieves the list of custom styles generated with themes options
 *
 * @param  string $exclude_ref_names   The reference names that are expected to be excluded from result
 *
 * @return boolean    The list of custom styles generated with themes options
 */
function auxin_get_custom_css_array( $exclude_ref_names = array() ){
    // retrieve the css array list
    $css_array = get_theme_mod( 'custom_css_array', array() );

    return array_diff_key( $css_array, array_flip( (array) $exclude_ref_names ) );
}


/**
 * Retrieves the custom styles generated with themes options
 *
 * @param  string $exclude_ref_names   The css reference names that are expected to be excluded from result
 *
 * @return boolean    The custom styles generated with themes options
 */
function auxin_get_custom_css_string( $exclude_ref_names = array() ){
    // retrieve the css array list
    $css_array  = auxin_get_custom_css_array( (array) $exclude_ref_names );
    $css_string = '';

    $sep_comment = apply_filters( 'auxin_custom_css_sep_comment', "/* %s \n=========================*/\n" );

    // Convert the contents in array to string
    if( is_array( $css_array ) ){
        foreach ( $css_array as $node_ref => $node_content ) {
            if( ! is_numeric( $node_ref) ){
                $css_string .= sprintf( $sep_comment, str_replace( '_', '-', $node_ref ) );
            }
            $css_string .= "$node_content\n";
        }
    }

    // Remove <style> if user used them in the style content
    return str_replace( array( "<style>", "</style>" ), array('', ''), $css_string );
}


/**
 * Extract numbers from string
 *
 * @param  string $str     The string that contains numbers
 * @param  int    $default The number which should be returned if no number found in the string
 * @return int             The extracted numbers
 */
function auxin_get_numerics( $str, $default = null ) {
    if( empty( $str ) ){
        return is_numeric( $default ) ? $default: '';
    }
    preg_match('/\d+/', $str, $matches);
    return $matches[0];
}

/*-----------------------------------------------------------------------------------*/
/*  Returns post type menu name
/*-----------------------------------------------------------------------------------*/

if( ! function_exists( 'auxin_get_post_type_name' ) ){

    // returns post type menu name
    function auxin_get_post_type_name( $post_type = '' ){
        $post_type     = empty( $post_type ) ? get_post_type() : $post_type;
        $post_type_obj = get_post_type_object( $post_type );

        return apply_filters( 'auxin_get_post_type_name', $post_type_obj->labels->menu_name, $post_type );
    }

}


/*-----------------------------------------------------------------------------------*/
/*  A function to generate header and footer for all widgets
/*-----------------------------------------------------------------------------------*/

function auxin_get_widget_scafold( $atts, $default_atts, $shortcode_content = '' ){

    $result = array(
        'parsed_atts'   => '',
        'widget_info'   => '',
        'widget_header' => '',
        'widget_title'  => '',
        'widget_footer' => ''
    );

    // ----
    if( ! isset( $default_atts['extra_classes'] ) ){
        $default_atts['extra_classes'] = '';
    }
    if( ! isset( $default_atts['custom_el_id'] ) ){
        $default_atts['custom_el_id'] = '';
    }
    if( ! isset( $default_atts['content'] ) ){
        $default_atts['content'] = '';
    }

    // Widget general info
    $before_widget = $after_widget  = '';
    $before_title  = $after_title   = '';

    // If widget info is passed, extract them in above variables
    if( isset( $atts['widget_info'] ) ){
        $result['widget_info'] = $atts['widget_info'];
        extract( $atts['widget_info'] );
    }
    // CSS class names for section -------------

    // The default CSS classes for widget container
    // Note that 'widget-container' should be in all element
    $_css_classes = array( 'widget-container' );

    // Parse shortcode attributes
    $parsed_atts = shortcode_atts( $default_atts, $atts, __FUNCTION__ );

    if( empty( $parsed_atts['content'] ) ){
        $parsed_atts['content'] = $shortcode_content;
    }

    $result['parsed_atts'] = $parsed_atts;

    // make the result params filterable prior to generating markup variables
    $result = apply_filters( 'auxin_pre_widget_scafold_params', $result, $atts, $default_atts, $shortcode_content );

    // Defining extra class names --------------

    // Add extra class names to class list here - widget-{element_name}
    $_css_classes[] = $result['parsed_atts']['base_class'];

    // Covering classes in list to class attribute for main section
    $section_class_attr = auxin_make_html_class_attribute( $_css_classes, $result['parsed_atts']['extra_classes'] );


    if( $before_widget ){
        $result['widget_header'] .= str_replace(
            array( 'class="', '<div'),
            array( 'class="'. $result['parsed_atts']['base_class'].' '.$result['parsed_atts']['extra_classes'].' widget-container ', '<section' ),
            $before_widget
        );
    } elseif ( !empty($result['parsed_atts']['custom_el_id']) ){
        $result['widget_header'] .= sprintf('<section id="%s" %s>', $result['parsed_atts']['custom_el_id'], $section_class_attr );
    } else {
        $result['widget_header'] .= sprintf('<section %s>', $section_class_attr );
    }

    if( ! empty( $result['parsed_atts']['title'] ) ){
        if( $before_title ){
            $result['widget_title'] .= $before_title . $result['parsed_atts']['title'] . $after_title;
        } elseif( ! empty( $result['parsed_atts']['title'] ) ){
            $result['widget_title'] .= '<h3 class="widget-title">'. $result['parsed_atts']['title'] .'</h3>';
        }
    }

    if( $after_widget ){
        // fix for the difference in end tag in siteorigin page builder
        $result['widget_footer'] .= str_replace( '</div', '</section', $after_widget );
    } else {
        $result['widget_footer'] .= '</section><!-- widget-container -->';
    }

    return $result;
}


/*----------------------------------------------------------------------------*/
/*  Retrieves remote data
/*----------------------------------------------------------------------------*/

/**
 * Retrieves a URL using the HTTP POST method
 *
 * @return mixed|boolean    The body content
 */
function auxin_remote_post( $url, $args ) {
    $request = wp_remote_post( $url, $args );

    if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
        return $request['body'];
    }
    return false;
}

/**
 * Retrieves a URL using the HTTP GET method
 *
 * @return mixed|boolean    The body content
 */
function auxin_remote_get( $url, $args ) {
    $request = wp_remote_get( $url, $args );

    if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
        return $request['body'];
    }
    return false;
}

/*----------------------------------------------------------------------------*/
/*  Removes a class method from a specified filter hook.
/*----------------------------------------------------------------------------*/

if( ! function_exists( 'auxin_remove_filter_from_class' ) ){

    /**
     * Removes a class method from a specified filter hook.
     *
     * @param  string  $hook_name   The filter hook to which the function to be removed is hooked
     * @param  string  $class_name  The name of class which its method should be removed.
     * @param  string  $method_name The name of the method which should be removed.
     * @param  integer $priority    Optional. The priority of the function. Default 10.
     * @return bool                 Whether the function existed before it was removed.
     */
    function auxin_remove_filter_from_class( $hook_name = '', $class_name ='', $method_name = '', $priority = 10 ) {
        global $wp_filter;

        // Take only filters on right hook name and priority
        if ( !isset($wp_filter[$hook_name][$priority]) || !is_array($wp_filter[$hook_name][$priority]) )
            return false;

        // Loop on filters registered
        foreach( (array) $wp_filter[$hook_name][$priority] as $unique_id => $filter_array ) {
            // Test if filter is an array ! (always for class/method)
            if ( isset($filter_array['function']) && is_array($filter_array['function']) ) {
                // Test if object is a class, class and method is equal to param !
                if ( is_object($filter_array['function'][0]) && get_class($filter_array['function'][0]) && get_class($filter_array['function'][0]) == $class_name && $filter_array['function'][1] == $method_name ) {
                    unset($wp_filter[$hook_name][$priority][$unique_id]);
                }
            }

        }

        return false;
    }

}


if( ! function_exists( 'auxin_remove_action_from_class' ) ){

    /**
     * Removes a class method from a specified filter hook.
     *
     * @param  string  $hook_name   The filter hook to which the function to be removed is hooked
     * @param  string  $class_name  The name of class which its method should be removed.
     * @param  string  $method_name The name of the method which should be removed.
     * @param  integer $priority    Optional. The priority of the function. Default 10.
     * @return bool                 Whether the function existed before it was removed.
     */
    function auxin_remove_action_from_class( $hook_name = '', $class_name ='', $method_name = '', $priority = 10 ) {
        global $wp_action;

        // Take only filters on right hook name and priority
        if ( !isset($wp_action[$hook_name][$priority]) || !is_array($wp_action[$hook_name][$priority]) )
            return false;

        // Loop on filters registered
        foreach( (array) $wp_action[$hook_name][$priority] as $unique_id => $filter_array ) {
            // Test if filter is an array ! (always for class/method)
            if ( isset($filter_array['function']) && is_array($filter_array['function']) ) {
                // Test if object is a class, class and method is equal to param !
                if ( is_object($filter_array['function'][0]) && get_class($filter_array['function'][0]) && get_class($filter_array['function'][0]) == $class_name && $filter_array['function'][1] == $method_name ) {
                    unset($wp_action[$hook_name][$priority][$unique_id]);
                }
            }

        }

        return false;
    }

}



/*-----------------------------------------------------------------------------------*/
/*  A function to get the custom style of Google maps
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'auxin_get_gmap_style' ) ) {

    function auxin_get_gmap_style () {

        $styler = '[{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#e9e5dc"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"poi.medical","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"poi.sports_complex","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54},{"visibility":"off"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"water","elementType":"all","stylers":[{"saturation":43},{"lightness":-11},{"color":"#89cada"}]}]';

        return apply_filters( 'auxin_gmap_style', $styler );
    }
}




/**
 * Removes all generate images from uploads directory
 *
 * @return void
 */
function auxin_remove_all_generate_images( $remove = true ){
    if( is_multisite() ){
        return;
    }
    $upload_dir = wp_get_upload_dir();

    $all_images = auxin_find_all_files( $upload_dir['basedir'] );
    $generated_images = array();

    foreach( $all_images as $key => $file ) {
        if( 1 == preg_match("#-(\d+)x(\d+).(png|jpg|bmp|gif)$#", $file) ) {
            $generated_images[] = $file;
            if( $remove ){
                unlink( $file );
            }
        }
    }
    echo count( $all_images ) . " / " . count( $generated_images );
}

/**
 * Find all files within a directory
 *
 * @param  string $dir The directory which we intend to serach in
 * @return array       List of files
 */
function auxin_find_all_files( $dir, $recursive = true ){
    $root   = scandir( $dir );
    $result = array();

    foreach( $root as $file ){
        if( $file === '.' || $file === '..') {
            continue;
        }
        if( is_file( "$dir/$file" ) ){
            $result[] = "$dir/$file";
            continue;
        } elseif( $recursive && is_dir( "$dir/$file" ) ){
            $sub_dir_files = auxin_find_all_files( "$dir/$file" );
            $result = array_merge( $result, $sub_dir_files );
        }
    }
    return $result;
}


