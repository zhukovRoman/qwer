jQuery(document).ready(function($) {
  $('.arrow-up').click(function() {
    $('.header').ScrollTo();
  });
  $('body').bind('mousemove',function(e){  
    if (e.pageY>1000) {
      $('.arrow-up').show();
    }else {
      $('.arrow-up').hide();
    }
  });
});
