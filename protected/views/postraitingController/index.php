<?php
$this->breadcrumbs=array(
	'Postratings',
);

$this->menu=array(
	array('label'=>'Create Postrating','url'=>array('create')),
	array('label'=>'Manage Postrating','url'=>array('admin')),
);
?>

<h1>Postratings</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
