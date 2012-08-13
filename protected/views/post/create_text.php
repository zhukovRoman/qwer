
<?php Yii::app()->clientScript->registerScriptFile("js/createpost.js", CClientScript::POS_END); ?>




<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id' => 'horizontalForm',
    'type' => 'horizontal span7',
        ));
?>

<fieldset>

    <legend> 
<?php echo ($model->isNewRecord) ? "Добавить" : "Редактировать"; ?> статью
    </legend>

    <div id="preview_div" style="display: none; 
         padding: 5px; 
         border-bottom: 1px solid gray; 
         margin-bottom: 5px;
         clear: both;">

    </div>


    <?php echo $form->textFieldRow($model, 'title', array('hint' => 'Заголовок должен быть наполнен смыслом, чтобы можно было понять, о чем будет топик.')); ?>
    <?php echo $form->textFieldRow($model, 'subtitle', array('hint' => 'подзаголовок должен более глубоко раскрывать смысл статей.')); ?>
    <?php
    echo $form->dropDownListRow($model, 'category_id', Post::getCategories(),
            //html options
            array('ajax' => array(
            'type' => 'POST',
            'url' => $this->createUrl('post/changeSubCat'),
            'update' => '#' . CHtml::activeId($model, 'sub_cat_id'),
            'success' => "js:function(data) {
                            if (data!=''){
                            
                            $('#subcat_row').show(10);
                            $('#" . CHtml::activeId($model, 'sub_cat_id') . "').empty();
                            $('#" . CHtml::activeId($model, 'sub_cat_id') . "').append(data);
                            }
                            else {
                                $('#" . CHtml::activeId($model, 'sub_cat_id') . "').empty();
                                $('#subcat_row').hide(10);
                             }                           
                            }",
            ))
    );
    ?>


    <div id="subcat_row" > 

<?php
echo $form->dropDownListRow($model, 'sub_cat_id', Post::getSubCategories($model->category_id)
);
?>

    </div>
    <hr>
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
                    'sizeLimit' => 10 * 1024 * 1024, // maximum file size in bytes
                    'minSizeLimit' => 5 * 1024, // minimum file size in bytes
                    'onComplete' => "js:function(id, fileName, responseJSON)
                        { 
                            //alert(responseJSON.filename); 
                            showCropImage(responseJSON.filename);

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
             <div  id="div_target" style="display:
                  <?php echo ($model->preview_url=='') ? 'none' : 'block' ?> ;" >
                 <div style=" padding-bottom: 5px;">  
                    <?php $this->widget('bootstrap.widgets.BootButton', array(
                        'label'=>'Обрезать',
                        'url'=>'#pictureLoad',
                        'type'=>'primary',
                        'size'=>'mini',
                        'htmlOptions'=>array('data-toggle'=>'modal',
                                            'id'=>'crop_button'),
                        )); ?>
                        
                        <?php $this->widget('bootstrap.widgets.BootButton', array(
                            'label'=>'Удалить',
                            'type'=>'danger', 
                            'size'=>'mini', 
                            'htmlOptions'=>array(
                                    'id' => 'del_preview_button',
                                    'ajax' => array(
                                                    'type'   => 'POST',
                                                    'data' => 'js:"params="+$("#target").attr("src")', // тут мы выбираем данные которые нужно передать.
                                                    'url'    => Yii::app()->createUrl('site/DeletePreview'),
                                                    'success'=>"js:function(data) {deletePicture();}",// при успехе экшена выполняется это.
                                                     )
                                                )
                        )); ?>
                     
                     
                  </div>
                 
                 <img src="<?php echo $model->preview_url; ?>" id="preview_post" style="max-width:400px; 
                                                max-height:400px;
                                                border: 1px solid;
                                                padding: 5px;">
                  
             </div>
            
             
             <p class="help-block">Картинка, которая будет главной в топике</p>
         </div>
     </div>   
   
    <?php 
                Yii::app()->clientScript->registerScriptFile("js/redactor/redactor/redactor.js", CClientScript::POS_END);
                Yii::app()->clientScript->registerScriptFile("js/fileuploader/uploader.js", CClientScript::POS_HEAD);
                Yii::app()->getClientScript()->registerCssFile('js/redactor/redactor/css/redactor.css');
                Yii::app()->getClientScript()->registerCssFile('css/fileuploader/uploader.css');
    ?>
    
    <?php echo $form->textAreaRow($model, 'text', array(' class'=>'span8', 'rows'=>25, 'id'=>"redactor")); ?>

    <?php //echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50,'id'=>"redactor")); ?>

    <?php echo $form->textFieldRow($model, 'tag', array('hint' => 'Теги, разделенные запятой. Например: fasd, asdf.')); ?>


    <script type="text/javascript">
        $(document).ready(
        function()
        {
			
            $('#redactor').redactor({ 
                imageUpload: 'index.php?r=site/RedactorUploadImage',
                //autoresize: true,
                cleanUp: true,
                removeClasses: true,
                removeStyles: true,
                css: 'docstyle.css'
            });
			
        }
    );
    </script>
</fieldset>

<div class="form-actions">
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'reset', 'icon' => 'remove', 'size' => 'small', 'label' => 'Отмена')); ?>
    <div style="float:right">
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => 'Предпросмотр',
        'type' => 'info',
        'icon' => 'eye-open',
        'size' => 'small',
        'htmlOptions' => array(
            'data-toggle' => 'modal',
            'ajax' => array(
                'type' => 'POST',
                'data' => 'js:"text="+encodeURIComponent($("#redactor").val())', // тут мы выбираем данные которые нужно передать.
                'url' => Yii::app()->createUrl('site/Tipograph'),
                'success' => "js:function(data) {show_preview(data);}", // при успехе экшена выполняется это.
        )),
    ));
    ?>

        <?php
        $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit',
            'type' => 'primary',
            'icon' => 'ok white',
            'size' => 'small',
            'label' => $model->isNewRecord ? 'Опубликовать' : 'Сохранить',
        ));
        ?>
    </div>
</div>

<?php $this->endWidget(); ?>


<?php
//Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.Jcrop.js");
Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.Jcrop.min.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.color.js", CClientScript::POS_END);

Yii::app()->getClientScript()->registerCssFile('js/jcrop/css/jquery.Jcrop.css');
?>
<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'pictureLoad')); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Создание превью</h3>
</div>

<div class="modal-body">

    <div  id="div_modal_target" >

        <img src="<?php echo ($model->preview_url != '') ?
        substr($model->preview_url, 0, strlen($model->preview_url) - 9) . ".jpg" : ''
?>" 
             id="target" 
             style=" 

             padding-bottom: 5px;">

    </div> 

    <div id="coords" style="display: none"></div>   

</div>
<div class="modal-footer">




    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => 'Перевернуть',
        'icon' => 'retweet',
        'type' => 'info',
        'size' => 'small',
        'htmlOptions' => array('data-toggle' => 'modal',
            'id' => 'change_ratio',
            'style' => 'float:left;'),
    ));
    ?>


    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'type' => 'primary',
        'label' => 'Обрезать',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal',
            'id' => 'append_crop',
            'ajax' => array(
                'type' => 'POST',
                'data' => 'js:"url="+$("#target").attr("src")+"&coord="+$("#coords").text()', // тут мы выбираем данные которые нужно передать.
                'url' => Yii::app()->createUrl('site/CropTopicPreview'),
                'success' => "js:function(data) {cropPreview();}", // при успехе экшена выполняется это.
        ))
            )
    );
    ?>

    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => 'Close',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal',
        ),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>