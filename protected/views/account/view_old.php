<?php
$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Account', 'url'=>array('index')),
	//array('label'=>'Create Account', 'url'=>array('create')),
	array('label'=>'Update Account', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Account', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Account', 'url'=>array('admin')),
);
?>

<h1>View Account #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(//$model->safeAttributeNames  
		
		//'id',
		//'login',
		//'password',
		//'mail',
		'avatar_url',
		'first_name',
		'last_name',
		'sex',
		'country_id',
		'region_id',
		'city_id',
		'birth_date',
		'phone',
		'about',
		'status_id',
		'rating',
		'balance',
		//'register_date',
		//'last_login',
		//'user_ip',
		//'activate_key',
		//'newpass_key',
		//'referral',
		//'badge',
		'vk_url',
		'tw_url',
		//'post_count',
		//'comment_count',
		//'friend_count',
		//'subscribe_count',
		//'all_vote_count',
		//'positive_vote_count',
		//'new_msg_count',
		//'new_friend_count',
		
	),
)); ?>
	
