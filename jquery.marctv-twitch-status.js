(function($) {
  $(document).ready(function($) {
    $.getJSON('https://api.twitch.tv/kraken/streams/' + marctvtwitchsettings.channelname + '?callback=?', function(a) {
      if (a.stream) {
        $(marctvtwitchsettings.selector).append('<li class="twitch-status menu-item"><a target="_blank" title="' + a.stream.viewers + ' viewers" href="' + marctvtwitchsettings.url + '">Live!</a></li>');
      }
    });
  });
})(jQuery);