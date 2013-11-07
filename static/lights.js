$(document).ready(function () {
    $.mobile.loading('show');
    Lights.fetch();
});

Lights = {
    fetch : function () {
        $.get('?method=lights', function (data) {
            $('#content').html(data);
            $('#content').trigger('create');
            /*$('#content ul').listview();
            $('.toggler, .dimmer').slider();*/
            $.mobile.loading('hide');
            Lights.bindEvents();
        });
    },
    bindEvents : function () {
        $('.toggler').on('change', function () {
            var light = $(this),
                url = '?method=ajax&light=' + light.attr('rel') + '&action=' + light.val(),
                next = light.parent().next();
            if (next.find('.dimmer').size() > 0)
            {
                next.find('.dimmer').val(100);
                next.find('.dimmer').slider('refresh');
                next.toggle();
            }
            $.get(url);
        });
        $('.dimmer').on('slidestop', function () {
            var light = $(this),
                url = '?method=ajax&light=' + light.attr('rel') + '&action=dim&arguments=' + light.val();
            $.get(url);
        });
    },
};
