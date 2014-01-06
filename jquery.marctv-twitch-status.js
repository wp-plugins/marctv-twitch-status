(function($) {
  $(document).ready(function($) {
    $.getJSON('http://api.justin.tv/api/stream/summary.json?channel=' + marctvtwitchsettings.channelname + '&jsonp=?', function(a) {
      if (a.streams_count > 0) {
        $(marctvtwitchsettings.selector).append('<li class="twitch-status menu-item"><a title="' + a.viewers_count + ' viewers" href="' + marctvtwitchsettings.url + '">Live!</a></li>');
      }
    });
  });
})(jQuery); 