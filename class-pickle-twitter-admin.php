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

    /**
     * Admin menu.
     *
     * @access public
     * @return void
     */
    public function admin_menu() {
        add_options_page( 'Pickle Twitter', 'Pickle Twitter', 'manage_options', 'pickle-twitter', array( $this, 'admin_page' ) );
    }

    /**
     * Admin page(s).
     *
     * @access public
     * @return void
     */
    public function admin_page() {
        $html = null;
        $tabs = array(
            'settings' => 'Settings',
        );
        $active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'settings';

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

    /**
     * Get admin page.
     *
     * @access public
     * @param bool $template_name (default: false).
     * @return html
     */
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

    /**
     * Update settings.
     *
     * @access public
     * @return boolean
     */
    public function update_settings() {
        $url = '';
        $post_settings = '';

        if ( ! isset( $_POST['pickle_twitter_admin'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['pickle_twitter_admin'] ) ), 'update_settings' ) ) {
            return false;
        }

        if ( isset( $_POST['_wp_http_referer'] ) ) :
            $url = esc_url_raw( wp_unslash( $_POST['_wp_http_referer'] ) );
        endif;

        if ( isset( $_POST['settings'] ) ) :
            $post_settings = sanitize_text_field( wp_unslash( $_POST['settings'] ) );
        endif;

        $new_settings = pickle_twitter()->parse_args( $post_settings, pickle_twitter()->settings );

        update_option( 'pickle_twitter_settings', $new_settings );

        wp_redirect( site_url( $url ) );
        exit;
    }
}

// only run if admin.
if ( is_admin() ) :
    new Pickle_Twitter_Admin();
endif;
