
<?php 

//echo Yii::app()->user->getId();
//die();

	/*$XUpload = new XUploadForm;
	$this->widget('ext.xupload.XUploadWidget', 
			array(
						'url' => Yii::app()->createUrl('file/upload'),
					array('parent_id' => Account::ACCOUNT_DIR . Yii::app()->user->getId() ),  
	
						'model' => $XUpload,
						'attribute' => 'file',
						'options'=>array(
                        'acceptFileTypes' => '/(\.|\/)(gif|jpeg|png)$/i',
						'onComplete' => 'js:function (event, files, index, xhr, handler, callBack) {
							$("#User_avatar").val(\'\'+handler.response.name + \'\' );
							}'),
		       ));


$this->widget('xupload.XUpload', array(
		'url' => Yii::app()->createUrl("site/upload"),
		'model' => $model,
		'attribute' => 'file',
		'multiple' => true,
));*/
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'account-form',
	'enableAjaxValidation'=>false,
)); ?>


<div class="row">
<div class="span4">

	<div>
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>
	
	<div class="row buttons">
        <?php echo $form->labelEx($model,'sex'); ?>:
        <?php echo $form->radioButtonList($model, 'sex', array( 1 => 'Мужской' , 0 => 'Женский'), array('separator' => ' ') ); ?>
    </div>

    <div class="row">
	<?php $this->widget('bootstrap.widgets.BootTypeahead', array(
	    'options'=>array(
	        'source'=>array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Dakota', 'North Carolina', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'),
	        'items'=> 4,
	        'matcher'=>"js:function(item) {
	            return ~item.toLowerCase().indexOf(this.query.toLowerCase());
	        }",
	    ),
	)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id'); ?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birth_date'); ?>
		<?php echo $form->textField($model,'birth_date'); ?>
		<?php echo $form->error($model,'birth_date'); ?>
	</div>
	
	<div class="row">
     	<?php if ($model->birth_date == '0000-00-00') $value = ''; else $value = date('d.m.Y', strtotime($model->birth_date)); ?>
        <?php echo $form->labelEx($model,'birth_date'); ?>:
  		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
  			'model' => $form,
  			'attribute' => 'birth_date',
  			'name' => 'birth_date',
  				
    		// additional javascript options for the date picker plugin
    		'options'=>array(
        		'showAnim'=>'fold',
    			'changeYear' => true, 
    			'changeMonth' => true,
    			'showOtherMonths' => true,
    			'appendText' => "dd.mm.yyyy",
    			'yearRange' => 'c-100:c',
    			'defaultDate' => "09.12.1990",
    		),
  		
  			'language' => 'ru',
  		 
    		'htmlOptions'=>array(
    			'value' => $value
    		),
		)); ?>
   	</div>

	<div class="row">
        <?php echo $form->labelEx($model, 'phone'); ?>:
        <?php $this->widget('CMaskedTextField',array(
        			'model' => $model,
        			'attribute' => 'phone',
        			'name' => 'phone',
        			'mask'=>'+7(999)999-9999',)); ?> 
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'about'); ?>
		<?php echo $form->textField($model,'about',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'about'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vk_url'); ?>
		<?php echo $form->textField($model,'vk_url',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'vk_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tw_url'); ?>
		<?php echo $form->textField($model,'tw_url',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'tw_url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	
</div>

<div class="span3">

	<div class="row">
		<h5>Личные данные</h5>
		<?php $path = Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME ; ?>
		<?php if (!file_exists($path)) $src = Account::ACCOUNT_DIR . Account::DEFAULT_DIR . Account::AVATAR_NAME; else $src = $path ?>		
		<?php echo "<img src='$src' style='width: 200px; '>"; ?>
	</div>


<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list',
    'items'=>array(
    	array('label'=>'Изменить фотографию', 'url'=>'#', 'items'=>array(
	        array('label'=>'Загрузить аватар', 'icon'=>'home', 'url'=>'#AvatarLoad', 'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',)),
	        array('label'=>'Удалить аватар', 'icon'=>'book', 'url'=>'#AvatarDelete', 'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',), 'visible' => (file_exists($path))),
	        array('label'=>'Редактировать юзерпик', 'icon'=>'pencil', 'url'=>'#UserPic', 'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',), 'visible' => (file_exists($path))),
    	)),
    )
)); ?>


	<!--  
	<div class="profile-pic">
        <div class="profile-pic-step1">
          <div class="border" style="display: block; ">
            <div class="uploadProgress" style="display: none; "></div>
            <p class="descr">Файл не должен быть
            меньше чем 200 х 300 пикселей
            и не превышать 3 MB</p>
          </div>
          
        </div>
	</div>
      -->
	<?php 
	/*$this->widget('xupload.XUpload', array(
			'url' => Yii::app()->createUrl("site/upload"),
			'model' => $model,
			'attribute' => 'file',
			'multiple' => true,
	));*/
		$this->widget('bootstrap.widgets.BootButton', array(
	    'label'=>'Загрузить аватар',
	    'url'=> '#UserPic',//',#AvatarLoad
	    'type'=>'primary',
	    'htmlOptions'=>array('data-toggle'=>'modal'),
		)); ?>
	</div>
	
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->

