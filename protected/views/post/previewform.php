<div class="control-group ">
    <label class="control-label required" for="Post_title">
        Превью <span class="required">*</span>
    </label>
    <div style="display: none ">
        <?php echo $form->textFieldRow($model, 'preview_url'); ?>
    </div>
    <div class="controls">
        <div id="widget" style ="display: <?php echo ($model->preview_url != '') ? 'none' : 'block' ?> ">
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
                'id' => 'uploadFileButton',
                'config' => array(
                    'action' => Yii::app()->createUrl('site/uploadpreview'),
                    'allowedExtensions' => array("jpg"), //array("jpg","jpeg","gif","exe","mov" and etc...
                    'sizeLimit' => 7 * 1024 * 1024, // maximum file size in bytes
                    'minSizeLimit' => 5 * 1024, // minimum file size in bytes
                    'onComplete' => "js:function(id, fileName, responseJSON)
                        { 
                            //alert(responseJSON.filename); 
                            showCropImage(responseJSON.filename);

                        }",
                    'messages' => array(
                        'typeError' => "{file} has invalid extension. Only {extensions} are allowed.",
                        'sizeError' => "{file} is too large, maximum file size is {sizeLimit}.",
                        'minSizeError' => "{file} is too small, minimum file size is {minSizeLimit}.",
                        'emptyError' => "{file} is empty, please select files again without it.",
                        'onLeave' => "The files are being uploaded, if you leave now the upload will be cancelled."
                    ),
                    'showMessage' => "js:function(message){ alert(message); }"
                )
            ));
            ?>

        </div> 
        <div  id="div_target" style="display:
              <?php echo ($model->preview_url == '') ? 'none' : 'block' ?> ;" >
            <div style=" padding-bottom: 5px;">  
                <?php
                $this->widget('bootstrap.widgets.BootButton', array(
                    'label' => 'Обрезать',
                    'url' => '#pictureLoad',
                    'type' => 'primary',
                    'size' => 'mini',
                    'htmlOptions' => array('data-toggle' => 'modal',
                        'id' => 'crop_button'),
                ));
                ?>

                <?php
                $this->widget('bootstrap.widgets.BootButton', array(
                    'label' => 'Удалить',
                    'type' => 'danger',
                    'size' => 'mini',
                    'htmlOptions' => array(
                        'id' => 'del_preview_button',
                        'ajax' => array(
                            'type' => 'POST',
                            'data' => 'js:"params="+$("#target").attr("src")', // тут мы выбираем данные которые нужно передать.
                            'url' => Yii::app()->createUrl('site/DeletePreview'),
                            'success' => "js:function(data) {deletePicture();}", // при успехе экшена выполняется это.
                            'error' => "js:function(data) {deletePicture();}",
                        )
                    )
                ));
                ?>


            </div>

            <img src="<?php echo $model->preview_url; ?>" id="preview_post" class="photo-border">

        </div>


        <p class="help-block">Картинка, которая будет главной в топике</p>
    </div>
</div>   