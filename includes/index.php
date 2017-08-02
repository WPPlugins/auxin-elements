<?php


// commeon functions
include_once( 'general-functions.php' );
include_once( 'general-hooks.php' );

// load shortcode files
include_once( 'general-shortcodes.php' );


Auxin_Widget_Shortcode_Map::get_instance();
Auxin_Import::get_instance();

// load elements
include_once( 'elements/about-widget.php' );
include_once( 'elements/recent-posts-widget.php' );
include_once( 'elements/popular-posts-widget.php' );
include_once( 'elements/recent-posts-grid-carousel.php' );
include_once( 'elements/recent-posts-timeline.php' );
include_once( 'elements/recent-posts-masonry.php' );
include_once( 'elements/recent-posts-land-style.php' );
// if siteorigin bundle plugin is active
if( auxin_is_plugin_active( 'so-widgets-bundle/so-widgets-bundle.php' ) ) {
	include_once( 'elements/accordion.php' );
	include_once( 'elements/tabs.php' );
}
// if visual composer plugin is active
if( defined( 'WPB_VC_VERSION' ) || auxin_is_plugin_active( 'js_composer/js_composer.php' ) ){

}

include_once( 'elements/text.php' );
include_once( 'elements/recent-posts-tiles.php' );
include_once( 'elements/attachment-url.php' );
include_once( 'elements/audio.php' );
include_once( 'elements/button.php' );
include_once( 'elements/code.php' );
include_once( 'elements/contact-form.php' );
include_once( 'elements/divider.php' );
include_once( 'elements/dropcap.php' );
include_once( 'elements/gallery.php' );
include_once( 'elements/gmap.php' ); // check
include_once( 'elements/highlight.php' );
include_once( 'elements/image.php' );
include_once( 'elements/touch-slider.php' );
include_once( 'elements/related-posts.php' );
include_once( 'elements/before-after.php' );

// check if instagram-feed is activated then it adds its element to page builder and widget
if( auxin_is_plugin_active( 'instagram-feed/instagram-feed.php' ) ) {
    include_once( 'elements/instagram-feed.php' );
}
// check if flickr-justified-gallery is activated then it adds its element to page builder and widget
if( auxin_is_plugin_active( 'flickr-justified-gallery/flickr-justified-gallery.php' ) ) {
    include_once( 'elements/flickr.php' );
}
// check if flickr-justified-gallery is activated then it adds its element to page builder and widget
if( auxin_is_plugin_active( 'custom-facebook-feed/custom-facebook-feed.php' ) ) {
    include_once( 'elements/facebook.php' );
}
include_once( 'elements/latest-posts-slider.php' );
include_once( 'elements/quote.php' );
include_once( 'elements/search.php' );
include_once( 'elements/socials-list.php' );
include_once( 'elements/video.php' );
include_once( 'elements/contact-box.php' );

