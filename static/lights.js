$(document).ready(function () {
    $('.toggler').on('change', function () {
        var light = $(this),
            url = '?method=ajax&light=' + light.attr('rel') + '&action=' + light.val();
        $.get(url);
    });
    $('.dimmer').on('stop', function () {
        var light = $(this),
            url = '?method=ajax&light=' + light.attr('rel') + '&action=dim&arguments=' + light.val();
        $.get(url);
    });
});
