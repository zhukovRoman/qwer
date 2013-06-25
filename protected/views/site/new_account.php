<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm'); ?>
	 
<fieldset> 
	<legend>Привязка аккаунта</legend>
	
	<p><span class="label label-success">Спасибо!</span>
	Уважаемый пользователь! Имеете ли Вы уже на нашем сайте аккаунт? 
	
	<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.BootButton', array('type'=>'primary', 'icon'=>'magnet white', 
	    														  'label'=>'Да, привязать к моему аккаунту',
	    														  'url' => array('site/login', 'linkService' => $service), 
	'htmlOptions' => array( //'onclick' => //'echo "dsds"; die(); ' //Yii::app()->user->setFlash("success", "<strong>Well done!</strong> You successfully read this important alert message.") 
										//'js:alert("Уважаемый пользователь! Для того, чтобы привязать аккаунт к уже существующему, войдите в него");'
	    				) )); ?>
	  
	    <?php $this->widget('bootstrap.widgets.BootButton', array('type'=>'success', 'icon'=>'ok white', 
	    														  'label'=>'Нет, зарегистрировать меня', 
	    														  'url' => array('site/registration', 'service' => $service))); ?>
	</div>
</fieldset> 	 
<?php $this->endWidget(); ?>