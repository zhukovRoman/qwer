<?php /** @var BootActiveForm $form */
	$this->beginWidget('bootstrap.widgets.BootModal', array(
		'id' => 'modal_login',
		'htmlOptions'=>array('class'=>'hide'),
		'events'=>array(
				'show'=>"js:function() { console.log('modal show.'); }",
				'shown'=>"js:function() { console.log('modal shown.'); }",
				'hide'=>"js:function() { console.log('modal hide.'); }",
				'hidden'=>"js:function() { console.log('modal hidden.'); }",
		),
	));
	
	$model = new LoginForm;

$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'modal-login-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
			'validateOnChange'=>true,	
	),
	'action' => array('site/login'),
)); 
 ?>
	 
<div class="modal-header">
    	<a class="close" data-dismiss="modal">&times;</a>
		<h3>Добро пожаловать!</h3>
	</div>
	
<div class="modal-body"> 
<fieldset>
	<p>Пожалуйста, заполните следующую форму для входа на наш портал!</p>
	<p><span class="label label-info">Внимание!</span>
	<i>Поля, отмеченные звездочкой <span class="required">*</span>, обязательны для заполнения.</i></p>

	<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
		
	<?php echo $form->textFieldRow($model, 'username', array('hint' => CHtml::link(CHtml::encode("Зарегистрироваться"), array('account/signup')), 'tabindex' => '1' )); ?>
    <?php echo $form->passwordFieldRow($model,'password', array('hint' => CHtml::link(CHtml::encode("Забыли пароль?"), array('account/passrecovery')), 'tabindex' => '2' )); ?>
    <?php echo $form->checkBoxRow($model, 'rememberMe'); ?>
    
        <?php $this->widget('bootstrap.widgets.BootButton', array(
    		'buttonType'=>'submit', 
    		'type'=>'primary', 
    		'icon'=>'ok white', 
    		'label'=>'Войти',
        		
        	//'url' => array('site/login'),
    	)
    ); ?>
</fieldset> 	
</div> 

<div class="modal-footer">

    	
    <h4>Нажмите на иконку для входа через один из сайтов:</h4>
    <br>
	<?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login', 'popup' => true )); ?>
	
</div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>