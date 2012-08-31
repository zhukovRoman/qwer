
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>
 
<fieldset>
 
    <legend>Legend</legend>
 
    <?php
         $items = UserStatus::model()->findAll();
         $arr = array();
         foreach ($items as $i)
         {
             $arr[$i->id]= $i->name;
         }
        echo $form->dropDownListRow($model, 'status_id', $arr);
?>
    
 
</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
</div>
 
<?php $this->endWidget(); ?>