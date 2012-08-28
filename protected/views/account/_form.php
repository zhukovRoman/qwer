<?php 	
	Yii::app()->clientScript->registerScriptFile("js/datepicker/js/bootstrap-datepicker.js");
	Yii::app()->getClientScript()->registerCssFile("js/datepicker/css/datepicker.css");
				
	Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.Jcrop.js");
	Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.color.js");
	Yii::app()->getClientScript()->registerCssFile('js/jcrop/css/jquery.Jcrop.css');
	//ntcn
	Yii::app()->clientScript->registerScriptFile("js/crop.js");
?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>false,
			'validateOnChange'=>true,
	),
)); ?>
	 
<fieldset> 
	<legend>Редактирование профиля</legend>
	    
	<?php $path = Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME ; ?>
	<?php $new_path = Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::NEW_AVATAR_NAME ; ?>
	<?php if (!file_exists($path)) $src = Account::ACCOUNT_DIR . Account::DEFAULT_DIR . Account::AVATAR_NAME; else $src = $path ?>		

		
	  
	<br>
	 	<?php echo $form->textFieldRow($model, 'first_name'); ?>
	 	<?php echo $form->textFieldRow($model, 'last_name'); ?>
	 	<?php echo $form->radioButtonListRow($model, 'sex', array(1 => 'Мужской', 0 => 'Женский')); ?>
  
		<div class="control-group">
			<label class="control-label"> <?php echo $model->getAttributeLabel('phone'); ?></label>
			<div class="controls">	 
				<span id ="dateselect">
	            <?php $this->widget('CMaskedTextField',array(
        			'model' => $model,
        			'attribute' => 'phone',
        			'mask'=>'+7(999)999-9999',
	            )); ?> 
				</span>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label"> <?php echo $model->getAttributeLabel('birth_date'); ?></label>
			<div class="controls">	 
				<span id ="dateselect">
					<?php $this->widget('ext.ActiveDateSelect', array(
				   		'model'=>$model,
				      	'attribute'=>'birth_date',
				      	'reverse_years'=>true,
				      	'field_order'=>'DMY',
				      	'start_year'=>1910,
					  	'field_separator' => '&nbsp;&nbsp;',
				      	'end_year'=>date("Y",time()),
				    	)
					); ?>
				</span>
			</div>
		</div>
	    
	    	    <?php  //$this->widget( 'ext.EChosen.EChosen' ); ?>
	    
	     
	     <?php /*$this->widget( 'ext.EChosen.EChosen', array(
			  'target' => 'select',
			  'useJQuery' => false,
			  'debug' => true,
			));*/ ?>
	    
<!-- 	    <div class="control-group ">
	    	<label class="control-label" for="Account_phone">Phone</label>
	    	<div class="controls">
	    		<input class="span2" mask="+7(999)999-9999" name="Account[phone]" id="Account_phone" type="text" maxlength="17" value="+7(925)727-6774">
	    	</div>
	    </div> -->
	    
        <?php // echo $form->labelEx($model, 'phone'); ?><!-- : -->

	    
	 <!--   <br><br>
	    <?php /*$this->widget('bootstrap.widgets.BootTypeahead', array(
		    'options'=>array(
		        'source'=>array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Dakota', 'North Carolina', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'),
		        'items'=>4,
		        'matcher'=>"js:function(item) {
		            return ~item.toLowerCase().indexOf(this.query.toLowerCase());
		        }",
		    ),
		)); */?>
		<p> --> 
	    
	    <?php //echo $form->MaskTextField($model, 'phone', array('class'=>'span2', 'mask'=>'+7(999)999-9999')); ?>
	    
	    <?php /*$this->widget('bootstrap.widgets.BootDetailView', array(
		    		'data'=> $model,
		    		'attributes'=> array(
		    				array(
		    						'label'=>$model->getAttributeLabel('vk_url'),
		    						'type'=>'raw',
		    						'value'=> CHtml::link(substr($model->fb_url, strrpos($model->fb_url, '/')+1), $model->fb_url),
		    				),
		    				array(
		    						'label'=>$model->getAttributeLabel('fb_url'),
		    						'type'=>'raw',
		    						'value'=> CHtml::link(substr($model->fb_url, strrpos($model->fb_url, '/')+1), $model->fb_url),
		    				),
		    				array(
		    						'label'=>$model->getAttributeLabel('fb_url'),
		    						'type'=>'raw',
		    						'value'=> CHtml::link(substr($model->fb_url, strrpos($model->fb_url, '/')+1), $model->fb_url),
		    				),
		    				array(
		    						'label'=>$model->getAttributeLabel('fb_url'),
		    						'type'=>'raw',
		    						'value'=> CHtml::link(substr($model->fb_url, strrpos($model->fb_url, '/')+1), $model->fb_url),
		    				),	
		    		),
		    	));
	    */ ?>
	    
