(function($) {
  $(document).ready(function($) {
    $.getJSON('https://api.twitch.tv/kraken/streams/' + marctvtwitchsettings.channelname + '?callback=?', function(a) {
      if (a.stream) {
        $(marctvtwitchsettings.menuselector).append('<li class="twitch-status menu-item"><a class="twitch-link" target="_blank" title="' + a.stream.viewers + ' viewers" href="' + marctvtwitchsettings.channelurl + '">Live!</a></li>');
        $('.offline', marctvtwitchsettings.menuselector).hide();
      }
    });
  });
})(jQuery);