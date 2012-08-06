<?php 	
	Yii::app()->clientScript->registerScriptFile("js/datepicker/js/bootstrap-datepicker.js");
	Yii::app()->getClientScript()->registerCssFile("js/datepicker/css/datepicker.css");
				
	Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.Jcrop.js");
	Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.color.js");
	Yii::app()->getClientScript()->registerCssFile('js/jcrop/css/jquery.Jcrop.css');
	//ntcn
	Yii::app()->clientScript->registerScriptFile("js/crop.js");
?>

<h2><?php echo $model->login; ?></h2>

<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'Редактировать профиль', 'icon'=>'pencil', 'url'=>array('update', 'id'=>$model->id)),
    ),
)); ?>

<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Профиль', 'url'=>array('/site/login'), 'active'=>true),
        array('label'=>'Созданное', 'url'=>'#'),
        array('label'=>'Избранное', 'url'=>'#'),
    	array('label'=>'Подписки', 'url'=>'#'),
    ),
)); ?>




<div class="span3">	
	<div class="row">
		<?php $path = Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME ; ?>
		<?php $new_path = Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::NEW_AVATAR_NAME ; ?>
		<?php if (!file_exists($path)) $src = Account::ACCOUNT_DIR . Account::DEFAULT_DIR . Account::AVATAR_NAME; else $src = $path ?>				
		<?php echo "<img src='$src' style='width: 200px; '>"; ?>
	<p>
		<?php $this->widget('bootstrap.widgets.BootMenu', array(
		    'type'=>'list',
		    'items'=>array(
		    	array('label'=>'Изменить фотографию', 'url'=>'#', 'items'=>array(
			        array('label'=>'Загрузить аватар', 'icon'=>'home', 'url'=>'#AvatarLoad', 'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',)),
			        array('label'=>'Удалить аватар', 'icon'=>'book', 'url'=>'#AvatarDelete', 'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',), 'visible' => (file_exists($path))),
			        array('label'=>'Редактировать юзерпик', 'icon'=>'pencil', 'url'=>'#UserPic', 'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',), 'visible' => (file_exists($path)),),
		    	)),
		    )
		)); ?>
	</div>	
</div>


<div class="span4">

<div class="row">	

	<div id="profile_detail_view">
		<?php
			$this->widget('bootstrap.widgets.BootDetailView',
			array(
			'data'=>$model,
			'attributes'=>array(
				'last_name',
				'birth_date',
				'rating',
				),
			)); 
		?>
	</div>

	<div class="span1">
		<h5>Инфо</h5>
	</div>
	<div class="span3"> 
		<h3> <?php echo $model->last_name.' '. $model->first_name; ?> </h3>
	
	<div class="row">
		<div class="span3">
			<div class="row">
				<div class="span1">
					<?php if ($model->city_id != NULL) echo CHtml::encode($model->getAttributeLabel('city_id')); ?>
				</div>
				<div class="span2">
					<?php echo CHtml::encode($model->city_id); ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="span3">
			<div class="row">
				<div class="span1">
					<?php if ($model->sex != NULL) echo CHtml::encode($model->getAttributeLabel('sex')); ?>
				</div>
				<div class="span2">
					<?php if ($model->sex == 1) echo 'Мужской'; else echo 'Женский'; ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="span3">
			<div class="row">
				<div class="span1">
					<?php if ($model->birth_date != NULL) echo CHtml::encode($model->getAttributeLabel('birth_date')); ?>
				</div>
				<div class="span2">
					<?php echo CHtml::encode($model->birth_date); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="span3">
			<div class="row">
				<div class="span1">
					<?php if ($model->phone != NULL) echo CHtml::encode($model->getAttributeLabel('phone')); ?>
				</div>
				<div class="span2">
					<?php echo CHtml::encode($model->phone); ?>
				</div>
			</div>
		</div>
	</div>
		
	</div>
	


