$(document).ready(function () {
    $('.toggler').change(function () {
        var light = $(this),
            url = '?method=ajax&light=' + light.attr('rel') + '&action=' + light.val();
        $.get(url);
    });
});