<div>

	<?php /** @var BootActiveForm $form */
	$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	    'id'=>'horizontalForm',
	    'type'=>'horizontal',
	)); ?>
	 
	<fieldset>
	 
	    <legend>Редактирование профиля</legend>
	 
	 	<?php echo $form->textFieldRow($model, 'first_name'); ?>
	 	<?php echo $form->textFieldRow($model, 'last_name'); ?>
	 	<?php echo $form->radioButtonListRow($model, 'sex', array(1 => 'Мужской', 0 => 'Женский')); ?>
	    <?php echo $form->textFieldRow($model, 'phone'); ?>
	    
	    <?php echo $form->textFieldRow($model, 'vk_url'); ?>
	 	<?php echo $form->textFieldRow($model, 'tw_url'); ?>
	 	
	 	<?php echo $form->textAreaRow($model, 'about', array('class'=>'span3', 'rows'=>5)); ?>
	
		<?php $this->widget('bootstrap.widgets.BootTypeahead', array(
		    'options'=>array(
		        'source'=>array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Dakota', 'North Carolina', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'),
		        'items'=>4,
		        'matcher'=>"js:function(item) {
		            return ~item.toLowerCase().indexOf(this.query.toLowerCase());
		        }",
		    ),
		)); ?>
		<p>
	
		<div class="input-append date" id="datepicker" data-date="09.12.1990" data-date-format="dd.mm.yyyy">
		    <input size="16" type="text" value="09.12.1990" readonly>
		    <span class="add-on"><i class="icon-th"></i></span>
		</div>

		<?php echo $form->textFieldRow($model, 'birth_date', array('append'=>'.00', 'icon' => 'calendar')); ?>
		
	<?php 	
			Yii::app()->clientScript->registerScriptFile("js/datepicker/js/bootstrap-datepicker.js");
			Yii::app()->getClientScript()->registerCssFile("js/datepicker/css/datepicker.css");
		?>

	<script language="Javascript">
	$('#datepicker').datepicker({
    format: 'yyyy-mm-dd'
});
	</script>
	</fieldset>
	 
	<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
	</div>
	 
	<?php $this->endWidget(); ?>	
</div>

<!-- --------------------------------------------------------------------- -->
<!-- --------------------------------AvatarLoad--------------------------- -->
<!-- --------------------------------------------------------------------- -->

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'AvatarLoad')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Загрузка аватара</h3>
</div>
 
<div class="modal-body">
     
	<img src='' id='new-avatar' style='width: 200px; '>
     
    <div id="UploadButton">
	<?php
		$id = $model->id;
		$upload = new XUploadForm;
		$this->widget('ext.xupload.XUploadWidget', array(
		'url' => Yii::app()->createUrl('site/upload/',
		array('parent_id' =>$id ) ),
		'model' => $upload,
		'attribute' => 'file',
		'options'=>array(
			/*'beforeSend' => 'js:function(event, files, index, xhr, handler, callBack) {
			handler.uploadRow.find(".upload_start button").click(callBack);
			}',*/
				'onComplete' => 'js:function (event, files, index, xhr, handler, callBack) 
				{		
					//jQuery("#UserPic").modal({"show": true});
					//jQuery("#AvatarLoad").modal("hide");	
					//jQuery("#target").attr("src", handler.response.url);
					//$(function(){ $("#target").Jcrop(); });
				
					jQuery("#hidden").text(handler.response.url);
					jQuery("#SaveAvatar").show(1);
					jQuery("#UploadButton").hide(1);
				
					
					jQuery("#new-avatar").attr("src", handler.response.url);
					
				
					//alert (jQuery(".jcrop-tracker").children().get(1));
					$(".jcrop-holder").children("img").attr("src", handler.response.url);; // attr("src", handler.response.url);
					
					//jQuery("#preview").attr("src", handler.response.url);
					init();
					//alert(handler.response.url);
				}'
			),
		));
	?>
	</div>
	
	<div id="hidden" style="display:none"> </div>
	
</div>
 

