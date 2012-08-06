<?php
//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//	$('.search-form').toggle();
//	return false;
//});
//$('.search-form form').submit(function(){
//	$.fn.yiiGridView.update('post-grid', {
//		data: $(this).serialize()
//	});
//	return false;
//});
//");
?>


<!--
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div> search-form -->

<legend>Работа с записями</legend>

<?php 
    $this->widget('bootstrap.widgets.BootMenu', array(
        'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
        'stacked'=>false, // whether this is a stacked menu
        'items'=>array(
            array('label'=>'Модерация', 
                    'url'=>Yii::app()->
                                        createUrl('post/manage',
                                                                array ('status'=>1)),
                'active'=> ($status==1) ? true: false,
                ),
            array('label'=>'Одобренные', 'url'=>Yii::app()->
                                                        createUrl('post/manage',
                                                                array ('status'=>5)),
                'active'=> ($status==5) ? true: false,
                ),
            array('label'=>'Архив', 'url'=>Yii::app()->
                                                        createUrl('post/manage',
                                                                array ('status'=>10)),
                'active'=> ($status==10) ? true: false,
                ),
            array('label'=>'Черновики', 'url'=>Yii::app()->
                                                        createUrl('post/manage',
                                                                array ('status'=>3)),
                'active'=> ($status==3) ? true: false,

                ),

            )
        )); 
?>
<?php $this->renderPartial('admingrid',array(
	'model'=>$model,
        'status'=>$status,
)); ?>


