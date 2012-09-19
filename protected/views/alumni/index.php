<?php
$this->breadcrumbs=array(
	'Alumnis',
);

$this->menu=array(
	array('label'=>'Create Alumni','url'=>array('create')),
	array('label'=>'Manage Alumni','url'=>array('admin')),
);
?>

<h1>Alumnis</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
