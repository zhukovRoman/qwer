<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'account-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
	),
)); ?>
	 
<fieldset> 
	<legend>Регистрация</legend>

	<p>Пожалуйста, заполните следующую форму для регистрации на нашем портале!</p>
	<p><span class="label label-info">Внимание!</span>
	<i>Поля, отмеченные звездочкой <span class="required">*</span>, обязательны для заполнения.</i></p>

 	<?php //echo 'Шаг 1 из 3'; ?>

    <?php //echo $form->errorSummary($model)?>

	<?php echo $form->textFieldRow($model, 'mail', array('hint'=>'Адрес электронной почты должен быть <a href="#" rel="tooltip" title="Должен быть действительным и иметь следующий вид: example@example.ru.">корректным</a>.', 'tabindex'=> '1')); ?>
    <?php echo $form->passwordFieldRow($model,'password', array('hint'=>'Длина пароля должна быть от 6 до 30 символов.', 'tabindex'=> '2')); ?>


    <div class="form-actions">
    	<?php $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'submit', 
    			'type'=>'primary', 
    			'icon'=>'ok white', 
    			'label'=>'Зарегистрироваться'
    			)
    	); ?>
    </div>

</fieldset> 	 
<?php $this->endWidget(); ?>
