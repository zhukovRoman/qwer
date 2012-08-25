jQuery(function($){

    //Анимация при отправке
    $('#sendComment').click(function() {
        var btn = $(this);
        btn.button('loading'); // call the loading function
        setTimeout(function() {
            btn.button('reset'); // call the reset function
        }, 3000);
    }); 

    //Отображение и скрытие первой формы комментов
    $('.comment-btn').click(function() {
        $('.comment-btn').hide();
        if($('.def-pos-form').css('display')!=='none'){
            $('.def-pos-form').fadeOut('fast');
        }else {
            $('#comment-form').appendTo($('.def-pos-form'))
                              .fadeIn('slow');
            $('.button-replay').show();
            $('.def-pos-form').fadeIn('fast');
        }
    });

    //Отправка по Ctrl-Enter
    $('#comment-form').keypress(function(formElement) {
        if ((event.ctrlKey)&&((event.keyCode == 0xA) || (event.keyCode == 0xD))) {
            $('#sendComment').click();
        };
    });

    //Aттач формы
    $(document).on('click', '.button-replay', function() {
        var id = this.id.slice(13);
        $('.def-pos-form').hide();
        $('#comment-form').appendTo($('#reply-'+id));
        $('.parent_id_form').val(id);
        $('.button-replay, .comment-btn').show();
        $('#replay-button'+id).hide();
    });

    //Свертка дерева комментов
    $('.comment-item .showtree').click(function() {
        var id = this.id;
        if ($("#"+id).attr('is_hide')==0){
            $("#"+id).attr('is_hide','1');
            $('.comment-item').hide();
            while ($("#"+id).attr('parent-id')!=null){
                $("#"+id).show();
                id = $("#"+id).attr('parent-id');
            }
        } else {  
            $('.comment-item').attr('is_hide','0') ;
            $('.comment-item').show() ;
        }
    });

    //Индикация кнопок Удалить и Спам

    $(document).on('click', '#delete-btn', function() {
        $(this).closest('.comment-body').animate({height:"hide"}, 250);
        notify('Удалено', 'error');
    });

    $(document).on('click', '#spam-btn', function() {
        $(this).closest('.comment-body').animate({height:"hide"}, 250);
        notify('Отправлено с спам', 'warning');
    });

    $('.delete-btn').click(function() {
        $(this).closest('.comment-body').animate({height:"hide"}, 250);
        notify('Удалено', 'error');
    });

    $('.spam-btn').click(function() {
        $(this).closest('.comment-body').animate({height:"hide"}, 250);
        notify('Отправлено с спам', 'warning');
    });


});
 
function getcomment(data){
    var resp = $.parseJSON(data);
    if (resp.status=='error'){
        notify(resp.description, 'error');
    }else {
        $('#comment-form').appendTo($('.def-pos-form'));
        $('.parent_id_form').val(0);
        $("#Comment_text").val("");
        if (resp.parentid==null){
            $("#comments").append(resp.code);
        }else{
            $("#"+resp.parentid).append(resp.code);
        }
        $('#'+resp.selfId).ScrollTo()
                          .css('background', 'green')
                          .animate({backgroundColor: "#fff"}, 4000);
    }
}
 
function commentvotesuccess(data)
{
     
    var resp = $.parseJSON(data);
    if (resp.status=='error')
    {
        flashvoteerror (resp.description, resp.id);
    }
    else 
    {
        flashvotesucces (resp.description, resp.id);
        $('#rait-'+resp.id).html(resp.code);
    }
};
 
function flashvoteerror (text, id)
{
    $('#vote-error-'+id).html (text);
    $('#vote-error-'+id).show();
    setTimeout(function() {
        $('#vote-error-'+id).hide(); // call the reset function
    }, 5000);
};
 
function flashvotesucces (text, id)
{
    $('#vote-success-'+id).html (text);
    $('#vote-success-'+id).show();
    setTimeout(function() {
        $('#vote-success-'+id).hide(); // call the reset function
    }, 5000);
};
function show_preview (data) {
  
}