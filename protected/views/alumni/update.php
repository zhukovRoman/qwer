<?php
$this->breadcrumbs=array(
	'Alumnis'=>array('index'),
	$model->Name=>array('view','id'=>$model->AlumniID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Alumni','url'=>array('index')),
	array('label'=>'Create Alumni','url'=>array('create')),
	array('label'=>'View Alumni','url'=>array('view','id'=>$model->AlumniID)),
	array('label'=>'Manage Alumni','url'=>array('admin')),
);
?>

<h1>Update Alumni <?php echo $model->AlumniID; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>