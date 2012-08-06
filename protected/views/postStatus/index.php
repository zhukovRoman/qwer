<?php
$this->breadcrumbs=array(
	'Post Statuses',
);

$this->menu=array(
	array('label'=>'Create PostStatus', 'url'=>array('create')),
	array('label'=>'Manage PostStatus', 'url'=>array('admin')),
);
?>

<h1>Post Statuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
