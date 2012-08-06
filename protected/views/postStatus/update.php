<?php
$this->breadcrumbs=array(
	'Post Statuses'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PostStatus', 'url'=>array('index')),
	array('label'=>'Create PostStatus', 'url'=>array('create')),
	array('label'=>'View PostStatus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PostStatus', 'url'=>array('admin')),
);
?>

<h1>Update PostStatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>