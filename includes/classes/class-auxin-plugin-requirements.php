<?php

if( ! class_exists( 'Auxin_Plugin_Requirements' ) ){

    /**
     * Checks the requirements for a plugin
     *
     */
    class Auxin_Plugin_Requirements {

        /**
         * An array containing the list of requirements
         *
         * @var array
         */
        public  $requirements = array();

        /**
         * Whether the requirements are available or not
         *
         * @var boolean
         */
        private $requirements_passed = true;

        /**
         * Collects error notices
         *
         * @var array
         */
        public $admin_notices = array();



        function __construct(){

            if( is_admin() ){
                add_action( 'admin_notices'     , array( $this, 'admin_notices' ) );
                add_action( 'activated_plugin'  , array( $this, 'update_plugins_dependencies' ) );
            } else {
                add_action( 'auxin_after_inner_body_open', array( $this, 'front_notices' ) );
            }

        }

        /**
         * Make sure the client has the requirements, otherwise, throw a notice in admin
         *
         * @return void
         */
        public function admin_notices( $pop_notice =  '' ){
            if( $this->admin_notices ) {
                echo '<div class="error aux-admin-error">';
                echo $this->get_notices( $pop_notice );
                echo '</div>';
            }
        }

        /**
         * Make sure the client has the requirements, otherwise, throw a notice
         *
         * @return void
         */
        public function get_notices( $pop_notice =  '' ){
            $the_notice = '';

            if( $this->admin_notices && $notices = implode( '</li><li>', $this->admin_notices ) ) {
                $the_notice .= '<p>' . $pop_notice;
                $the_notice .= sprintf(
                    __( '%s plugin has been disabled automatically due to following reason:', 'auxin-elements' ),
                    '<strong>'. $this->requirements['config']['plugin_name'] . '</strong>'
                );
                $the_notice .= '<ul><li>'. $notices . '</li></ul></p>';
            }

            if( $this->requirements['config']['debug'] ){
                $active_plugins = get_option( 'active_plugins' );
                $the_notice .= "<pre>"; $the_notice .= sprint_r( $active_plugins ); $the_notice .= "</pre>";
            }
            return $the_notice;
        }

        /**
         * Make sure the client has the requirements, otherwise, throw a notice in frontend for administrator
         *
         * @return void
         */
        public function front_notices(){
            if( $this->admin_notices && current_user_can( 'edit_theme_options' ) ) {
                $pop_notice = '<strong>' . __( 'Note for admin', 'auxin-elements' ) . '</strong>:  ';
                echo '<div class="aux-front-error aux-front-notice aux-fold">';
                echo $this->get_notices( $pop_notice );
                echo '</div>';
            }
        }

        /**
         * Wrapper around the core WP get_plugins function, making sure it's actually available.
         *
         * @return array Array of installed plugins with plugin information.
         */
        public function get_plugins() {
            if ( ! function_exists( 'get_plugins' ) ) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }

            return get_plugins();
        }

        /**
         * Check whether a plugin is active.
         *
         * @param string $plugin Base plugin path from plugins directory.
         *
         * @return bool True, if in the active plugins list. False, not in the list.
         */
        function is_plugin_active( $plugin ) {

            if ( ! function_exists( 'is_plugin_active' ) ) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }
            return is_plugin_active( $plugin );

        }

        /**
         * Load the dependency plugins before the current plugin
         *
         * @return void
         */
        function update_plugins_dependencies(){

            if( empty( $this->requirements['plugins'] ) ){
                return;
            }

            if( $plugin_requirements = $this->requirements['plugins'] ){

                // Walk through the plugins
                foreach ( $plugin_requirements as $plugin_requirement ) {

                    // Make sure if the plugin is expected to be loaded prior to our main plugin
                    if( ! empty( $plugin_requirement['dependency'] ) && true == $plugin_requirement['dependency'] && $this->is_plugin_active( $plugin_requirement['basename'] ) ){
                        // Get all activated plugins
                        $active_plugins = get_option( 'active_plugins' );

                        // Get the load orders
                        $this_plugin_load_order       = array_search( $this->requirements['config']['plugin_basename'], $active_plugins );
                        $dependency_plugin_load_order = array_search( $plugin_requirement['basename'], $active_plugins );

                        // Replace the orders and update the order list
                        if( $dependency_plugin_load_order > $this_plugin_load_order ){
                            $sliced_basename = array_splice( $active_plugins, $this_plugin_load_order , 1 );
                            array_splice( $active_plugins, $dependency_plugin_load_order , 0, $sliced_basename );
                            update_option( 'active_plugins', $active_plugins );
                        }

                    }

                }

            }

        }

        /**
         * Check plugin requirements
         *
         * @return void
         */
        function check_plugins_requirement(){

            if( empty( $this->requirements['plugins'] ) ){
                return;
            }

            if( $plugin_requirements = $this->requirements['plugins'] ){
                if ( ! wp_installing() || 'wp-activate.php' === $pagenow ) {

                    // Walk through the plugins
                    foreach ( $plugin_requirements as $plugin_requirement ) {

                        // check if the plugin is active
                        $is_plugin_active = $this->is_plugin_active( $plugin_requirement['basename'] );

                        // if activating the plugin is required
                        if(
                            ( ! empty( $plugin_requirement['required']    ) && true == $plugin_requirement['required'] && ! $is_plugin_active ) ||
                            ( ! empty( $plugin_requirement['is_callable'] ) && ! function_exists( $plugin_requirement['is_callable'] ) )
                        ){

                            $this->admin_notices[] = sprintf(
                                __( '%s plugin is required in order to use this plugin. Please install and activate the plugin.', 'auxin-elements' ),
                                '<strong>'. $plugin_requirement['name'] . '</strong>'
                            );

                            $this->requirements_passed = false;

                        // if minimum plugin version was specified
                        } elseif( ! empty( $plugin_requirement['version'] ) && $is_plugin_active ){

                            $all_plugins = $this->get_plugins();

                            if( empty( $all_plugins[ $plugin_requirement['basename'] ]['Version'] ) ){
                                continue;
                            }

                            $current_plugin_version = $all_plugins[ $plugin_requirement['basename'] ]['Version'];

                            if ( version_compare( $current_plugin_version, $plugin_requirement['version'], '<' ) ) {

                                $this->admin_notices[] = sprintf(
                                    __( 'The plugin requires %s plugin version %s or higher (current version is %s). Please update it to the latest version.', 'auxin-elements' ),
                                    '<strong>'. $plugin_requirement['name'] . '</strong>',
                                    '<strong>'. $plugin_requirement['version'] . '</strong>',
                                    '<strong>'. $current_plugin_version . '</strong>'
                                );

                                $this->requirements_passed = false;
                            }

                        }

                    }

                }

            }

        }

        /**
         * Check them requirements
         *
         * @return void
         */
        function check_theme_requirement(){

            if( empty( $this->requirements['themes'] ) ){
                return;
            }

            if( $theme_requirements = $this->requirements['themes'] ){

                // Walk through the themes
                foreach ( $theme_requirements as $theme_requirement ) {

                    if (
                        ( ! empty( $theme_requirement['file_exists'] ) && ! file_exists( $theme_requirement['file_exists']     ) ) ||
                        ( ! empty( $theme_requirement['is_callable'] ) && ! function_exists( $theme_requirement['is_callable'] ) )
                    ){

                        $this->admin_notices[] = sprintf(
                            __( '%s theme is required in order to use this plugin. Please install and activate the theme.', 'auxin-elements' ),
                            '<strong>'. $theme_requirement['name'] . '</strong>'
                        );

                        $this->requirements_passed = false;
                        return;

                    } elseif ( $theme_requirement['version'] ){

                        $theme_data = wp_get_theme();
                        $theme_data = $theme_data->parent() ? $theme_data->parent() : $theme_data;

                        if ( version_compare( $theme_data->Version, $theme_requirement['version'], '<' ) ) {

                            $this->admin_notices[] = sprintf(
                                __( 'The plugin requires %s theme version %s or higher in order to function property. Your current theme version is %s, please update it to the latest version.', 'auxin-elements' ),
                                '<strong>'. $theme_requirement['name'] . '</strong>',
                                '<strong>'. $theme_requirement['version'] . '</strong>',
                                '<strong>'. $theme_data->Version . '</strong>'
                            );

                            $this->requirements_passed = false;
                            return;
                        }

                    }

                }

            }

        }

        /**
         * Check PHP requirements
         *
         * @return void
         */
        function check_php_requirement(){

            if( empty( $this->requirements['php']['version'] ) ){
                return;
            }

            if ( version_compare( PHP_VERSION, $this->requirements['php']['version'], '<' ) ) {

                $this->admin_notices[] =  sprintf(
                    __( 'PHP version %s or above is required for this plugin while your the current PHP version is %s.', 'auxin-elements' ),
                    '<strong>'. $this->requirements['php']['version'] . '</strong>',
                    '<strong>'. PHP_VERSION . '</strong>'
                );

                $this->requirements_passed = false;
                return;
            }

        }

        /**
         * Checks all requirements
         *
         * @return string|boolean    True if all requirements are passed, false or error message on failure
         */
        public function validate(){

            $this->check_php_requirement();

            if( true !== $this->requirements_passed ){ return $this->requirements_passed; }

            $this->check_theme_requirement();

            if( true !== $this->requirements_passed ){ return $this->requirements_passed; }

            $this->check_plugins_requirement();

            return $this->requirements_passed;
        }

    }

}
