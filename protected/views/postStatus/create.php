<?php
$this->breadcrumbs=array(
	'Post Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PostStatus', 'url'=>array('index')),
	array('label'=>'Manage PostStatus', 'url'=>array('admin')),
);
?>

<h1>Create PostStatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>