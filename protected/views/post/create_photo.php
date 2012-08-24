    <div style="display:none;">
        <?php echo $form->textAreaRow($model, 'code', array(' class'=>'span5', 'rows'=>10)); ?>
    </div>
   <div class="control-group">
         <label class="control-label required" >
             Фото: <span class="required">*</span>
         </label>
         <div class="controls">
            <div id="widget_photoset" >
            <?php  
                $this->widget('ext.EAjaxUpload.EAjaxUpload',
                    array(
                    'id'=>'uploadphotoset',
                    'config'=>array(
                        'multiple'=>true,
                        'action'=>Yii::app()->createUrl('post/photoItemUpload'),
                        'allowedExtensions'=>array("jpg", "jpeg"),//array("jpg","jpeg","gif","exe","mov" and etc...
                        'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                        'minSizeLimit'=>5*1024,// minimum file size in bytes
                        'onComplete'=>"js:function(id, fileName, responseJSON)
                            { 
                               photoset_upload_compleate(responseJSON.code);
                            }",
                        'messages'=>array(
                                            'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                            'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                            'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                            'emptyError'=>"{file} is empty, please select files again without it.",
                                            'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                            ),
                        'showMessage'=>"js:function(message){ alert(message); }"
                        )
                    )); ?> 
            </div>
             <div id="all_photos">
                <?php  
                   
                    $this->widget('zii.widgets.jui.CJuiSortable', array(
                        'id'=>'photo-items',
                        'items'=>$model->getPhotos(),
                        // additional javascript options for the accordion plugin
                        'options'=>array(
                                    'delay'=>10,
                                    'update'=>"js:function(){sort ();}",
                            ), 
                        
                    ));

                 ?>     
        
             </div>
         </div>
    </div>
    <hr>
    
    <?php echo $form->textAreaRow($model, 'text', array(' class'=>'span8', 'rows'=>10, 'id'=>"redactor")); ?>
    
    <script type="text/javascript">
    $(document).ready(
        function()
        {
            var buttons = ['html', '|', 'formatting', '|', 'bold', 'italic', '|',
                                            'unorderedlist', 'orderedlist', '|',
                                            , 'link', '|', 
                                            'alignleft', 'aligncenter', 'alignright', 'justify', '|',
                                            'horizontalrule'];
                        $('#redactor').redactor({ 
                                imageUpload: 'index.php?r=site/RedactorUploadImage',
                                //autoresize: true,
                                cleanUp: true,
                                buttons: buttons,
                                removeClasses: true,
                                removeStyles: true,
                                css: 'docstyle.css'
                            });
            
        }
    );
    </script>
