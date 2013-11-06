$(document).ready(function () {
    $('#green').change(function () {
        var url = '?method=ajax&light=1&action=';
        if (this.val() == 'no')
        {
            url += 'turnOff';
        }
        else
        {
            url += 'turnOn';
        }
        $.get(url);
    });
});
