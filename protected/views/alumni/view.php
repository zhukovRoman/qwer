<?php
$this->breadcrumbs=array(
	'Alumnis'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List Alumni','url'=>array('index')),
	array('label'=>'Create Alumni','url'=>array('create')),
	array('label'=>'Update Alumni','url'=>array('update','id'=>$model->AlumniID)),
	array('label'=>'Delete Alumni','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->AlumniID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Alumni','url'=>array('admin')),
);
?>

<h1>View Alumni #<?php echo $model->AlumniID; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'AlumniID',
		'Name',
		'Forename',
		'Surname',
		'Workplace',
		'Mobile',
		'Email',
		'DepartmentID',
		'OtherEducation',
		'pass',
		'diplom',
		'status',
	),
)); ?>
