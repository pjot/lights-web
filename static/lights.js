$(document).ready(function () {
    $('.toggler').on('change', function () {
        var light = $(this),
            url = '?method=ajax&light=' + light.attr('rel') + '&action=' + light.val();
	if (light.attr('rel') == '3')
	{
		$('#ceiling_slider').toggle(light.val() == 'turnOn');
		if (light.val() == 'turnOn')
		{
			$('.dimmer').val(100);
			$('.dimmer').slider('refresh');
		}
	}
        $.get(url);
    });
    $('.dimmer').on('slidestop', function () {
        var light = $(this),
            url = '?method=ajax&light=' + light.attr('rel') + '&action=dim&arguments=' + light.val();
        $.get(url);
    });
});
