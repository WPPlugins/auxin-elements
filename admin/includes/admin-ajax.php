<?php

function auxin_ajax_send_feedback(){

    // skip if the form data is not receiced
    if( empty( $_POST['form'] ) ){
        wp_send_json_error( __( 'Data cannot be delivered, please try again.', 'auxin-elements' ) );
    }

    $form_data = $_POST['form'];

    // extract the form data
    $rate     = ! empty( $form_data['theme_rate'] ) ? $form_data['theme_rate'] : '';
    $feedback = ! empty( $form_data['feedback']   ) ? $form_data['feedback']   : '';
    $email    = ! empty( $form_data['email']      ) ? $form_data['email']      : '';
    $nonce    = ! empty( $form_data['_wpnonce']   ) ? $form_data['_wpnonce']   : '';

    if( ! wp_verify_nonce( $nonce, 'phlox_feedback' ) ){
        wp_send_json_error( __( 'Authorization failed!', 'auxin-elements' ) );
    }

    if( $rate ){

        global $wp_version;

        $args = array(
            'user-agent' => 'WordPress/'.$wp_version.'; '. get_home_url(),
            'timeout'    => ( ( defined('DOING_CRON') && DOING_CRON ) ? 30 : 5),
            'body'       => array(
                'cat'       => 'rating',
                'action'    => 'submit',
                'item-slug' => 'phlox',
                'rate'      => $rate
            )
        );
        // send the rating through the api
        $request = wp_remote_post( 'http://api.averta.net/envato/items/', $args );

        // if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {}

        // store the user rating on the website
        auxin_update_option( 'user_rating', $rate );

        // send the feedback via email
        $message = 'Rate: '. $rate . "\r\n" . 'Email: <' . $email . ">\r\n\r\n" . $feedback;
        wp_mail( 'feedbacks'.'@'.'averta.net', 'Feedback from phlox dashboard:', $message );

        wp_send_json_success( __( 'Sent Successfully. Thanks for your feedback!', 'auxin-elements' ) );

    } else{
        wp_send_json_error( __( 'An error occurred. Feedback could not be delivered, please try again.', 'auxin-elements' ) );
    }

}

add_action( 'wp_ajax_send_feedback', 'auxin_ajax_send_feedback' );
