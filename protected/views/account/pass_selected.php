<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm'); ?>
	 
<fieldset> 
	<legend>Изменение пароля</legend>
	
	<br><p><span class="label label-success">Поздравляем!</span>
	Пароль успешно изменен! Теперь Вы можете войти на сайт, используя новый пароль.</p>
	
	<?php echo CHtml::link(CHtml::encode('Войти на сайт'), array('site/login')); ?>

</fieldset> 	 
<?php $this->endWidget(); ?>