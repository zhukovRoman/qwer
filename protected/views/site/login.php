<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
)); ?>
	 
<fieldset> 
	<legend>Вход на сайт</legend>

	<br><p>Пожалуйста, заполните следующую форму для входа на наш портал!</p>
	<p><span class="label label-info">Внимание!</span>
	<i>Поля, отмеченные звездочкой <span class="required">*</span>, обязательны для заполнения.</i></p>

    <?php echo $form->errorSummary($model)?>

	<?php echo $form->textFieldRow($model, 'username', array('hint' => CHtml::link(CHtml::encode("Зарегистрироваться"), array('account/signup')))); ?>
    <?php echo $form->passwordFieldRow($model,'password', array('hint' => CHtml::link(CHtml::encode("Забыли пароль?"), array('account/passrecovery')))); ?>
    <?php echo $form->checkBoxRow($model, 'rememberMe'); ?>
    
    <div class="form-actions">
    	<?php $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'submit', 
    			'type'=>'primary', 
    			'icon'=>'ok white', 
    			'label'=>'Войти'
    			)
    	); ?>
    </div>

</fieldset> 	 
<?php $this->endWidget(); ?>