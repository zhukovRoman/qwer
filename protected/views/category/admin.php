<?php $this->renderPartial ('/admin/header'); ?>
<legend>Категории</legend>
<?php $this->widget('bootstrap.widgets.BootButton', array(
        'type'=>'primary',
        'label'=>'Создать категорию',
        'url'=>Yii::app()->createUrl("/category/create"),
    )); ?>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'category-grid',
    'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'name',
		array 
            (
                'name' => "parent_id",
                'value' => '$data->getNameParent($data->id)',
                'sortable' => true,
            ),
		
		'order',
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
