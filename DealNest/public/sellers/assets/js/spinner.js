$(document).ready(function() {
    console.log('DOM is ready');
    $('#loader').fadeIn();
});

$(window).on('load', function() {
    console.log('Page is fully loaded');
    $('#loader').fadeOut('slow');
});

$(document).on('submit', 'form', function(e) {
    console.log('Form is being submitted');
    $(this).find('button[type="submit"]').attr('disabled', true);
    $('#loader').fadeIn();
});

$(document).ajaxStart(function () {
    console.log('Ajax request started');
    $('#loader').fadeIn();
});

$(document).ajaxStop(function () {
    console.log('Ajax request stopped');
    $('#loader').fadeOut('slow');
});
