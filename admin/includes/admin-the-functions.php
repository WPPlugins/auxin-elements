<?php
// admin related functions


function auxin_get_about_system_status(){
    ?>
    <div class="aux-status-wrapper">
        <table class="widefat" cellspacing="0">
          <thead>
            <tr>
              <th colspan="3" data-export-label="WordPress Environment"><?php _e( 'WordPress Environment', 'auxin-elements' ); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td data-export-label="Home URL"><?php _e( 'Home URL', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The URL of your site\'s homepage.', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td><?php echo home_url(); ?></td>
            </tr>
            <tr>
              <td data-export-label="Site URL"><?php _e( 'Site URL', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The root URL of your site.', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td><?php echo site_url(); ?></td>
            </tr>
            <tr>
              <td data-export-label="WP Version"><?php _e( 'WP Version', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The version of WordPress installed on your site.', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td><?php bloginfo('version'); ?></td>
            </tr>
            <tr>
              <td data-export-label="WP Multisite"><?php _e( 'WP Multisite', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'Whether or not you have WordPress Multisite enabled.', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td><?php if ( is_multisite() ) echo '&#10004;'; else echo '&#10005;'; ?></td>
            </tr>
            <tr>
              <td data-export-label="WP Memory Limit"><?php _e( 'WP Memory Limit', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The maximum amount of memory (RAM) that your site can use at one time.', 'auxin-elements' ) . '"> ? </a>'; ?></td>
              <td><?php
              // This field need to make some changes
                $server_memory = 0;
                if( function_exists( 'ini_get' ) ) {
                  echo ( ini_get( 'memory_limit') );
                }
              ?></td>
            </tr>
            <tr>
              <td data-export-label="WP Permalink"><?php _e( 'WP Permalink', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The WordPress permalink structer.', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td><?php  echo get_option( 'permalink_structure' ); ?></td>
            </tr>
            <tr>
              <td data-export-label="WP Debug Mode"><?php _e( 'WP Debug Mode', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'Displays whether or not WordPress is in Debug Mode.', 'auxin-elements' ) . '"> ? </a>'; ?></td>
              <td><?php if ( defined('WP_DEBUG') && WP_DEBUG ) echo '<mark class="yes">' . '&#10004;' . '</mark>'; else echo '<mark class="no">' . '&#10005;' . '</mark>'; ?></td>
            </tr>
            <tr>
              <td data-export-label="Language"><?php _e( 'Language', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The current language used by WordPress. Default = English', 'auxin-elements' ) . '"> ? </a>'; ?></td>
              <td><?php echo get_locale() ?></td>
            </tr>
          </tbody>
        </table>

        <table class="widefat" cellspacing="0">
          <thead>
            <tr>
              <th colspan="3" data-export-label="Server Environment"><?php _e( 'Server Environment', 'auxin-elements' ); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td data-export-label="Server Info"><?php _e( 'Server Info', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'Information about the web server that is currently hosting your site.', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
            </tr>
            <tr>
              <td data-export-label="PHP Version"><?php _e( 'PHP Version', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The version of PHP installed on your hosting server.', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td><?php
              // should add the cpmparsion check for version_compare(PHP_VERSION, '5.0.0', '<')
              if ( function_exists( 'phpversion' ) ) echo esc_html( phpversion() ); ?></td>
            </tr>
            <tr>
              <td data-export-label="Server Info"><?php _e( 'Server Info', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'Information about the web server that is currently hosting your site.', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
            </tr>
            <?php if ( function_exists( 'ini_get' ) ) : ?>
            <tr>
              <td data-export-label="PHP Post Max Size"><?php _e( 'PHP Post Max Size', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The largest file size that can be contained in one post.', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td></td>
            </tr>
            <tr>
              <td data-export-label="PHP Time Limit"><?php _e( 'PHP Time Limit', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td><?php
                  $time_limit = ini_get('max_execution_time');
                  //should add the condition
                  if ( $time_limit < 180 && $time_limit != 0 ) {
                    echo '<mark class="error">' . sprintf( __( '%s - We recommend setting max execution time to at least 180. See: <a href="%s" target="_blank">Increasing max execution to PHP</a>', 'auxin-elements' ), $time_limit, 'http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded' ) . '</mark>';
                  } else {
                    echo '<mark class="yes">' . $time_limit . '</mark>';
                  }
                ?>
              </td>
            </tr>
            <tr>
              <td data-export-label="PHP Max Input Vars"><?php _e( 'PHP Max Input Vars', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td><?php echo ini_get('max_input_vars'); ?></td>
            </tr>
            <tr>
              <td data-export-label="SUHOSIN Installed"><?php _e( 'SUHOSIN Installed', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'Suhosin is an advanced protection system for PHP installations. It was designed to protect your servers on the one hand against a number of well known problems in PHP applications and on the other hand against potential unknown vulnerabilities within these applications or the PHP core itself. If enabled on your server, Suhosin may need to be configured to increase its data submission limits.', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td><?php echo extension_loaded( 'suhosin' ) ? '&#10004;' : '&#10005;'; ?></td>
            </tr>
            <?php endif; ?>
            <tr>
              <td data-export-label="MySQL Version"><?php _e( 'MySQL Version', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The version of MySQL installed on your hosting server.', 'auxin-elements' ) . '"> ? </a>'; ?></td>
              <td>
                <?php
                /** @global wpdb $wpdb */
                global $wpdb;
                echo $wpdb->db_version();
                ?>
              </td>
            </tr>
            <tr>
              <td data-export-label="Max Upload Size"><?php _e( 'Max Upload Size', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The largest file size that can be uploaded to your WordPress installation.', 'auxin-elements'  ) . '"> ? </a>'; ?></td>
              <td><?php echo size_format( wp_max_upload_size() ); ?></td>
            </tr>
            <tr>
              <td data-export-label="Default Timezone is UTC"><?php _e( 'Default Timezone is UTC', 'auxin-elements' ); ?>:</td>
              <td class="help"><?php echo '<a href="#" class="help-tip" original-title="' . esc_attr__( 'The default timezone for your server.', 'auxin-elements' ) . '"> ? </a>'; ?></td>
              <td><?php
                $default_timezone = date_default_timezone_get();
                if ( 'UTC' !== $default_timezone ) {
                  echo '<mark class="error">' . '&#10005; ' . sprintf( __( 'Default timezone is %s - it should be UTC', 'auxin-elements' ), $default_timezone ) . '</mark>';
                } else {
                  echo '<mark class="yes">' . '&#10004;' . '</mark>';
                } ?>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="widefat active-plugins" cellspacing="0" id="status">
          <thead>
            <tr>
              <th colspan="3" data-export-label="Active Plugins (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)"><?php _e( 'Active Plugins', 'auxin-elements' ); ?> (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $active_plugins = (array) get_option( 'active_plugins', array() );

            if ( is_multisite() ) {
              $active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
            }
            foreach ( $active_plugins as $plugin ) {
              $plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
              $dirname        = dirname( $plugin );
              $version_string = '';
              $network_string = '';
              if ( ! empty( $plugin_data['Name'] ) ) {
                // link the plugin name to the plugin url if available
                $plugin_name = esc_html( $plugin_data['Name'] );
                if ( ! empty( $plugin_data['PluginURI'] ) ) {
                  $plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . __( 'Visit plugin homepage' , 'auxin-elements' ) . '" target="_blank">' . $plugin_name . '</a>';
                }
                ?>
                <tr>
                  <td><?php echo $plugin_name; ?></td>
                  <td><?php echo sprintf( _x( 'by %s', 'by author', 'auxin-elements' ), $plugin_data['Author'] ) . ' Version &ndash; ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string; ?></td>
                </tr>
                <?php
                  }
            }
            ?>
          </tbody>
        </table>

    </div>
    <?php
}



/**
 * Retrieves the changelog remotely
 *
 * @param  string $item_name  The name of the project that we intend to get the info of
 * @return string             The changelog context
 */
function auxin_get_remote_changelog( $item_name = '' ){

    if( empty( $item_name ) ){
        $item_name = THEME_ID;
    }

    global $wp_version;

    $args = array(
        'user-agent' => 'WordPress/'. $wp_version.'; '. get_site_url(),
        'timeout'    => ( ( defined('DOING_CRON') && DOING_CRON ) ? 30 : 10 ),
        'body'       => array(
            'action'    => 'text',
            'cat'       => 'changelog',
            'item-name' => 'phlox',
            'context'   => 'full',
            'format'    => 'json',
            'latest'    => ''
        )
    );

    $request = wp_remote_get( 'http://api.averta.net/envato/items/', $args );

    if ( is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) !== 200 ) {
        return new WP_Error( 'no_response', 'Error while receiving remote data' );
    }

    $response = $request['body'];

    return $response;
}

