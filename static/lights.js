$(document).ready(function () {
    Lights.navigateTo('?method=lights');
    $('.navbar-link:first').addClass('ui-btn-active');
});

Lights = {
    navigateTo : function (url) {
        $('#content').html('');
        $.mobile.loading('show');
        $.get(url, function (data) {
            $('#content').html(data);
            $('#content').trigger('create');
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
        $('.navbar-link').on('click', function () {
            Lights.navigateTo($(this).attr('href'));
            $('.navbar-link').removeClass('ui-btn-active');
            $(this).addClass('ui-btn-active');
            return false;
        });
        $('.preset-link').on('click', function () {
            $('#content').html('');
            $.mobile.loading('show');
            $.get('?method=set_preset&preset=' + $(this).attr('rel'), function () {
                $('.navbar-link').removeClass('ui-btn-active');
                $('.navbar-link:first').addClass('ui-btn-active');
                Lights.navigateTo('?method=lights');
            });
        });
    },
};
