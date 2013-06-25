<?php echo CHtml::decode($model->text); ?>
<div class="clearfix"></div>
<?php
if (Yii::app()->user->checkAccess('pagesManage')) {

    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => 'Редактировать',
        'type' => 'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size' => 'mini',
        'icon' => 'pencil', // '', 'large', 'small' or 'mini'
        'url' => array('update', 'id' => $model->id),
    ));
}
?>
