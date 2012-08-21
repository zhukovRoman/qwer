<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'selectlogin-form',
	'type'=>'horizontal',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
	),
)); ?>

<fieldset> 
	<legend>Благодарим за регистрацию!</legend>
	

	<br><p><span class="label label-warning">Последний шаг!</span>
	Пожалуйста, подтвердите предложенный Вам логин или введите свой.</p>
	
	<?php echo $form->textFieldRow($model, 'login', array('hint'=>'Логин должен быть <a href="#" rel="tooltip" "placement=bottom"  title="Логин должен состоять из латинских букв и/или цифр, содержать от 6 до 30 символов и начинаться с буквы.">корректным</a>.')); ?>

    <div class="form-actions">
    	<?php $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'submit', 
    			'type'=>'primary', 
    			'icon'=>'ok white', 
    			'label'=>'Подтвердить логин'
    			)
    	); ?>
    </div>

</fieldset> 	 
<?php $this->endWidget(); ?>