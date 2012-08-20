<?php
$this->breadcrumbs=array(
	'Postratings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Postrating','url'=>array('index')),
	array('label'=>'Create Postrating','url'=>array('create')),
	array('label'=>'Update Postrating','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Postrating','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Postrating','url'=>array('admin')),
);
?>

<h1>View Postrating #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'author_id',
		'post_id',
		'time_add',
		'delta',
	),
)); ?>
