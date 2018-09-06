<?php
/**
 * Main Pickle Twitter post class
 *
 * @package PickleTwitter
 * @since   1.0.0
 */

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Pickle_Twitter_Post class.
 */
class Pickle_Twitter_Post {

    /**
     * Connection
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

    public function update_status( $status = '', $media_url = '' ) {
        if ( empty( $status ) ) {
            return 'No status to update.';
        }

        $msg = '';
        
        // setup media if need be.
        if (!empty($media_url)) :
            $media = $connection->upload('media/upload', ['media' => $media_url]);
            
            $parameters = [
                'status' => $status,
                'media_ids' => $media->media_id_string,
            ];
            
            $status_post = $connection->post('statuses/update', $parameters);
        else:
            // update status.
            $status_post = $this->connection->post( 'statuses/update', [ 'status' => $status ] );
        endif;

        // check if it worked or not.
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
