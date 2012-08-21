<?php 	$this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'modal_create',));
		$model = new LoginForm; ?>

<div class="modal-header">
    	<a class="close" data-dismiss="modal">&times;</a>
    	<h3>Создание</h3>
</div>
 
<div class="modal-body"> 

<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'Статья', 'icon'=>'pencil', 'url'=> Yii::app()->createUrl('/post/create'),),
        array('label'=>'Видео', 'icon'=>'film', 'url'=>Yii::app()->createUrl('/post/createvideo')),
        array('label'=>'Фотоотчет', 'icon'=>'camera', 'url'=>'#'),
    ),
)); ?>
	
</div>
 
<div class="modal-footer">
    	<?php $this->widget('bootstrap.widgets.BootButton', array(
		    'icon'=>'remove', 
		    'label'=>'Отмена',
		    'type'=>'close',
      	 	'htmlOptions'=>array('data-dismiss'=>'modal'),
    	)); ?>
</div>
                
<?php
    $this->endWidget();
?>