<div class="row">
	<div class="span1">
		<h5>Рейтинг</h5>
	</div>
	<div class="span3">
		<h2> <?php echo $model->rating; ?> </h2>
	</div>
</div>

<div class="row">
	<div class="span1">
		<h5>Аккаунты</h5>
	</div>
	<div class="row">
		<div class="span3">
			<div class="row">
				<div class="span3">
					<?php if ($model->vk_url == NULL && $model->tw_url == NULL) CHtml::link('Добавить аккаунты', array('update', 'id'=>$model->id)); ?>
				</div>
				<div class="span1">
					<?php if ($model->vk_url != NULL) echo CHtml::encode($model->getAttributeLabel('vk_url')); ?>
				</div>
				<div class="span2">
					<?php echo CHtml::link($model->vk_url, $model->vk_url); ?>
				</div>
			</div>
		</div>
	</div>
		<div class="row">
		<div class="span3">
			<div class="row">
				<div class="span1">
					<?php if ($model->tw_url != NULL) echo CHtml::encode($model->getAttributeLabel('tw_url')); ?>
				</div>
				<div class="span2">
					<?php echo CHtml::link($model->tw_url, $model->tw_url); ?>
				</div>
			</div>
		</div>
	</div>
</div>

</div>

</div>
<?php 
	/*
	$this->widget('bootstrap.widgets.BootDetailView', array(
    'data'=>array(
    		'id'=>1, 
    		'firstName'=>'Mark', 
    		'lastName'=>'Otto', 
    		'language'=>'CSS'),
		
    'attributes'=>array(
        array('name'=>'firstName', 'label'=>'First name'),
        array('name'=>'lastName', 'label'=>'Last name'),
        array('name'=>'language', 'label'=>'Language'),
    ),
));
*/
?>

<?php 
	/*
	$this->widget('zii.widgets.CDetailView', array(
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
)); 
*/
?>

<!-- --------------------------------------------------------------------- -->
<!-- --------------------------------AvatarLoad--------------------------- -->
<!-- --------------------------------------------------------------------- -->

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'AvatarLoad')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Загрузка аватара</h3>
</div>
 
<div class="modal-body">
    <div id="UploadButton">
	<?php
		$id = $model->id;
		$upload = new XUploadForm;
		$this->widget('ext.xupload.XUploadWidget', array(
			'url' => Yii::app()->createUrl('site/upload/', array('parent_id' =>$id ) ),
			'model' => $upload,
			'attribute' => 'file',
			'options'=>array(
				'onComplete' => 'js:function (event, files, index, xhr, handler, callBack) 
				{		
					jQuery("#NewUserPic").modal({"show": true});
					jQuery("#AvatarLoad").modal("hide");

				}'
			),
		));
	?>
	</div>
</div>
 

<div class="modal-footer">    
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Close',
        'url'=>'#',
    	'htmlOptions'=>array('data-dismiss'=>'modal',
    		'ajax' => array(
    				'type'   => 'POST',
    				'data'   => 'js:"params="+"reset"', 
    				'url'    => array('account/avatarload/','id'=>$model->id),
    				'success'=> 'js:function() {}', // при успехе экшена выполняется это.	
    		)
    	)
    )); ?>
</div>
 
<?php $this->endWidget(); ?>

<!-- --------------------------------------------------------------------- -->
<!-- --------------------------------UserPic--------------------------- -->
<!-- --------------------------------------------------------------------- -->

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'UserPic', )); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Изменение миниатюры</h3>
</div>
 
