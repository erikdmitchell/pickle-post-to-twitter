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
    	add_action( 'admin_init', array( $this, 'update_settings' ) );
    	add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}
	
	public function admin_menu() {
        add_options_page( 'Pickle Twitter', 'Pickle Twitter', 'manage_options', 'pickle-twitter', array( $this, 'admin_page' ) );
    }
    
    public function admin_page() {
        $html = null;
        $tabs = array(
            'settings' => 'Settings',
        );
        $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'settings';

        $html .= '<div class="wrap pickle-twitter-admin">';
            $html .= '<h1>Pickle Twitter</h1>';

            $html .= '<h2 class="nav-tab-wrapper">';
            foreach ( $tabs as $key => $name ) :
                if ( $active_tab == $key ) :
                    $class = 'nav-tab-active';
                else :
                    $class = null;
                endif;
    
                $html .= '<a href="?page=pickle-twitter&tab=' . $key . '" class="nav-tab ' . $class . '">' . $name . '</a>';
                endforeach;
            $html .= '</h2>';

        switch ( $active_tab ) :
            default:
                $html .= $this->get_admin_page( 'settings' );
            endswitch;

        $html .= '</div>';

        echo $html;
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
    
    public function update_settings() {
        if ( ! isset( $_POST['pickle_twitter_admin'] ) || ! wp_verify_nonce( $_POST['pickle_twitter_admin'], 'update_settings' ) ) {
            return false;
        }

/*
        $new_settings = picklecalendar()->parse_args( $_POST['settings'], picklecalendar()->settings );

        // for checkboxes //
        foreach ( $new_settings as $key => $value ) :
            if ( ! isset( $_POST['settings'][ $key ] ) ) :
                $new_settings[ $key ] = 0;
            endif;
        endforeach;

        update_option( 'pickle_calendar_settings', $new_settings );
*/

        wp_redirect( site_url( $_POST['_wp_http_referer'] ) );
        exit;
    }    
}