<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id' => 'horizontalForm',
    'type' => 'horizontal',
        ));
?>

<fieldset>

    <legend><?php echo ($model->isNewrecord)? "Создать категорию" : "редактировать категорию"; ?> </legend>

    <?php echo $form->textFieldRow($model, 'name'); ?>
    <?php
    $data = Post::getCategories();
    $data[0] = 'Без родителя';
    echo $form->dropDownListRow($model, 'parent_id', $data);
    ?>
<?php echo $form->textAreaRow($model, 'description', array('class' => 'span6', 'rows' => 5)); ?>
<?php echo $form->textFieldRow($model, 'order'); ?>


</fieldset>

<div class="form-actions">
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok white', 'label' => 'Сохранить')); ?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => 'Reset')); ?>
</div>

<?php $this->endWidget(); ?>