<div class="modal-body">	
	<?php echo "<img src='$path' id='target'  >"; ?>
	
	<div style="width: 100px; height: 100px; overflow: hidden; margin-left: 5px; float: right;">
		<?php echo "<img src='$path' id='preview' style='max-width:none;'>" ; ?>
	</div>

	<div id="сoordinates" style="display:none"> 
		<?php echo $model->avatar_url; ?>
	</div>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'type'=>'primary',
        'label'=>'Сохранить',
        'url'=>'#',
    	'htmlOptions'=>array('data-dismiss'=>'modal',
    			'id' => 'SaveUserpic',
    			'ajax' => array(
    					'type'   => 'POST',
    					'data' => 'js:"params="+$("#сoordinates").text()', // тут мы выбираем данные которые нужно передать.
    					'url'    => array('account/userpic/','id'=>$model->id),
    					'success'=>"js:function(data) {location.reload();}",// при успехе экшена выполняется это.alert(data);
    			)
    		)
    	)); ?>
    
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Отмена',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal',
        	'ajax' => array(
    				'type'   => 'POST',
    				'data'   => 'js:"params="+"reset"', 
    				'url'    => array('account/avatarload/','id'=>$model->id),
        			'success'=>'js:function() {}'
        		),
    		)
    )); ?>
</div>
 
<?php $this->endWidget(); ?>

<!-- --------------------------------------------------------------------- -->
<!-- --------------------------------NewUserPic--------------------------- -->
<!-- --------------------------------------------------------------------- -->

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'NewUserPic', )); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal" onclick="$('#NewUserPicClose').onclick ">&times;</a>
    <h3>Изменение миниатюры</h3>
</div>
 
<div class="modal-body">
	<?php echo "<img src='$new_path' id='new_target' style='width: 200px; '>"; ?>
	
	<div style="width: 100px; height: 100px; overflow: hidden; margin-left: 5px; float: right;">
		<?php echo "<img src='$new_path' id='new_preview' style='max-width:none;'>" ; ?>
	</div>
	
	<div id="new_сoordinates" style="display:none"> </div>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'type'=>'primary',
        'label'=>'Сохранить',
        'url'=>'#',
    	'htmlOptions'=>array('data-dismiss'=>'modal',
    			//'id' => 'SaveUserpic',
    			'ajax' => array(
    					'type'   => 'POST',
    					'data' => 'js:"params="+$("#new_сoordinates").text()', // тут мы выбираем данные которые нужно передать.
    					'url'    => array('account/userpic/','id'=>$model->id),
    					'success'=>"js:function() {location.reload();}",// при успехе экшена выполняется это.
    			)
    	)
    	)); ?>
    
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'id' => 'NewUserPicClose',
    	'label'=>'Отмена',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal',
        	'ajax' => array(
    				'type'   => 'POST',
    				'data'   => 'js:"params="+"reset"', 
    				'url'    => array('account/avatarload/','id'=>$model->id),
        			'success'=>'js:function() 
        			{					
        				jQuery("#NewUserPic").modal("hide");
        				jQuery("#AvatarLoad").modal({"show": true});	
					}'
        		),
    		)
    )); ?>
</div>
 
<?php $this->endWidget(); ?>

<!-- --------------------------------------------------------------------- -->
<!-- ------------------------------AvatarDelete--------------------------- -->
<!-- --------------------------------------------------------------------- -->

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'AvatarDelete')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Удаление аватара</h3>
</div>
 
<div class="modal-body">
	<p>Вы собираетесь удалить Ваш аватар. Подтвердите Ваше действие нажитием кнопки "Удалить" или отменете его нажатием кнопки "Отмена". </p>
</div>
 

<div class="modal-footer">

    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'type'=>'primary',
        'label'=>'Удалить аватар',
        'url'=> '#',
    	'htmlOptions'=>array('data-dismiss'=>'modal',
    			'ajax' => array(
    					'type'   => 'POST',
    					//'data' => 'js:"params="+$("#hidden").text()', // тут мы выбираем данные которые нужно передать.
    					'url'    => array('account/avatardelete/','id'=>$model->id),
    					'success'=>"js:function() {location.reload();}",// при успехе экшена выполняется это.
    			)
    		)
    )); ?>
    
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Отмена',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>

