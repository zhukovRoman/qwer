    <div style="display:none;">
        <?php echo $form->textAreaRow($model, 'code', array(' class'=>'span5', 'rows'=>10)); ?>
    </div>
   <div class="control-group ">
         <label class="control-label required" >
             Фото: <span class="required">*</span>
         </label>
         <div class="controls">
            <div id="widget_photoset" >
                
                <!-- загрузчик -->
            
            <div id="img-container">    
            </div>
            <div class="form-photo">
                    <input type="file" name="my-pic" id="file-field" />
            </div>
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
    <a id="upload-all" class="btn">Завершить выбор фото</a>
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
