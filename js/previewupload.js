 function showCropImage(url)
    {
        $("#target").attr("src",url);
        $("#preview_post").attr
                    ("src",url.substring(url.lenght-4)+"_crop.jpg");
        $("#Post_preview_url").val(url.substring(url.lenght-4)+"_crop.jpg");            
        $("#div_target").show(10);
        $(".qq-upload-list").text("");
        $("#uploadFileButton").hide(10);
        $("#widget").hide(10);
    }

    function deletePicture()
    {
        
        $("#target").attr("src","");
        $("#preview_post").attr("src","");
        $("#div_target").hide(10);
        $(".qq-upload-list").text("");
        $("#uploadFileButton").show(10);
        $("#Post_preview_url").val("");
        $("#widget").show(10);
        $("#Post_preview_url").val("");
 
    }
    
    function cropPreview()
    {
        
        $("#preview_post").attr("src",$("#preview_post").attr("src"));
        
    }
    
    
    $(document).ready(
	function()
	{
		$('#redactor').redactor();
	}
        );
    
    jQuery(function($){
	
	   // The variable jcrop_api will hold a reference to the
        // Jcrop API once Jcrop is instantiated.
        var jcrop_api;

        // In this example, since Jcrop may be attached or detached
        // at the whim of the user, I've wrapped the call into a function
        initJcrop();
        
        // The function is pretty simple
        function initJcrop()//{{{
        {
          // Hide any interface elements that require Jcrop
          // (This is for the local user interface portion.)
          
          // Invoke Jcrop in typical fashion
          $('#target').Jcrop({
                         onRelease: releaseCheck,
                         aspectRatio: 1.55,
                         minSize: [70, 45],
                         onSelect: showCoords,
                         onChange:showCoords 
                },function(){

                jcrop_api = this;
                jcrop_api.animateTo([0,0,70,45]);
           
          });

        };
        
        function showCoords(c)
        {
            // variables can be accessed here as
            // c.x, c.y, c.x2, c.y2, c.w, c.h
            var  a = jcrop_api.tellSelect();
            $("#coords").text(a.x + ' ' + a.y + ' ' + a.w + ' ' + a.h );
        };
        
        function releaseCheck()
        {
          jcrop_api.setOptions({ allowSelect: true });
        };
        
         $('#crop_button').click(function(e) {
                
                jcrop_api.setImage($("#target").attr("src"));
                jcrop_api.setOptions({ bgOpacity: .9 });
                jcrop_api.destroy();
                initJcrop();
                jcrop_api.destroy();
                initJcrop();
          
        });    
	 
        $('#del_preview_button').click(function(e) {
          // Destroy Jcrop widget, restore original state
          jcrop_api.destroy();
          jcrop_api.setImage("");
        });  
        
         
        $('#change_ratio').click(function(e) {
            if (jcrop_api.tellSelect().w > jcrop_api.tellSelect().h)
            { 
               jcrop_api.setOptions({
                        aspectRatio: 0.64,
                         minSize: [45, 70] });
            }
            else {
                 jcrop_api.setOptions({
                        aspectRatio: 1.55,
                         minSize: [70, 45] });
            }
            
            jcrop_api.focus();
        });  
        
        $('#pictureLoad').on('hidden', function () {
            
                
                jcrop_api.destroy();
                
                jcrop_api.setImage("");
                $("#target").attr("width", "");
                $("#target").attr("height", "");
                
        })
         
 });

