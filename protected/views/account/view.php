<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'view-form',
    'type'=>'horizontal',
)); ?>

<fieldset class="span8"> 
	<legend><?php echo $model->login; ?></legend>

<?php /* $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'Редактировать профиль', 'icon'=>'pencil', 'url'=>array('update', 'id'=>$model->id)),
    ),
));*/ ?>


<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills',  // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
       array('label'=>'Профиль', 'url'=>Yii::app()->
                                            createUrl('/account/view',
                                                                    array ('id'=>$model->id))),
        array('label'=>'Созданное', 'url'=>Yii::app()->
                                            createUrl('/account/created',
                                                                    array ('id'=>$model->id))),
        array('label'=>'Избранное','url'=>Yii::app()->
                                            createUrl('/account/fav',
                                                                    array ('id'=>$model->id))),
    	
    ),
)); ?>


<div class="span3">	

		<?php $path = Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME ; ?>
		<?php $new_path = Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::NEW_AVATAR_NAME ; ?>
		<?php if (!file_exists($path)) $src = Account::ACCOUNT_DIR . Account::DEFAULT_DIR . Account::AVATAR_NAME; else $src = $path ?>
		<img class="img-polaroid" src='<?php echo $src?>' style='width: 200px;' alt='Avatar'>
	<p>
		<?php if (Yii::app()->user->checkAccess('updateOwnAccount', array('Account' => $model)))
			$this->widget('bootstrap.widgets.BootMenu', array(
			    'type'=>'list',
			    'items'=>array(
			    	array('label'=>'Редактировать профиль', 'icon'=>'pencil', 'url'=>array('update', 'id'=>$model->id)),
			    	array('label'=>'Изменить фотографию', 'icon' => 'camera','url'=>'#AvatarLoad', 'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary'), 'items'=>array(
				        array('label'=>'Удалить фотографию', 'icon'=>'remove', 'url'=>'#AvatarDelete', 'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',), 'visible' => (file_exists($path))),
				        array('label'=>'Изменить миниатюру', 'icon'=>'move', 'url'=>'#UserPic', 'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',), 'visible' => (file_exists($path)),),
			    	)),
			    )
			)); ?>
</div>


<div class="span5">

