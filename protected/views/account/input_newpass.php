<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'input_newpass-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
)); ?>
	 
<fieldset> 
	<legend>Изменение пароля</legend>

	<br><p>Пожалуйста, введите новый пароль для доступа к Вашему аккаунту.</p>

	<?php echo $form->passwordFieldRow($model,'password', array('hint'=>'Длина пароля должна быть от 6 до 30 символов.')); ?>

    <div class="form-actions">
    	<?php $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'submit', 
    			'type'=>'primary', 
    			'icon'=>'lock white', 
    			'label'=>'Сохранить новый пароль'
    			)
    	); ?>
    </div>

</fieldset> 	 
<?php $this->endWidget(); ?>