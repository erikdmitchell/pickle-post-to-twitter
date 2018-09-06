<form class="pickle-twitter-settings-form" action="" method="post">
    <?php wp_nonce_field( 'update_settings', 'pickle_twitter_admin', true ); ?>  
    
    <h2>Twitter</h2>
   
    <table class="form-table">
        <tbody>
        
            <tr>
                <th scope="row"><label for="consumer-key">Consumer Key</label></th>
                <td><input name="settings[consumer_key]" type="text" id="consumer-key" value="<?php echo pickle_twitter()->settings['consumer_key']; ?>" class="regular-text"></td>
            </tr>
        
            <tr>
                <th scope="row"><label for="consumer-secret">Consumer secret</label></th>
                <td><input name="settings[consumer_secret]" type="text" id="consumer-secret" value="<?php echo pickle_twitter()->settings['consumer_secret']; ?>" class="regular-text"></td>
            </tr>
        
            <tr>
                <th scope="row"><label for="access-token">Access Token</label></th>
                <td><input name="settings[access_token]" type="text" id="access-token" value="<?php echo pickle_twitter()->settings['access_token']; ?>" class="regular-text"></td>
            </tr>

            <tr>
                <th scope="row"><label for="access-token-secret">Access Token Secret</label></th>
                <td><input name="settings[access_token_secret]" type="text" id="access-token-secret" value="<?php echo pickle_twitter()->settings['access_token_secret']; ?>" class="regular-text"></td>
            </tr>
        
        </tbody>                
    </table>    
        
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
    
</form>