<?php  Yii::app()->clientScript->registerScriptFile("js/jquery.hoverdir.js", CClientScript::POS_END);?>

<?php  Yii::app()->clientScript->registerScript(0, "$(function() {
    $('ul.items > li.main-view .main-view-top').hoverdir();
    $('.main-carousel').carousel();
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

<?php echo $this->renderPartial('_carousel', array('dataProvider'=>$dataProvider));?>