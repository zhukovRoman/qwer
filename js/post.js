function postvotesuccess(data)
{
    var resp = $.parseJSON(data);
  
    if (resp.status=='error')
    {
        notify(resp.description, 'error');
    }
    else 
    {
        notify(resp.description, 'success');
        $('.icon-star').html(resp.code);
        $('.post-rating').hide();
    }
}

function poll_success(data)
{
    var resp = $.parseJSON(data);
  
    if (resp.status=='error')
    {
        notify(resp.description, 'error');
    }
    else 
    {
        window.location.reload(); 
    }
}

poll_error()
{
    notify('Ошибка! Попробуйте позже.', 'error');
}


function posterror (){
    notify('Ошибка! Попробуйте позже.', 'error');
}


function postfavsuccess(data){
    var resp = $.parseJSON(data);
     _this = $('.icon-heart');
    if (resp.status=='error'){
        notify(resp.description, 'error');
    } else {
        if (resp.direction=='in'){    
            _this.addClass('gray-a');
            _this.removeClass('green-a');
            var i = _this.html();
            i++;
            _this.html(i);

            notify(resp.description, 'success');
        } else {
            _this.removeClass('gray-a');
            _this.addClass('green-a');
            var i = _this.html();
            i--;
            _this.html(i);

            notify(resp.description, 'warning');
        }
    }   
}