<div class="modal-footer">

    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'type'=>'primary',
        'label'=>'Save changes',
        'url'=> '#',// array('account/avatarload/','id'=>$model->id),//Yii::app()->createUrl('account/avatarload/', array('model' =>$model ) ),
        //'htmlOptions'=>array('data-dismiss'=>'modal'),

    		'htmlOptions'=>array('data-dismiss'=>'modal',
    				'id' => 'SaveAvatar',
    				'style' => 'display: none',
    				'ajax' => array(
    						'type'   => 'POST',
    						'data'   => 'js:"params="+$("#hidden").text()', // тут мы выбираем данные которые нужно передать.
    						'url'    => array('account/avatarload/','id'=>$model->id),
    						'success'=> 'js:function() // при успехе экшена выполняется это.
    									{
    										jQuery("#UserPic").modal({"show": true});
											jQuery("#AvatarLoad").modal("hide");	
    										// location.reload();
										}', 
    				)
    		)
    )); ?>
    
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
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
  
   <?php 
   /*$form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
			),
		//'action' => array('site/login'),
	)); */?>          

	<?php 	
			Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.Jcrop.js");
			//Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.Jcrop.min.js");
			Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.color.js");
			//Yii::app()->clientScript->registerScriptFile("js/jcrop/js/jquery.min.js");
			Yii::app()->getClientScript()->registerCssFile('js/jcrop/css/jquery.Jcrop.css');
			
		?>
	
	<?php //if ($model->avatar_url == null) $src = 'uploads/camera_a.gif'; else 
		$src = $path; ?>		
	<?php echo "<img src='$src' id='target' style='width: 200px; '>"; ?>
	
	
	<div style="width: 100px; height: 100px; overflow: hidden; margin-left: 5px; float: right;">
		<?php echo "<img src='$src' id='preview' style='max-width:none;'>" ; ?>
	</div>
<!-- 	

<script language="Javascript">
	function init() {
		   // Create variables (in this scope) to hold the API and image size
		    var jcrop_api, boundx, boundy;
		    
		    $('#target').Jcrop({
				onChange: updatePreview,
				onSelect: updatePreview,
				onRelease: hidePreview,
				aspectRatio: 1,
				setSelect:[10,10,160,160],
		    	minSize:[50,50]
		    },function(){
		      // Use the API to get the real image size
		      var bounds = this.getBounds();
		      boundx = bounds[0];
		      boundy = bounds[1];
		      // Store the API in the jcrop_api variable
		      jcrop_api = this;
		      
		    });
		
		    function hidePreview()
		    {
		       $('#preview').hide();
		    }
		    
		    function updatePreview(c,boundx )
		    {
		    	 $('#preview').show();
		    	 
		      if (parseInt(c.w) > 0)
		      {
		        var rx = 100 / c.w;
		        var ry = 100 / c.h;
		        $("#сoordinates").text(c.w + ' ' +  c.h + ' ' +  c.x + ' ' +  c.y);
		        $('#preview').css({
		          width: Math.round(rx * boundx) + 'px',
		          height: Math.round(ry * boundy) + 'px',
		          marginLeft: '-' + Math.round(rx * c.x) + 'px',
		          marginTop: '-' + Math.round(ry * c.y) + 'px'
		        });
		      }
		    };
		
		 
	};

	</script>
 -->
	
	<script language="Javascript">
	
	jQuery(function($){
	
	    // Create variables (in this scope) to hold the API and image size
	    var jcrop_api, boundx, boundy;
	    
	    $('#target').Jcrop({
			onChange: updatePreview,
			onSelect: updatePreview,
			onRelease: hidePreview,
			aspectRatio: 1,
			setSelect:[10,10,160,160],
	    	minSize:[50,50]
	    },function(){
	      // Use the API to get the real image size
	      var bounds = this.getBounds();
	      boundx = bounds[0];
	      boundy = bounds[1];
	      // Store the API in the jcrop_api variable
	      jcrop_api = this;
	      
	    });
	
	    function hidePreview()
	    {
	       $('#preview').hide();
	    }
	    
	    function updatePreview(c,boundx )
	    {
	    	 $('#preview').show();
	    	 
	      if (parseInt(c.w) > 0)
	      {
	        var rx = 100 / c.w;
	        var ry = 100 / c.h;
	        
	        //var scalex = boundx / $('#target').attr("widht");
	        //var scaley = boundy / $('#target').attr("height");
	        // в див с id=123 записываем параметры изображения (левый верхний угол, ширна и высота)
	        // ПРОБЛЕМА: невозможно получить реальные координаты (получаются координаты картинки с ширниной чуть более 800)
	        // а на самом деле она 1200 почти... 
	        $("#сoordinates").text(c.w + ' ' +  c.h + ' ' +  c.x + ' ' +  c.y);

	        $('#preview').css({
	          width: Math.round(rx * boundx) + 'px',
	          height: Math.round(ry * boundy) + 'px',
	          marginLeft: '-' + Math.round(rx * c.x) + 'px',
	          marginTop: '-' + Math.round(ry * c.y) + 'px'
	        });
	      }
	    };
	
	  });
	</script>
	
	<div id="сoordinates" style="display:none"> </div>

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
<?php //$this->endWidget(); ?>

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
        'url'=> '#',// array('account/avatarload/','id'=>$model->id),//Yii::app()->createUrl('account/avatarload/', array('model' =>$model ) ),
        //'htmlOptions'=>array('data-dismiss'=>'modal'),

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