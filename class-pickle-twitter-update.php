<?php
/**
 * Main Pickle Twitter class
 *
 * @package PickleTwitter
 * @since   1.0.0
 */

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
/*
		$this->connection = new TwitterOAuth(
			get_option('uci_results_twitter_consumer_key', ''),
			get_option('uci_results_twitter_consumer_secret', ''),
			get_option('uci_results_twitter_access_token', ''),
			get_option('uci_results_twitter_access_token_secret', '')
		);
*/
	}

	/**
	 * Update status.
	 *
	 * @access public
	 * @param string $status (default: '').
	 * @return string
	 */
	public function update_status($status='') {
		if (empty($status))
			return 'No status to update.';

		$msg='';

		// update status //
		$status_post=$this->connection->post("statuses/update", ["status" => $status]);

		// check if it worked or not //
		if ($this->connection->getLastHttpCode() == 200) :
			$msg="Twitter status updated.";
		else :
	  	    $msg="Tweet failed to send: ";

			foreach ($status_post->errors as $error) :
				$msg.=$error->message;
			endforeach;
		endif;

		return $msg;
	}
}