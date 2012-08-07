<?php  Yii::app()->clientScript->registerScriptFile("js/jquery.hoverdir.js", CClientScript::POS_END);?>

<?php  Yii::app()->clientScript->registerScript(0, "$(function() {
    $('ul.items > li.main-view .inner').hoverdir();
  });", CClientScript::POS_END);?>

<?php
$this->breadcrumbs=array(
	'Posts',
);

$this->menu=array(
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h1>Posts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
  'itemsTagName'=>'ul'
/*  'template'=>'{items}'*/
)); ?>

