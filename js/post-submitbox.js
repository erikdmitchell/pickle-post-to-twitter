jQuery(document).ready(function($) {
   
    // initial show of textbox.
    var orgTextValue = $('#pickle-twitter-text').val();
    
    if ($('.misc-pub-pickle-twitter input.pickle-post-to-twitter').is(':checked')) {
        $('#pickle-twitter-text-wrap').show();
    }
    
    // when checkbox changes, show/hide textbox.
    $('.misc-pub-pickle-twitter input.pickle-post-to-twitter').on('change', function() {
        if ($(this).is(':checked')) {
            $('#pickle-twitter-text-wrap').show();
        } else {
            $('#pickle-twitter-text-wrap').hide();
        }
    });

    // when edit button clicked, show/hide textbox.
    $('.edit-pickle-twitter-text').on('click', function(e) {
        e.preventDefault();
        
        $('#pickle-twitter-text-wrap').toggle();
        
        $(this).hide();
    });
    
    // "ok" button click.
    $('.save-pickle-twitter-text').on('click', function(e) {
        e.preventDefault();
        
        $('#pickle-twitter-text-wrap').hide();
        $('.edit-pickle-twitter-text').show();
    });
    
    // cancel button click.
    $('.cancel-pickle-twitter-text').on('click', function(e) {
        e.preventDefault();
        
        $('#pickle-twitter-text').val(orgTextValue);
        
        $('#pickle-twitter-text-wrap').hide();
        $('.edit-pickle-twitter-text').show();
    });
});