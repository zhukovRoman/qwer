<?php
$this->breadcrumbs=array(
	'Alumnis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Alumni','url'=>array('index')),
	array('label'=>'Manage Alumni','url'=>array('admin')),
);
?>

<h1>Create Alumni</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>