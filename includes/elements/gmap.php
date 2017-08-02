<?php
/**
 * Google Map element
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */
function auxin_get_gmap_master_array( $master_array ) {

    $master_array['aux_gmaps'] = array(
        'name'                    => __('[Phlox] Map ', 'auxin-elements' ),
        'auxin_output_callback'   => 'auxin_widget_gmaps_callback',
        'base'                    => 'aux_gmaps',
        'description'             => __('Google map block', 'auxin-elements' ),
        'class'                   => 'aux-widget-gmaps',
        'show_settings_on_create' => true,
        'weight'                  => 1,
        'category'                => THEME_NAME,
        'group'                   => '',
        'admin_enqueue_js'        => '',
        'admin_enqueue_css'       => '',
        'front_enqueue_js'        => '',
        'front_enqueue_css'       => '',
        'icon'                    => 'auxin-element auxin-google-maps',
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
                'description'       => __('Map title, leave it empty if you don`t need title.', 'auxin-elements'),
                'param_name'        => 'title',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => 'textfield',
                'class'             => 'title',
                'admin_label'       => false,
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
                'value'             => '700',
                'holder'            => '',
                'class'             => 'height',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Latitude','auxin-elements' ),
                'description'       => __('Latitude location over the map.','auxin-elements' ),
                'param_name'        => 'latitude',
                'type'              => 'textfield',
                'value'             => '52',
                'holder'            => '',
                'class'             => 'latitude',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Longitude','auxin-elements' ),
                'description'       => __('Longitude location over the map.','auxin-elements' ),
                'param_name'        => 'longitude',
                'type'              => 'textfield',
                'value'             => '14',
                'holder'            => '',
                'class'             => 'longitude',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Map type','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'type',
                'type'              => 'dropdown',
                'def_value'         => 'ROADMAP',
                'value'             => array( 'ROADMAP' => __('ROADMAP', 'auxin-elements' ), 'SATELLITE' => __('SATELLITE', 'auxin-elements' ) ),
                'holder'            => '',
                'class'             => 'type',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
             array(
                'heading'           => __('Map style','auxin-elements' ),
                'description'       => __('This feild allow you to customize the presentation of the standard Google base maps. You can find many preset styles in ', 'auxin-elements' ) .
                                            '<a href="https://snazzymaps.com/" target="_blank">' . __('this website.', 'auxin-elements' ) . '</a>' ,
                'param_name'        => 'style',
                'type'              => 'textarea_raw_html',
                'def_value'         => '',
                'value'             => '',
                'holder'            => '',
                'class'             => 'style',
                'admin_label'       => false,
                'dependency'        => array(
                        'element'   => 'type',
                        'value'     => 'ROADMAP'
                )
            ),
            array(
                'heading'           => __('Marker info','auxin-elements' ),
                'description'       => __('Marker popup text, leave it empty if you don\'t need it.', 'auxin-elements' ),
                'param_name'        => 'marker_info',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => 'marker_info',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Navigation control','auxin-elements' ),
                'description'       => __('Show navigation control on map.','auxin-elements' ),
                'param_name'        => 'show_mapcontrols',
                'type'              => 'aux_switch',
                'def_value'         => '',
                'value'             => '1',
                'holder'            => '',
                'class'             => 'show_mapcontrols',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Zoom','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'zoom',
                'type'              => 'textfield',
                'value'             => '4',
                'holder'            => '',
                'class'             => 'zoom',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Zoom with mouse wheel','auxin-elements' ),
                'description'       => '',
                'param_name'        => 'zoom_wheel',
                'type'              => 'aux_switch',
                'value'             => '0',
                'holder'            => '',
                'class'             => 'zoom_wheel',
                'admin_label'       => false,
                'dependency'        => '',
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

add_filter( 'auxin_master_array_shortcodes', 'auxin_get_gmap_master_array', 10, 1 );


/**
 * The front-end output of this element is returned by the following function
 *
 * @param  array  $atts              The array containing the parsed values from shortcode, it should be same as defined params above.
 * @param  string $shortcode_content The shorcode content
 * @return string                    The output of element markup
 */
function auxin_widget_gmaps_callback( $atts, $shortcode_content = null ){


    // Defining default attributes
    $default_atts = array(
        'title'            => '', // header title
        'type'             => 'ROADMAP',
        'style'            => '',
        'height'           => 700,
        'latitude'         => 40.7,
        'longitude'        => -74,
        'marker_info'      => '', // popup conetent
        'show_mapcontrols' => 1,
        'zoom'             => 10,
        'zoom_wheel'       => 0,

        'extra_classes'    => '', // custom css class names for this element
        'custom_el_id'     => '', // custom id attribute for this element
        'base_class'       => 'aux-widget-gmaps'  // base class name for container
    );

    $result = auxin_get_widget_scafold( $atts, $default_atts, $shortcode_content );
    extract( $result['parsed_atts'] );

    // widget header ------------------------------
    echo $result['widget_header'];
    echo $result['widget_title'];

    $mapid = uniqid("axi_map");

    if ( empty( $style ) ) {
        $style = auxin_get_gmap_style();
    } elseif ( base64_decode( $style, true ) === false) {
    }  else {
        $style = rawurldecode( base64_decode( strip_tags( $style ) ) );
    }

    ob_start();
?>


    <div class="aux-col-wrapper aux-no-gutter">
        <div id="<?php echo $mapid; ?>" class="aux_map_wrapper <?php echo $extra_classes; ?>" style="height:<?php echo $height; ?>px" ></div>

        <script>
        (function($, window, document, undefined){
            "use strict";

            $(function(){
                if(typeof GMaps != "function" || typeof google === "undefined"){
                    console.info( "Please add google map API key in theme options. https://developers.google.com/maps/documentation/javascript/" );
                    return;
                }
                var map = new GMaps({
                    el: "#<?php echo $mapid; ?>",
                    lat: <?php echo $latitude; ?>,
                    lng: <?php echo $longitude; ?>,
                    zoom: <?php echo $zoom; ?>,
                    scrollwheel: <?php echo $zoom_wheel; ?>,
                    <?php if($type == "SATELLITE"){ ?>
                          mapTypeId: google.maps.MapTypeId.SATELLITE,
                        <?php } else { ?> mapTypeId: google.maps.MapTypeId.ROADMAP,
                            <?php }
                    if ( $show_mapcontrols == false ) { ?>
                        disableDefaultUI: true,
                    <?php }?>
                    panControl : true
                });

                <?php if($type == "ROADMAP"){ ?>
                    map.addStyle({
                    styledMapName:"Auxin custom style map",
                    styles: <?php echo $style; ?>,
                    mapTypeId: "aux_map_style"
                });

                map.setStyle("aux_map_style");
                <?php } ?>
                map.addMarker({
                    <?php if ( !empty( $marker_info ) ) { ?>
                        infoWindow: { content: "<?php echo $marker_info; ?>" },
                    <?php }?>
                    lat: <?php echo $latitude; ?>,
                    lng: <?php echo $longitude; ?>
                });
            });

        })(jQuery, window, document);

       </script>

    </div><!-- aux-col-wrapper -->

<?php
    echo $result['widget_footer'];
    return ob_get_clean();
}
