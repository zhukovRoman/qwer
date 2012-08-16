jQuery(document).ready(function($) {
  
  $('.arrow-up').click(function() {
    $('.header').ScrollTo();
  });

  $('body').bind('mousemove',function(e){  
    if ($('.arrow-up').offset().top>1000) {
      $('.arrow-up').show();
    }else {
      $('.arrow-up').hide();
    }
  });
});

function notify (text, type) {
    var n = noty({
      text: text,
      type: type,
      dismissQueue: true,
      layout: 'topRight',
      theme: 'default',
      timeout: 5000,
    });
  };
