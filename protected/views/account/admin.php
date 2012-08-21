<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>
	 
<fieldset> 
	<legend>Управление аккаунтами</legend>

<?php
$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Account','url'=>array('index')),
	array('label'=>'Create Account','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('account-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Accounts</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->



<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'account-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'login',
		//'password',
		'mail',
		//'avatar_url',
		//'first_name',
		//'last_name',
		//'sex',
		//'country_id',
		//'region_id',
		//'city_id',
		//'birth_date',
		//'phone',
		//'about',
		'status_id',
		'rating',
		'balance',
		//'register_date',
		//'last_login',
		'user_ip',
		//'activate_key',
		//'newpass_key',
		//'referral',
		//'badge',
		//'vk_url',
		//'tw_url',
		//'post_count',
		//'comment_count',
		//'friend_count',
		//'subscribe_count',
		//'all_vote_count',
		//'positive_vote_count',
		//'new_msg_count',
		//'new_friend_count',
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>

</fieldset> 
	 
<?php $this->endWidget(); ?>	
