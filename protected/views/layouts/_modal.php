<!-- Модальное окно логина -->

<?php /** @var BootActiveForm $form */
      $this->
beginWidget('bootstrap.widgets.BootModal', array('id' => 'mydialog',));
      $model = new LoginForm;

    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
        'id'=>'login-form',
        'type'=>'horizontal',
      'enableClientValidation'=>true,
      'clientOptions'=>array(
          'validateOnSubmit'=>true,
      ),
      'action' => array('site/login'),
    )); 
     ?>
<div class="modal-header">
  <a class="close" data-dismiss="modal">&times;</a>
  <h3>Вход на сайт</h3>
</div>

<div class="modal-body">
  <fieldset>
    <p>
      Пожалуйста, заполните следующую форму для входа на наш портал!
    </p>
    <p>
      <span class="label label-info">Внимание!</span> <i>Поля, отмеченные звездочкой
        <span class="required">*</span>
        , обязательны для заполнения.</i> 
    </p>

    <?php echo $form->
    textFieldRow($model, 'username', array('hint' => CHtml::link(CHtml::encode("Зарегистрироваться"), array('account/signup')))); ?>
    <?php echo $form->
    passwordFieldRow($model,'password', array('hint' => CHtml::link(CHtml::encode("Забыли пароль?"), array('account/passrecovery')))); ?>
    <?php echo $form->checkBoxRow($model, 'rememberMe'); ?></fieldset>
</div>

<div class="modal-footer">
  <?php $this->
  widget('bootstrap.widgets.BootButton', array(
              'buttonType'=>'submit', 
              'type'=>'primary', 
              'icon'=>'ok white', 
              'label'=>'Войти'
              )
          ); ?>
</div>
<?php $this->
endWidget(); ?>
<?php $this->
endWidget(); ?>
<!-- Модальное окно Создания поста -->

<?php   $this->
beginWidget('bootstrap.widgets.BootModal', array('id' => 'postcreate',));
        $model = new LoginForm; ?>
<div class="modal-header">
  <a class="close" data-dismiss="modal">&times;</a>
  <h3>Создание</h3>
</div>

<div class="modal-body">

  <?php $this->
  widget('bootstrap.widgets.BootMenu', array(
        'type'=>'list',
        'items'=>array(
            array('label'=>'Статья', 'icon'=>'pencil', 'url'=> Yii::app()->createUrl('/post/create'),),
            array('label'=>'Видео', 'icon'=>'film', 'url'=>Yii::app()->createUrl('/post/createvideo')),
            array('label'=>'Фотоотчет', 'icon'=>'camera', 'url'=>Yii::app()->createUrl('/post/createphoto')),
        ),
    )); ?>
</div>

<div class="modal-footer">
  <?php $this->
  widget('bootstrap.widgets.BootButton', array(
            'icon'=>'remove', 
            'label'=>'Отмена',
            'type'=>'close',
              'htmlOptions'=>array('data-dismiss'=>'modal'),
          )); ?>
</div>

<?php
        $this->
endWidget();
    ?>