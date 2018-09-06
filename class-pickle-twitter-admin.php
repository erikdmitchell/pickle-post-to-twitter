<?php
/**
 * Main Pickle Twitter class
 *
 * @package PickleTwitter
 * @since   1.0.0
 */

/**
 * Pickle_Twitter_Admin class.
 */
class Pickle_Twitter_Admin {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->connection = new TwitterOAuth(
			get_option('uci_results_twitter_consumer_key', ''),
			get_option('uci_results_twitter_consumer_secret', ''),
			get_option('uci_results_twitter_access_token', ''),
			get_option('uci_results_twitter_access_token_secret', '')
		);
	}

    public function get_admin_page( $template_name = false ) {
        if ( ! $template_name ) {
            return false;
        }

        ob_start();

        do_action( 'pickle_twitter_before_admin_' . $template_name );

        include( PICKLE_TWITTER_PATH . 'adminpages/' . $template_name . '.php' );

        do_action( 'pickle_tiwtter_after_admin_' . $template_name );

        $html = ob_get_contents();

        ob_end_clean();

        return $html;
    }
}