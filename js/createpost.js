 function showCropImage(url)
    {
        
        var name = url.substring(0,url.length-4);
        $("#target").attr("src",url);
        $("#preview_post").attr
                    ("src",name+"_crop.jpg");
        $("#Post_preview_url").val(name+"_crop.jpg");            
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
   
   function sort()
   {
       $('#Post_code').val("");
       $('#Post_code').val($('#items').html());
   }
   
   function photoset_upload_compleate(item)
   {
       $('#items').append(item); 
       sort();
   }
   
   function del_photo_from_set(id)
   {
       //$('#'+id).remove();
      $('#'+id).remove();
      sort();
   }
   
   function show_preview(data)
   {
       $('#preview_div').show(10);
       $('#preview_div').html(data);
       window.scrollTo(0,100);
   }
   
    function cropPreview()
    {
        $("#preview_post").attr("src",$("#preview_post").attr("src"));
    }
    
    
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
                         minSize: [150, 90],
                         onSelect: showCoords,
                         onChange:showCoords 
                },function(){

                jcrop_api = this;
                jcrop_api.animateTo([0,0,150,90]);
           
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
          deletePicture();
        });  
        
         
        $('#change_ratio').click(function(e) {
            if (jcrop_api.tellSelect().w > jcrop_api.tellSelect().h)
            { 
               jcrop_api.setOptions({
                        aspectRatio: 0.64,
                         minSize: [90, 150] });
            }
            else {
                 jcrop_api.setOptions({
                        aspectRatio: 1.55,
                         minSize: [150, 90] });
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

