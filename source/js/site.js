/**
 * Javascript run on each load.
 */
$(document).ready(function() {

    // Make all external links open in new window
    $('a').each(function() {
       var regex = new RegExp('/' + window.location.host + '/');
       if(!regex.test(this.href)) {
           $(this).attr('target', '_blank');
       }
    });

    // Kickstart galleries
    $('a.gallery').colorbox({
        'maxWidth': "90%",
        'maxHeight': "90%",
        'rel': 'group1',
        'transition': "none",
        'fadeOut': 0
    });
});
