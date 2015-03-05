(function ($) {
    $(document).ready(function ($) {
        $.getJSON('https://api.twitch.tv/kraken/streams/' + marctvtwitchsettings.channelname + '?callback=?', function (a) {
            if (a.stream) {
                var submenu = '';

                if (marctvtwitchsettings.showmeta == 'on') {
                    var submenu = '<ul class="sub-menu"><li class="menu-item twitch-meta">' +
                        '<a class="twitch-link" target="_blank" title="' + a.stream.viewers + ' viewers" href="' + marctvtwitchsettings.channelurl + '">' +
                        '<p>' + a.stream.game + '</p>' +
                        '<img src="' + a.stream.preview.medium + '"></li></ul>' +
                        '</a>';
                }

                $(marctvtwitchsettings.menuselector).append('<li id="twitch-status" class="twitch-status menu-item">' +
                '<a class="twitch-link" target="_blank" title="' + a.stream.viewers + ' viewers" href="' + marctvtwitchsettings.channelurl + '">Live!</a>' +
                submenu +
                '</li>');
                $('.offline', marctvtwitchsettings.menuselector).hide();
            }
        });
    });
})(jQuery);