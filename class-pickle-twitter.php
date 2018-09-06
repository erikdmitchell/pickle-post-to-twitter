<?php
/**
 * Main Pickle Twitter class
 *
 * @package PickleTwitter
 * @since   1.0.0
 */

/**
 * Final Pickle_Twitter class.
 *
 * @final
 */
final class Pickle_Twitter {

    /**
     * Version
     *
     * @var string
     * @access public
     */
    public $version = '1.0.0';

    /**
     * Settings.
     *
     * (default value: '').
     *
     * @var string
     * @access public
     */
    public $settings = '';

    /**
     * Construct function.
     *
     * @access public
     * @return void
     */
    public function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
        $this->init();
    }

    /**
     * Define constants function.
     *
     * @access private
     * @return void
     */
    private function define_constants() {
        $this->define( 'PICKLE_TWITTER_PATH', plugin_dir_path( __FILE__ ) );
        $this->define( 'PICKLE_TWITTER_URL', plugin_dir_url( __FILE__ ) );
        $this->define( 'PICKLE_TWITTER_VERSION', $this->version );
        $this->define( 'PICKLE_TWITTER_REQUIRES', '3.8' );
        $this->define( 'PICKLE_TWITTER_TESTED', '4.9.5' );
    }

    /**
     * Define function.
     *
     * @access private
     * @param mixed $name (name).
     * @param mixed $value (value).
     * @return void
     */
    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    /**
     * Includes function.
     *
     * @access public
     * @return void
     */
    public function includes() {
        include_once( PICKLE_TWITTER_PATH.'lib/twitteroauth/autoload.php');
        include_once( PICKLE_TWITTER_PATH . 'class-pickle-twitter-update.php' );
        include_once( PICKLE_TWITTER_PATH . 'class-pickle-twitter-admin.php' );        
    }

    /**
     * Init hooks function.
     *
     * @access private
     * @return void
     */
    private function init_hooks() {
        //register_activation_hook( PICKLE_TWITTER_PLUGIN_FILE, array( 'Pickle_Calendar_Install', 'install' ) );
    }

    /**
     * Init function.
     *
     * @access public
     * @return void
     */
    public function init() {
        $this->settings = $this->settings();
    }

    /**
     * Settings function.
     *
     * @access public
     * @return array
     */
    public function settings() {
        $default_settings = array(
            'consumer_key' => '',
            'consumer_secret' => '',
            'access_token' => '',
            'access_token_secret' => '',
        );

        $db_settings = get_option( 'pickle_twitter_settings', '' );

        $settings = $this->parse_args( $db_settings, $default_settings );

        return $settings;
    }

    /**
     * Update settings function.
     *
     * @access public
     * @return void
     */
    public function update_settings() {
        $this->settings = $this->settings();
    }

    /**
     * Parse args function.
     *
     * @access public
     * @param mixed $a (array).
     * @param mixed $b (array).
     * @return array
     */
    public function parse_args( &$a, $b ) {
        $a = (array) $a;
        $b = (array) $b;
        $result = $b;

        foreach ( $a as $k => &$v ) {
            if ( is_array( $v ) && isset( $result[ $k ] ) ) {
                $result[ $k ] = $this->parse_args( $v, $result[ $k ] );
            } else {
                $result[ $k ] = $v;
            }
        }

        return $result;
    }

}

/**
 * Main function.
 *
 * @access public
 * @return class
 */
function pickle_twitter() {
    return new Pickle_Twitter();
}

// Global for backwards compatibility.
$GLOBALS['pickle_twitter'] = pickle_twitter();