<!--  	    <div class="control-group">
			<label class="control-label"> <?php /* echo $model->getAttributeLabel('vk_url'); ?></label>
			<div class="controls">	 
				<?php 
				if (!empty($model->vk_id)) 
				{
					echo CHtml::link(substr($model->vk_url, strrpos($model->vk_url, '/')+1), $model->vk_url);
					$this->widget('bootstrap.widgets.BootButton', array(
										'label'=>'Обновить', 'type'=>'success', 'icon' => 'refresh',
										'url' => Yii::app()->createUrl('account/linking/', 
												array('id'=>$model->id, 'service' => Account::SCENARIO_VKONTAKTE))));}
				else
				{
					$this->widget('bootstrap.widgets.BootButton', array(
										'label'=>'Привязать', 'type'=>'success', 'icon' => 'magnet',
										'url' => Yii::app()->createUrl('account/linking/', 
												array('id'=>$model->id, 'service' => Account::SCENARIO_VKONTAKTE))));
				}
				?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label"> <?php echo $model->getAttributeLabel('fb_url'); ?></label>
			<div class="controls">	 
				<?php 
				if (!empty($model->fb_id)) 
				{
					echo CHtml::link(substr($model->fb_url, strrpos($model->fb_url, '/')+1), $model->fb_url);
					$this->widget('bootstrap.widgets.BootButton', array(
										'label'=>'Обновить', 'type'=>'success', 'icon' => 'refresh',
										'url' => Yii::app()->createUrl('account/linking/', 
												array('id'=>$model->id, 'service' => Account::SCENARIO_FACEBOOK))));
				}
				else
				{
					$this->widget('bootstrap.widgets.BootButton', array(
										'label'=>'Привязать', 'type'=>'success', 'icon' => 'magnet',
										'url' => Yii::app()->createUrl('account/linking/', 
												array('id'=>$model->id, 'service' => Account::SCENARIO_FACEBOOK))));
				}
				?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label"> <?php echo $model->getAttributeLabel('tw_url'); ?></label>
			<div class="controls">	 
				<?php 
				if (!empty($model->tw_id)) 
				{
					echo CHtml::link(substr($model->tw_url, strrpos($model->tw_url, '/')+1), $model->tw_url);
					$this->widget('bootstrap.widgets.BootButton', array(
										'label'=>'Обновить', 'type'=>'success', 'icon' => 'refresh',
										'url' => Yii::app()->createUrl('account/linking/', 
												array('id'=>$model->id, 'service' => Account::SCENARIO_TWITTER))));
				}
				else
				{
					$this->widget('bootstrap.widgets.BootButton', array(
										'label'=>'Привязать', 'type'=>'success', 'icon' => 'magnet',
										'url' => Yii::app()->createUrl('account/linking/', 
												array('id'=>$model->id, 'service' => Account::SCENARIO_TWITTER))));
				}
*/				?>
			</div>
		</div>
-->	    
	    <?php #echo $form->textFieldRow($model, 'vk_url'); ?>
	    <?php #echo $form->textFieldRow($model, 'fb_url'); ?>
	 	<?php #echo $form->textFieldRow($model, 'tw_url'); ?>
	 	<?php #echo $form->textFieldRow($model, 'ok_url'); ?>
	 	
	 	<?php echo $form->textAreaRow($model, 'about', array('class'=>'span3', 'rows'=>5)); ?>
	
	
<!-- 		<div class="input-append date" id="datepicker" data-date="09.12.1990" data-date-format="dd.mm.yyyy">
		    <input size="16" type="text" value="09.12.1990" readonly>
		    <span class="add-on"><i class="icon-th"></i></span>
		</div> -->

		<?php // echo $form->textFieldRow($model, 'birth_date', array('append'=>'.00', 'icon' => 'calendar')); ?>

	<!-- 	<script language="Javascript">
		/$('#datepicker').datepicker({
		    format: 'yyyy-mm-dd'
		});
		</script> -->
		
		<?php echo Chtml::errorSummary($model); ?>
		

	

	
</fieldset> 

	<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить', 'htmlOptions'=>array('id' =>'update-btn'))); ?>
	    <?php $this->widget('bootstrap.widgets.BootButton', array('icon'=>'remove', 'label'=>'Вернуться в профиль', 'url'=>array('view','id'=>$model->id),)); ?>
	</div>
	 
	<?php $this->endWidget(); ?>	

<!-- --------------------------------------------------------------------- -->
<!-- --------------------------------AvatarLoad--------------------------- -->
<!-- --------------------------------------------------------------------- -->
<?php if (false) {  // я убрал модалки отсюда.!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!?> 
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
<?php } ?>