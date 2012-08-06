<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm'); ?>
	 
<fieldset> 
	<legend>Восстановление пароля</legend>
	
	<br><p><span class="label label-success">Спасибо!</span>
	Ссылка для восстановления пароля отправлена на адрес Вашей электронной почты.</p>
	
	<?php echo CHtml::link(CHtml::encode("Вернуться на главную"), Yii::app()->baseUrl); ?>

</fieldset> 	 
<?php $this->endWidget(); ?>