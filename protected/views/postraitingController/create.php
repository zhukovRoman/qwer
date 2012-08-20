<?php
$this->breadcrumbs=array(
	'Postratings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Postrating','url'=>array('index')),
	array('label'=>'Manage Postrating','url'=>array('admin')),
);
?>

<h1>Create Postrating</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>