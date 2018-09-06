jQuery(document).ready(function($) {
   
    // initial show of textbox.
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
});