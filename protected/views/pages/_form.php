<?php
Yii::app()->clientScript->registerScriptFile("js/redactor/redactor/redactor.js", CClientScript::POS_END);
Yii::app()->getClientScript()->registerCssFile('js/redactor/redactor/css/redactor.css');
?>
<?php
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id' => 'pages-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textAreaRow($model, 'text', array('rows' => 20, 'cols' => 50, 'class' => 'span9', 'id' => 'redactor')); ?>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(
    function()
    {
        var buttons = ['html', '|', 'formatting', '|', 'bold', 'italic', '|',
            'unorderedlist', 'orderedlist', '|',
            'link', 'video','|', 
            'alignleft', 'aligncenter', 'alignright', 'justify', '|',
            'horizontalrule'];
        $('#redactor').redactor({ 
                               
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

