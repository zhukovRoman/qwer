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
        $('#post-rating').html(resp.code);
    }
}

function posterror (){
    notify('Ошибка! Попробуйте позже.', 'error');
}


function postfavsuccess(data){
    var resp = $.parseJSON(data);
    if (resp.status=='error'){
        notify(resp.description, 'error');
    } else {
        if (resp.direction=='in'){    
            _this = $('.icon-heart');
            _this.addClass('gray-a');
            _this.removeClass('black-a');
            var i = _this.html();
            i++;
            _this.html(i);

            notify(resp.description, 'success');
        } else {
            _this.removeClass('gray-a');
            _this.addClass('black-a');
            var i = _this.html();
            i--;
            _this.html(i);

            notify(resp.description, 'warning');
        }
    }   
}

