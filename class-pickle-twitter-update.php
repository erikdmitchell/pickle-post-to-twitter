<?php
/**
 * Main Pickle Twitter class
 *
 * @package PickleTwitter
 * @since   1.0.0
 */

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Pickle_Twitter_Update class.
 */
class Pickle_Twitter_Update {

    /**
     * connection
     *
     * @var mixed
     * @access protected
     */
    protected $connection;

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct() {
        $this->connection = new TwitterOAuth(
            pickle_twitter()->settings['consumer_key'],
            pickle_twitter()->settings['consumer_secret'],
            pickle_twitter()->settings['access_token'],
            pickle_twitter()->settings['access_token_secret']
        );
    }

    /**
     * Update status.
     *
     * @access public
     * @param string $status (default: '').
     * @return string
     */
    public function update_status( $status = '' ) {
        if ( empty( $status ) ) {
            return 'No status to update.';
        }

        $msg = '';

        // update status //
        $status_post = $this->connection->post( 'statuses/update', [ 'status' => $status ] );

        // check if it worked or not //
        if ( $this->connection->getLastHttpCode() == 200 ) :
            $msg = 'Twitter status updated.';
        else :
            $msg = 'Tweet failed to send: ';

            foreach ( $status_post->errors as $error ) :
                $msg .= $error->message;
            endforeach;
        endif;

        return $msg;
    }
}


pickle_twitter()->twitter_update = new Pickle_Twitter_Update();