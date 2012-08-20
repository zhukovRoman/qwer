<?php
$this->breadcrumbs=array(
	'Postratings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Postrating','url'=>array('index')),
	array('label'=>'Create Postrating','url'=>array('create')),
	array('label'=>'View Postrating','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Postrating','url'=>array('admin')),
);
?>

<h1>Update Postrating <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>