<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'window-login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
			'validateOnChange'=>true,
	),
	
	//'action' => array('site/login'),
)); ?>
	 
<fieldset> 
	<legend>Добро пожаловать!</legend>

	<p>Пожалуйста, заполните следующую форму для входа на наш портал!</p>
	<p><span class="label label-info">Внимание!</span>
	<i>Поля, отмеченные звездочкой <span class="required">*</span>, обязательны для заполнения.</i></p>

    <?php //echo $form->errorSummary($model)?>
    
    <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
    
	<?php echo $form->textFieldRow($model, 'username', array('hint' => CHtml::link(CHtml::encode("Зарегистрироваться"), array('account/signup')), 'tabindex' => '1')); ?>
    <?php echo $form->passwordFieldRow($model,'password', array('hint' => CHtml::link(CHtml::encode("Забыли пароль?"), array('account/passrecovery')), 'tabindex' => '2')); ?>
    <?php echo $form->checkBoxRow($model, 'rememberMe'); ?>
    
    <div class="form-actions">
    	<?php $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'submit', 
    			'type'=>'primary', 
    			'icon'=>'ok white', 
    			'label'=>'Войти',
    			
    			'url' => array('site/login', 'linkService' => $linkService),
    			)
    	); ?>
    	<br>
    	<h4>Нажмите на иконку для входа через один из сайтов:</h4>
    	<br>
		<?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login', 'popup' => true, 'linkService' => $linkService)); ?>
    </div>

</fieldset> 	 
<?php $this->endWidget(); ?>