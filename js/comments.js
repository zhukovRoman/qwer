

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
     $('#comment-form').appendTo($('.def-pos-form'));
     $('.parent_id_form').val(0);
     $("#Comment_text").val("");
     var resp = $.parseJSON(data);
     if (resp.status=='error')
         {
             flashError (resp.description);
         }
    else 
        {
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
   
 }