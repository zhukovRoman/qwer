<?php /** @var BootActiveForm $form */
	$this->beginWidget('bootstrap.widgets.BootModal', array(
		'id' => 'modal_new_account',
		'htmlOptions'=>array('class'=>'hide'),
		'events'=>array(
				'show'=>"js:function() { console.log('modal show.'); }",
				'shown'=>"js:function() { console.log('modal shown.'); }",
				'hide'=>"js:function() { console.log('modal hide.'); }",
				'hidden'=>"js:function() { console.log('modal hidden.'); }",
		),
	));
?>	

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm'); ?>

<div class="modal-header">
    	<a class="close" data-dismiss="modal">&times;</a>
		<h3>Привязка аккаунта</h3>
</div>

<div class="modal-body"> 
<fieldset> 
	<p><span class="label label-success">Спасибо!</span>
	Уважаемый пользователь! Имеете ли Вы уже на нашем сайте аккаунт?</p> 
</fieldset> 
</div>	

	<?php #echo $service; ?>
<div class="modal-footer">
	<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.BootButton', array('type'=>'primary', 'icon'=>'magnet white', 
	    														  'label'=>'Да, привязать к моему аккаунту',
	    														  'url' => array('site/login', 'linkService' => $service))); ?>
	  
	    <?php $this->widget('bootstrap.widgets.BootButton', array('type'=>'success', 'icon'=>'ok white', 
	    														  'label'=>'Нет, зарегистрировать меня', 
	    														  'url' => array('site/registration', 'service' => $service))); ?>
	</div>
</div>	 
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>	