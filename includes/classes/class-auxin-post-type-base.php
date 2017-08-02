<?php
/**
 * Add new post type and corresponding taxonomies
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
*/

// no direct access allowed
if ( ! defined('ABSPATH') )  exit;


if( ! class_exists( 'Auxin_Post_Type_Base' ) ){


/**
 * Register custom post type and taxonomies
 *
 */
class Auxin_Post_Type_Base {

    /**
     * The custom post type name
     *
     * @var string
     */
    protected $post_type = '';

    /**
     * The instance of WP_Post_Type class
     *
     * @var WP_Post_Type
     */
    private $wp_post_type;


    function __construct( $post_type = '' ) {

        if( ! empty( $post_type ) ){
            $this->post_type = $post_type;
        }
        if( ! $this->post_type ){
            return;
        }

        // Filter the list of columns to print on the manage posts screen
        add_filter( "manage_edit-{$this->post_type}_columns", array( $this, 'manage_edit_columns' ) );

        // Filter the list of columns shown when listing posts of the post type
        add_action( "manage_{$this->post_type}_posts_custom_column",  array( $this, 'manage_posttype_custom_columns' ) );
    }


    /**
     * Retrieves/Returns the instance of WP_Post_Type class instead of current class
     *
     * @return void
     */
    public function __toString(){
        return $this->wp_post_type;
    }

    /**
     * Register post type & taxonomies instantly
     *
     * @return void
     */
    public function register() {
        // Register the post type and get corresponding WP_Post_Type instance
        $this->wp_post_type = $this->register_post_type();

        // Register the taxonomies
        $this->register_taxonomies();
    }

    /**
     * Register post type & taxonomies via init hook
     *
     * @return void
     */
    public function register_hooks() {
        // Add post types
        add_action( 'init', array( $this, 'register_post_type' ), 0 );

        // Add taxonomies
        add_action( 'init', array( $this, 'register_taxonomies' ), 0 );
    }

    /**
     * Register post type
     *
     * @return void
     */
    public function register_post_type() { }


    /**
     * Register taxonomies
     *
     * @return void
     */
    public function register_taxonomies() { }


    /**
     * Customizing post type list Columns
     *
     * @param  array $column  An array of column name => label
     * @return array          List of columns shown when listing posts of the post type
     */
    public function manage_edit_columns( $columns ){ }


    /**
     * Applied to the list of columns to print on the manage posts screen for current post type
     *
     * @param  array $column  An array of column name => label
     * @return array          List of columns shown when listing posts of the post type
     */
    function manage_posttype_custom_columns( $column ){ }


    /**
     * Remove featured image box
     *
     * @return void
     */
    public function remove_thumbnail_box(){
        remove_meta_box( 'postimagediv', $this->post_type, 'side' );
    }

}


}
