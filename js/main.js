jQuery(document).ready(function($) {
// Cкролл наверх  
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

// Cкрытие списка категорий
  $('.subcat').toggle(
    function() {
      $('.article-title .description').stop().animate({height: "show"}, 50);
    },
    function() {
      $('.article-title .description').stop().animate({height:"hide"}, 50);
    }
  );

});


// Настройка noty
function notify (text, type) {
    var n = noty({
      text: text,
      type: type,
      dismissQueue: true,
      layout: 'top',
      theme: 'default',
      timeout: 5000,
    });
  };
