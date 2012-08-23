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

function posterror ()
{
    notify('Ошибка! Попробуйте позже.', 'error');
}


function postfavsuccess(data)
{
    var resp = $.parseJSON(data);
  
    if (resp.status=='error')
    {
        notify(resp.description, 'error');
    }
    else 
    {
        if (resp.direction=='in')
        {    
            notify(resp.description, 'success');
        }
        else {
            notify(resp.description, 'warning');
        }
    }   
}

