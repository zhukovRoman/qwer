<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'account-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
)); ?>
	 
<fieldset> 
	<legend>Восстановление пароля</legend>

	<br><p>Пожалуйста, введите адрес Вашей электронной почты.</p>

	<?php echo $form->textFieldRow($model, 'mail'); ?>

    <div class="form-actions">
    	<?php $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'submit', 
    			'type'=>'primary', 
    			'icon'=>'envelope white', 
    			'label'=>'Получить ссылку на восстановление пароля'
    			)
    	); ?>
    </div>

</fieldset> 	 
<?php $this->endWidget(); ?>
