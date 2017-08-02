<?php
/**
 * Class to add permalink setting for post types of theme
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
*/

// no direct access allowed
if ( ! defined('ABSPATH') ) {
    die();
}

 /**
  *
  */
 class Auxin_Permalink {

     public $prefix             = "auxin";
     public $theme_name         = "averta";
     public $option_group       = "permalink";
     public $default_post_types = array();


     function __construct() {
        if( defined('THEME_ID'  ) ) $this->prefix     = THEME_ID;
        if( defined('THEME_NAME') ) $this->theme_name = THEME_NAME;

        $this->default_post_types = auxin_registered_post_types(true );
     }



     public function setup(){
         // setup hooks
         add_action( 'admin_init', array( $this, 'extend_permalinks_page'   ) );
         add_action( 'admin_init', array( $this, 'flush_rewrite_rules_queue') );
         add_action( 'load-options-permalink.php' , array( $this, 'on_permalink_page' ) );
     }




     public function on_permalink_page(){

        if( ! $this->default_post_types ){
            return;
        }

        $this->add_section();

        foreach ( $this->default_post_types as $post_type ) {
            $this->add_update_hooks( $post_type );
            $this->add_posttype_fields( $post_type );
        }

        // store posted custom permalink slugs
        foreach ( $this->default_post_types as $post_type ) {

            if( isset( $_POST['submit'] ) && isset( $_POST['_wp_http_referer'] ) ){

                if( strpos( $_POST['_wp_http_referer'],'options-permalink.php' ) !== FALSE ) {

                    $single_option_name  = $this->prefix.'_'.$post_type.'_structure';

                    // get post type structure
                    $structure = trim( esc_attr( $_POST[ $single_option_name ] ) );

                    // default permalink structure
                    if( ! $structure ) $structure = $post_type;

                    $structure = trim( $structure, '/' );

                    set_theme_mod( $single_option_name, $structure );

                    // get post type object if available
                    $post_type_object = get_post_type_object( $post_type );

                    // if post type has archive enabled
                    if( ! empty( $post_type_object ) && $post_type_object->has_archive ){

                        $archive_option_name = $this->prefix.'_'.$post_type.'_archive_structure';

                        // get post type structure
                        $structure = trim( esc_attr( $_POST[$archive_option_name] ) );

                        // default permalink structure
                        if( ! $structure ) $structure = $post_type."/all";

                        $structure = trim( $structure, '/' );

                        set_theme_mod( $archive_option_name, $structure );
                    }
                }
            }

        }
    }




    public function pending_rewrite_rules(){
        set_theme_mod( $this->prefix."_pending_rewrite_rules", 1 );
    }




    public function flush_rewrite_rules_queue () {

        if( get_theme_mod( $this->prefix."_pending_rewrite_rules", 1 ) ){
            flush_rewrite_rules();
            set_theme_mod( $this->prefix."_pending_rewrite_rules", 0 );
        }
    }




    public function extend_permalinks_page(){
        // Get enabled post types of theme
        $this->set_current_post_types();
        // This method fires for just one time
        $this->set_default_permalink_slugs();
    }



    private function set_current_post_types(){
        $auxin_active_post_types = auxin_get_possible_post_types(true);
        $this->default_post_types = array_keys( $auxin_active_post_types );
    }



    private function add_section(){

        add_settings_section(
            'auxin_posttypes_permalink_setting_section',
            sprintf( '<hr /><br />'.__( '%s Permalink Setting', 'auxin-elements' ), $this->theme_name ),
            array( $this, 'posttypes_permalink_section_callback_function' ),
            $this->option_group
        );
    }




    private function set_default_permalink_slugs(){

        if( get_theme_mod( $this->prefix.'_permalink_options_initialized', 0 ) )
            return;


        foreach ( $this->default_post_types as $post_type ) {

            $single_option_name  = $this->prefix.'_'.$post_type.'_structure';

            // get post type structure
            $structure = get_theme_mod( $single_option_name, '' );

            // default permalink structure
            if( ! $structure ) {
                $structure = ( strpos( $post_type, 'axi_' ) !== FALSE ) ? trim( $post_type, 'axi_' ) : $post_type;
            }

            $structure = trim( $structure, '/' );
            set_theme_mod( $single_option_name, $structure );

            // get post type object if available
            $post_type_object = get_post_type_object( $post_type );

            // if post type has archive enabled
            if( ! empty( $post_type_object ) && $post_type_object->has_archive ){

                $archive_option_name = $this->prefix.'_'.$post_type.'_archive_structure';

                // get post type structure
                $structure = get_theme_mod( $archive_option_name, '' );

                // default permalink structure
                if( ! $structure ) {
                    $structure  = ( strpos( $post_type, 'axi_' ) !== FALSE ) ? trim( $post_type, 'axi_' ) : $post_type;
                    $structure .= '/all';
                }

                $structure = trim( $structure, '/' );
                set_theme_mod( $archive_option_name, $structure );
            }
        }

        set_theme_mod( $this->prefix.'_permalink_options_initialized', 1 );
    }



    public function add_update_hooks( $post_type ){
        add_action( 'update_option_'.$this->prefix.'_'.$post_type.'_structure' , array( $this, 'pending_rewrite_rules' ), 10, 2 );

        if( $this->post_type_has_archive( $post_type ) ){
            add_action( 'update_option_'.$this->prefix.'_'.$post_type.'_archive_structure' , array( $this, 'pending_rewrite_rules' ), 10, 2 );
        }
    }




    private function add_posttype_fields( $post_type ){

        add_settings_field( 'auxin_'.$post_type.'_structure',
            sprintf(__('Setting for <strong>%s single</strong> page', 'auxin-elements' ), $post_type ),
            array( $this, 'posttypes_permalink_fields_callback_function' ),
            $this->option_group,
            'auxin_posttypes_permalink_setting_section',
            array( 'post_type' => $post_type, 'is_archive' => 'no' )
        );

        register_setting( $this->option_group,'auxin_'.$post_type.'_structure' );

        if( $this->post_type_has_archive( $post_type ) ){

            add_settings_field( 'auxin_'.$post_type.'_archive_structure',
                sprintf(__('Setting for <strong>%s archive</strong> page ', 'auxin-elements' ), $post_type),
                array($this, 'posttypes_permalink_fields_callback_function'),
                $this->option_group,
                'auxin_posttypes_permalink_setting_section',
                array('post_type' => $post_type, 'is_archive' => 'yes')
            );

            register_setting( $this->option_group,'auxin_'.$post_type.'_archive_structure' );
        }
    }



    public function posttypes_permalink_section_callback_function(){
        _e('These settings control the permalinks used for theme\'s post types. These settings only apply when <strong>not using "default" permalink structure.</strong>.', 'auxin-elements' );
        echo "<br /><br />";
    }




    public function posttypes_permalink_fields_callback_function( $options ) {

        $post_type_obj = get_post_type_object( $options['post_type'] );

        $suffix        = $options['is_archive'] == 'yes' ? '_archive_structure' : '_structure';
        $output_suffix = $options['is_archive'] == 'yes' ? '' : '<code>/' . __( 'sample-post', 'auxin-elements' ).'/</code>';

        $option_id     = $this->prefix.'_'.$options['post_type'].$suffix;
        $val = get_theme_mod( $option_id );

        printf( '<code>%1$s/</code><input id="%2$s" name="%2$s" type="text" value="%3$s" />%4$s', home_url(), $option_id, $val, $output_suffix );
    }


    private function post_type_has_archive( $post_type ){
        $post_type_object = get_post_type_object( $post_type );
        return ! empty( $post_type_object ) && $post_type_object->has_archive;
    }

}
