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

function postvoteeror ()
{
    notify('Ошибка! Попробуйте позже.', 'error');
}


