<?php Yii::app()->clientScript->registerScriptFile("js/createpost.js", CClientScript::POS_END); ?>
<?php
Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.Jcrop.min.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.color.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile("js/redactor/redactor/redactor.js", CClientScript::POS_END);
Yii::app()->getClientScript()->registerCssFile('js/redactor/redactor/css/redactor.css');
Yii::app()->getClientScript()->registerCssFile('js/jcrop/css/jquery.Jcrop.css');
Yii::app()->clientScript->registerScriptFile("js/fileuploader/uploader.js", CClientScript::POS_HEAD);
Yii::app()->getClientScript()->registerCssFile('css/fileuploader/uploader.css');
Yii::app()->clientScript->registerScriptFile("js/fileuploader/jquery.damnUploader.js", CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile("js/uploadphoto.js", CClientScript::POS_HEAD);
?>

<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id' => 'createpost-form',
    'type' => 'horizontal span7',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnChange' => true,
    #'validateOnSubmit'=>false,
    )
        ));
?>

<fieldset>

    <legend> 
        <?php echo ($model->isNewRecord) ? "Добавить" : "Редактировать"; ?> 
        <?php
        if ($model->is_video) {
            echo "видео";
        }
        ?>
        <?php
        if ($model->is_photoset) {
            echo "фотосет";
        }
        ?>
        <?php
        if (!$model->is_photoset && !$model->is_video) {
            echo "статью";
        }
        ?>
    </legend>

    <div id="preview_div" style="display: none; 
         padding: 5px; 
         border-bottom: 1px solid gray; 
         margin-bottom: 5px;
         clear: both;">

    </div>
    <?php
    $this->renderPartial('formFirstRows', array('model' => $model,
        'form' => $form));
    ?>
    <?php
    $this->renderPartial('previewform', array('model' => $model,
        'form' => $form));
    ?>
    <?php
    $this->renderPartial('differforms', array('model' => $model,
        'form' => $form));
    ?>

    <?php
    echo $form->textFieldRow($model, 'tag', array(
        'class' => 'span5',
        'hint' => 'Теги, разделенные запятой. Например: fasd, asdf.'
    ));
    ?>

</fieldset>

<div class="form-actions span7" style="padding-left: 10px;">
    <div style="float:left;">
    <?php
        $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit',
        'type' => 'inverse',
        'icon' => 'file white',
        'size' => 'small',
        'label' => 'В черновики' ,
         'htmlOptions' => array(
                'name'=>'archive',
                ),
    ));
    ?>
  </div>
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
            'htmlOptions' => array('class'=>'publish-btn'),
            'icon' => 'ok white',
            'size' => 'small',
            'label' => 'На модерацию',
            'htmlOptions' => array(
                'name'=>'approve',
                'id'=>'submit-btn',
                ),
        ));
        ?>
        
    </div>
</div>

<?php $this->endWidget(); ?> 



<?php
$this->renderPartial('modalcrop', array('model' => $model,
    'form' => $form));
?>
