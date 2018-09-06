<?php

/**
 * Plugin Name: Pickle Post to Twitter
 * Plugin URI:
 * Description: Send posts to a twitter account/feed.
 * Version: 1.0.0
 * Author: Erik Mitchell
 * Author URI:
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: pickle-twitter
 * Domain Path: /languages
 *
 * @package PickleTwitter
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Define PICKLE_TWITTER_PLUGIN_FILE.
if ( ! defined( 'PICKLE_TWITTER_PLUGIN_FILE' ) ) {
    define( 'PICKLE_TWITTER_PLUGIN_FILE', __FILE__ );
}

// Include the main Pickle_Twitter class.
if ( ! class_exists( 'Pickle_Twitter' ) ) {
    include_once dirname( __FILE__ ) . '/class-pickle-twitter.php';
}
