jQuery(function($){
   
    $('#sendComment').click(function() {
        var btn = $(this);
        btn.button('loading'); // call the loading function
        setTimeout(function() {
            btn.button('reset'); // call the reset function
        }, 3000);
    }); 
});
 
function getcomment(data)
{
     
    var resp = $.parseJSON(data);
    if (resp.status=='error')
    {
        flashError (resp.description);
    }
    else 
    {
        $('#comment-form').appendTo($('.def-pos-form'));
        $('.parent_id_form').val(0);
        $("#Comment_text").val("");
        if (resp.parentid==null)
        {
            $("#comments").append(resp.code);
        }
        else $("#"+resp.parentid).append(resp.code);
    }
}
 
function flashError (text)
{
     
    $(".error_msg").text(text);
    $("#allert-box").attr('class', "alert alert-block alert-error fade in");
    $("#allert-box").show(300);
    setTimeout(function() {
        resetError (); // call the reset function
    }, 5000);
}
 
function resetError ()
{
    $(".error_msg").text("");
    $("#allert-box").attr('class', "alert alert-block alert-error fade out");
    $("#allert-box").hide(300);
}
 
function attachForm(id)
{
    $('#comment-form').appendTo($('#reply-'+id));
    $('.parent_id_form').val(id);
    $('.button-replay').show();
    $('#replay-button'+id).hide();
    resetError();
}
 
function showtree(id)
{
    if ($("#"+id).attr('is_hide')==0)
    {
        $("#"+id).attr('is_hide','1');
        $('.comment-item').hide();
        while ($("#"+id).attr('parent-id')!=null)
        {
            $("#"+id).show();
            id = $("#"+id).attr('parent-id');
        }
       
    }
    else {
        
        $('.comment-item').attr('is_hide','0') ;
        $('.comment-item').show() ;
        
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