<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm'); ?>
	 
<fieldset> 
	<legend>Повторная активация аккаунта</legend>
	
	<br><p><span class="label label-important">Внимание!</span>
	Ваша учетная запись уже была активировна.</p>
	
	<?php echo CHtml::link(CHtml::encode("Вернуться на главную"), Yii::app()->baseUrl); ?>

</fieldset> 	 
<?php $this->endWidget(); ?>