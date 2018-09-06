<?php
/**
 * Main Pickle Twitter submitbox class
 *
 * @package PickleTwitter
 * @since   1.0.0
 */
 
 
 /**
  * Pickle_Twitter_Post_Submitbox class.
  */
 class Pickle_Twitter_Post_Submitbox {

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct() {
        add_action( 'post_submitbox_misc_actions', array($this, 'post_submitbox_twitter_details' ) );
        add_action( 'save_post', array($this, 'post_submitbox_twitter_save'), 10, 3);
        add_action( 'admin_enqueue_scripts' , array($this, 'admin_scripts_styles'));
    }
    
    public function admin_scripts_styles() {
        wp_enqueue_script('pickle-twitter-post-submitbox-script', PICKLE_TWITTER_URL.'js/post-submitbox.js', array('jquery'), PICKLE_TWITTER_VERSION, true);
        
        wp_enqueue_style('pickle-twitter-post-submitbox-style', PICKLE_TWITTER_URL.'css/post-submitbox.css', '', PICKLE_TWITTER_VERSION);
    }

    public function post_submitbox_twitter_details( $post ) {
        $html = '';
        $checkbox = get_post_meta($post->ID, '_pickle_twitter_posted', true);
        $text = get_post_meta($post->ID, '_pickle_twitter_text', true);

        // set default text.
        if (empty($text)) :
            $text = get_the_title($post->ID);
        endif;
        
        $html .= '<div class="misc-pub-section misc-pub-pickle-twitter">';
            $html .= '<label><input type="checkbox"' . (empty($checkbox) ? ' checked="checked" ' : null) . ' value="1" class="pickle-post-to-twitter" name="pickle_twitter[post]" /> Post to Twitter</label>';
            $html .= '<a href="#pickle-twitter-text-edit" class="edit-pickle-twitter-text hide-if-no-js" role="button"><span aria-hidden="true">Edit</span></a>';
            $html .= '<div id="pickle-twitter-text-wrap">';
                $html .= '<input type="text" id="pickle-twitter-text" name="pickle_twitter[text]" value="'.$text.'" />';
                $html .= '<a href="#pickle-twitter-text-save" class="save-pickle-twitter-text hide-if-no-js button">OK</a>';
                $html .= '<a href="#pickle-twitter-text-cancel" class="cancel-pickle-twitter-text hide-if-no-js button-cancel">Cancel</a>';
            $html .= '</div>';
        $html .= '</div>';
        
        echo $html;
    }
    
    public function post_submitbox_twitter_save($post_id, $post, $update) {
        update_post_meta($post_id, '_pickle_twitter_posted', 1); // set this so we know it's already been done.
       
        // only run this if post to twitter is checked.
        if (isset($_POST['pickle_twitter']['post']) && 1 == $_POST['pickle_twitter']['post'] ) :
            $image = get_the_post_thumbnail($post_id, 'full');
            $text = $_POST['pickle_twitter']['text'].' '.get_permalink($post_id);
            
            $status = $image . $text;
            
            $message = pickle_twitter()->update_twitter_status($status);       
        endif;
    }
}

new Pickle_Twitter_Post_Submitbox();