<?php 	$this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'mydialog',));
		$model = new LoginForm; ?>

<div class="modal-header">
    	<a class="close" data-dismiss="modal">&times;</a>
    	<h3>Вход на сайт</h3>
</div>
 
<fieldset
  class="control-group error">
    <?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
			),
		'action' => array('site/login'),
	)); ?>          
      
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div>
		<?php //echo $form->labelEx($model,'username'); ?>
		<?php //echo $form->textField($model,'username'); ?>
		<?php //echo $form->error($model,'username'); ?>
		<?php echo $form->textFieldRow($model, 'username'); ?>

		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.
		</p>
	</div>

	<div>
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
	
	<div>
		<?php echo CHtml::link(CHtml::encode("Забыли пароль?"), array('account/passrecovery')); #array('user/recovery'))?>
	</div>
	
</fieldset>
 
<div class="modal-footer">
    	<?php $this->widget('bootstrap.widgets.BootButton', array(
		    'buttonType'=>'submit', 
		    'icon'=>'arrow-right', 
		    'label'=>'Войти',
		    'type'=>'primary',
      	 	// 'htmlOptions'=>array('data-dismiss'=>'modal'),
    	)); ?>
</div>
                
<?php
    $this->endWidget();
    $this->endWidget();
?>