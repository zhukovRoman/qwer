$(function($)
{
	// Holder for the API
	var jcrop_api;
	var new_jcrop_api;

	var boundx, boundy;
	var new_boundx, new_boundy;

	function init()
	{
		$('#target').Jcrop(
			{
				onChange: updatePreview,
				onSelect: updatePreview,
				onRelease: hidePreview,
				aspectRatio: 1,
				//setSelect: setCoordinates(),//[10,10,110,110],
			    minSize:[50,50]
			},
			function()
			{
				// Store the API in the jcrop_api variable
				jcrop_api = this;

				var bounds = this.getBounds();
			    boundx = bounds[0];
			    boundy = bounds[1];	    
			}
		);
	};

	function setCoordinates()
	{
		var coords = $('#сoordinates').text().split(";");
		return [parseInt(coords[2]), 
		        parseInt(coords[3]), 
		        parseInt(coords[2]) + parseInt(coords[0]), 
		        parseInt(coords[3]) + parseInt(coords[1])
		];
	}
	
    function hidePreview()
    {
       $('#preview').hide();
    };
	    
    function updatePreview(c)
    {
   		$('#preview').show();
    	 
     	if (parseInt(c.w) > 0)
      	{
        	var rx = 100 / c.w;
        	var ry = 100 / c.h;
        	$("#сoordinates").text(c.w + ';' +  c.h + ';' +  c.x + ';' +  c.y);
        	$('#preview').css(
    	    {
          		width: Math.round(rx * boundx) + 'px',
          		height: Math.round(ry * boundy) + 'px',
          		marginLeft: '-' + Math.round(rx * c.x) + 'px',
          		marginTop: '-' + Math.round(ry * c.y) + 'px'
        	});
      	}
	};

	$('#UserPic').on('show', function () 
	{
		//init();
		//jcrop_api.destroy();
		init();
		$('#target').attr('src', $('#target').attr('src'));
		$('#preview').attr('src', $('#preview').attr('src'));
		jcrop_api.setSelect(setCoordinates());
	});

	$('#UserPic').on('hide', function () 
	{
		jcrop_api.destroy();
	});
	
/* ----------------------------------------------*/
	
	function new_init()
	{
		$('#new_target').Jcrop(
			{
				onChange: newUpdatePreview,
				onSelect: newUpdatePreview,
				onRelease: newHidePreview,
				aspectRatio: 1,
				setSelect: [10,10,110,110],
			    minSize: [50,50]
			},
			function()
			{
				new_jcrop_api = this;

				var new_bounds = this.getBounds();
			    new_boundx = new_bounds[0];
			    new_boundy = new_bounds[1];   
		});
	};

    function newHidePreview()
    {
       $('#new_preview').hide();
    };
	    
    function newUpdatePreview(c)
    {
   		$('#new_preview').show();
    	 
     	if (parseInt(c.w) > 0)
      	{
        	var rx = 100 / c.w;
        	var ry = 100 / c.h;
        	$("#new_сoordinates").text(c.w + ';' +  c.h + ';' +  c.x + ';' +  c.y);
        	$('#new_preview').css(
    	    {
          		width: Math.round(rx * new_boundx) + 'px',
          		height: Math.round(ry * new_boundy) + 'px',
          		marginLeft: '-' + Math.round(rx * c.x) + 'px',
          		marginTop: '-' + Math.round(ry * c.y) + 'px'
        	});
      	}
	};

	$('#NewUserPic').on('show', function () 
	{	
		//init();
		//jcrop_api.destroy();
		$('#new_target').attr('src', $('#new_target').attr('src'));
		$('#new_preview').attr('src', $('#new_preview').attr('src'));
		new_init();


	});

	$('#NewUserPic').on('hide', function () 
	{
		new_jcrop_api.destroy();
	});
	 
});