<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php /* Формируем массивы для вывода информации о пользователе */

	// 1. Заголовок (фамилия и имя пользователя)
	$header = '';
	if ( ($model->last_name != '' ) or ($model->first_name != '') )
	{
		$header .= '<hr style="margin:0px;">';
		$header .= '<h1><em><small>' . $model->last_name.' '. $model->first_name . '</small></em></h1>';
		$header .= '<hr style="margin:0px;">';
		$header .= '<br>';
	}
	
	// 2. Личная информация
	$personal = array();	
	if (!empty($model->birth_date)) array_push($personal, //'birth_date');
		array(
			'label'=>$model->getAttributeLabel('birth_date'),
			'type'=>'raw',
			'value'=> Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($model->birth_date)),
		));
			
	if (!empty($model->city_id)) array_push($personal, 'city_id');
	if (isset($model->sex)) array_push($personal, //'sex'); 
		array(
				'label'=>$model->getAttributeLabel('sex'),
				'type'=>'raw',
				'value'=>$model->sex == 1 ? 'Мужской' : 'Женский',
		));
	
	if (!empty($model->about)) array_push($personal, 'about');
	
	// 3. Контактная информация
	function setValue($model, $service)
	{
		switch($service)
		{
			/* ----------------------------------------------- */
			case Account::SCENARIO_VKONTAKTE:
				$label = $model->getAttributeLabel('vk_url');
				$url = $model->vk_url;
				$service_id = $model->vk_id;
				
				break;
			/* ----------------------------------------------- */
			case Account::SCENARIO_FACEBOOK:
				$label = $model->getAttributeLabel('fb_url');
				$url = $model->fb_url;
				$service_id = $model->fb_id;		
				
				break;
			/* ----------------------------------------------- */
			case Account::SCENARIO_TWITTER:
				$label = $model->getAttributeLabel('tw_url');
				$url = $model->tw_url;
				$service_id = $model->tw_id;
				
				break;
			/* ----------------------------------------------- */
			case Account::SCENARIO_ODNOKLASSNIKI:
				$label = $model->getAttributeLabel('ok_url');
				$url = $model->ok_url;
				$service_id = $model->ok_id;
				
				break;
		}
		
		$properties = array();
		$properties['label'] = $label;
		$properties['type'] = 'raw';
		
		if (!empty($url))
		{
			$link = CHtml::link(substr($url, strrpos($url, '/')+1), $url);
			$properties['value'] =  $link;
			
			if (Yii::app()->user->checkAccess('updateOwnAccount', array('Account' => $model))) 
			{
				$icon = CHtml::link('<i class="icon-refresh"></i>', // Формировать!!!!!!!!
									Yii::app()->createUrl('account/linking/', array('id'=>$model->id, 'service' => $service)), 
									array('class' => 'update', 'rel'=> 'tooltip', 'data-original-title' => 'Изменить аккаунт')); // Формировать!!!!!!!! 
				
				$icon .= CHtml::link('<i class="icon-remove"></i>', // Формировать!!!!!!!!
									 Yii::app()->createUrl('account/unlinking/', array('id'=>$model->id, 'service' => $service)),
									 array('class' => 'delete', 'rel'=> 'tooltip', 'data-original-title' => 'Удалить аккаунт'));
				
				$properties['value'] =  $link . '<div style="float:right;">'.$icon.'</div>';
			}
		}
		else
		{
			if (Yii::app()->user->checkAccess('updateOwnAccount', array('Account' => $model)))
			{
				$link = CHtml::link('<i class="icon-magnet"></i> Привязать аккаунт',
									Yii::app()->createUrl('account/linking/', array('id'=>$model->id, 'service' => $service)));
			
				$properties['value'] =  $link;
			}
			else $properties['value'] =  '<span class="null">Не задан</span>';
		}
			
		return  $properties;
	}
	
	$contacts = array();
	
	// Почту могут видеть только администраторы
	if (Yii::app()->user->checkAccess('administrator'))
		if (!empty($model->mail)) array_push($contacts, 'mail');
	
	if (!empty($model->phone)) array_push($contacts, 'phone');
	array_push($contacts, setValue($model, Account::SCENARIO_VKONTAKTE));
	array_push($contacts, setValue($model, Account::SCENARIO_FACEBOOK));
	array_push($contacts, setValue($model, Account::SCENARIO_TWITTER));
	
	/*if (!empty($model->vk_url)) array_push($contacts, setValue($model, Account::SCENARIO_VKONTAKTE)); //'vk_url'); setValue($model, $service)
		/*	array(
					'label'=>$model->getAttributeLabel('vk_url'),
					'type'=>'raw',
					'value'=> setValue($model, Account::SCENARIO_VKONTAKTE), /*CHtml::link(substr($model->vk_url, strrpos($model->vk_url, '/')+1), $model->vk_url)
					//. CHtml::link(substr($model->vk_url, strrpos($model->vk_url, '/')+1), $model->vk_url, array('class' => 'icon-eye-open', 'icon' => 'magnet'))
					//. CHtml::button('Button Text', array('submit' => array('controller/action')))
					.'<a class="view" rel="tooltip" href="/cube/qwer/index.php?r=account/view&amp;id=99" data-original-title="Просмотреть"><i class="icon-eye-open"></i></a>'
					. CHtml::link('<i class="icon-eye-open"></i>', "/cube/qwer/index.php?r=account/view&amp;id=99", array('class' => 'view', 'rel'=> "tooltip", 'data-original-title' => 'Просмотреть'))
					. CHtml::link('<i class="icon-eye-open"></i>', "/cube/qwer/index.php?r=account/view&amp;id=99", array('class' => 'view', 'rel'=> "tooltip", 'data-original-title' => 'Просмотреть'))
					. '<a class="update" rel="tooltip" href="/cube/qwer/index.php?r=account/update&amp;id=99" data-original-title="Редактировать"><i class="icon-pencil"></i></a>'
			 ));*/
	/*else array_push($contacts, //'vk_url');
				array(
						'label'=>$model->getAttributeLabel('vk_url'),
						'type'=>'raw',
						'value'=> CHtml::link('Привязать аккаунт', Yii::app()->createUrl('account/linking/', 
												array('id'=>$model->id, 'service' => Account::SCENARIO_VKONTAKTE))),
				));
	
	if (!empty($model->fb_url)) array_push($contacts,// 'fb_url');
			array(
					'label'=>$model->getAttributeLabel('fb_url'),
					'type'=>'raw',
					'value'=> CHtml::link(substr($model->fb_url, strrpos($model->fb_url, '/')+1), $model->fb_url),
			));
	else array_push($contacts, //'fb_url');
			array(
					'label'=>$model->getAttributeLabel('fb_url'),
					'type'=>'raw',
					'value'=> CHtml::link('Привязать аккаунт', Yii::app()->createUrl('account/linking/',
							array('id'=>$model->id, 'service' => Account::SCENARIO_FACEBOOK))),
			));
	
	if (!empty($model->tw_url)) array_push($contacts,// 'tw_url');
			array(
					'label'=>$model->getAttributeLabel('tw_url'),
					'type'=>'raw',
					'value'=> CHtml::link(substr($model->tw_url, strrpos($model->tw_url, '/')+1), $model->tw_url)
			));
	else array_push($contacts, //'tw_url');
			array(
					'label'=>$model->getAttributeLabel('tw_url'),
					'type'=>'raw',
					'value'=> CHtml::link('Привязать аккаунт', Yii::app()->createUrl('account/linking/',
							array('id'=>$model->id, 'service' => Account::SCENARIO_TWITTER))),
			));

	if (!empty($model->ok_url)) array_push($contacts,// 'ok_url');
			array(
					'label'=>$model->getAttributeLabel('ok_url'),
					'type'=>'raw',
					'value'=> CHtml::link(substr($model->ok_url, strrpos($model->ok_url, '/')+1), $model->ok_url),
			));
	/*else array_push($contacts, //'ok_url');
			array(
					'label'=>$model->getAttributeLabel('ok_url'),
					'type'=>'raw',
					'value'=> CHtml::link('Привязать аккаунт', Yii::app()->createUrl('account/linking/',
							array('id'=>$model->id, 'service' => Account::SCENARIO_ODNOKLASSNIKI))),
			)); */
	
	// 4. Активность
	$activity = array();
	if (isset($model->rating))  array_push($activity, 'rating');
	if (!empty($model->register_date)) array_push($activity, //'register_date');
			array(
					'label'=>$model->getAttributeLabel('register_date'),
					'type'=>'raw',
					'value'=> Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($model->register_date)),//date('H:m d.m.Y', strtotime($model->register_date)),
			));
	if (!empty($model->last_login)) array_push($activity, //'last_login');
			array(
					'label'=>$model->getAttributeLabel('last_login'),
					'type'=>'raw',
					'value'=> Yii::app()->dateFormatter->format('HH:mm d MMMM yyyy', strtotime($model->last_login)),//date('H:m d.m.Y', strtotime($model->last_login)),
			));
?>

<?php /* Осуществляем вывод информации о пользователе */

	// 1. Заголовок (фамилия и имя пользователя)
	echo $header;	
?>

	<div id="profile_detail_view">
		<!--   <h4>Личная информация</h4> -->
		
		
		<!-- <i class="icon-user"></i> -->
		<h5>Личная информация</h5>
		<?php
		if (empty($personal)) 
		{
			if (Yii::app()->user->checkAccess('updateOwnAccount', array ('Account' => $model)))
			{
				$linkPersonal = Yii::app()->createUrl('account/update', array('id'=>$model->id));
				echo '<p align="center"><a href="'.$linkPersonal.'">Заполнить информацию о себе</a></p>';
			}
			else echo '<p align="center"><span class="null">Пользователь не заполнил информацию о себе</span></p>';
		}
		else 
		{
			$this->widget('bootstrap.widgets.BootDetailView',
			array(
				'data'=>$model,
				'attributes'=> $personal,
				)); 
		}
		?>
		
		<h5>Контакты</h5>
		<?php 
		if (empty($contacts)) 
		{
			if (Yii::app()->user->checkAccess('updateOwnAccount', array ('Account' => $model)))
			{
				$linkPersonal = Yii::app()->createUrl('account/update', array('id'=>$model->id));
				echo '<p align="center"><a href="'.$linkPersonal.'">Заполнить контактную информацию</a></p>';
			}
			else echo '<p align="center"><span class="null">Пользователь не заполнил информацию о себе</span></p>';
		}
		else 
		{
			$this->widget('bootstrap.widgets.BootDetailView',
			array(
				'data'=>$model,
				'attributes'=>$contacts,
				)); 
			}
		?>

		
		<h5>Активность</h5>
		<?php
			$this->widget('bootstrap.widgets.BootDetailView',
			array(
			'data'=>$model,
			'attributes'=>$activity,
			)); 
		?>
		
	</div>

</div>

</fieldset> 	 
<?php $this->endWidget(); ?>

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
	Yii::app()->clientScript->registerScriptFile("js/datepicker/js/bootstrap-datepicker.js");
	Yii::app()->getClientScript()->registerCssFile("js/datepicker/css/datepicker.css");
				
	Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.Jcrop.js");
	Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.color.js");
	Yii::app()->getClientScript()->registerCssFile('js/jcrop/css/jquery.Jcrop.css');
	//ntcn
	Yii::app()->clientScript->registerScriptFile("js/crop.js");
	Yii::app()->clientScript->registerScriptFile("js/fileuploader/jquery.fileupload.js");
	Yii::app()->clientScript->registerScriptFile("js/fileuploader/jquery.fileupload-ui.js");
	/*Yii::app()->getClientScript()->registerCssFile('css/fileuploader/jquery.fileupload-ui.css');*/
?>	

<!-- --------------------------------------------------------------------- -->
<!-- --------------------------------AvatarLoad--------------------------- -->
<!-- --------------------------------------------------------------------- -->

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'AvatarLoad')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Загрузка фотографии</h3>
</div>
 
<div class="modal-body">
	<div class="well">
		Вы можете загрузить фотографию. Поддерживаются форматы JPG, PNG и GIF.
	</div>

    <div id="UploadButton" style="align:center;">
	<?php
		$id = $model->id;
		$upload = new XUploadForm;
		$this->widget('ext.xupload.XUploadWidget', array(
			'url' => Yii::app()->createUrl('site/upload/', array('parent_id' =>$id ) ),
			'model' => $upload,
			'attribute' => 'file',
			'multiple' => false,
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
        'label'=>'Закрыть',
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
    <a class="close" data-dismiss="modal" onclick='jQuery("#AvatarLoad").modal({"show": true});'>&times;</a>
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

