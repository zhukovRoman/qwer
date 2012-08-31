<?php $this->renderPartial('view_header',array(
  'model'=>$model,
)); ?>
<br>
<div class="span8">
    <?php
           $this->beginWidget('ext.prettyPhoto.PrettyPhoto', array(
            'id'=>'pretty_photo',
            // prettyPhoto options
            'options'=>array(
                'opacity'=>0.80,
                'modal'=>true,
                'animation_speed'=> 'fast', 
                array('class'=>'df'),
            ),
            ));
            echo $model->getGalleryPhoto();
            $this->endWidget('ext.prettyPhoto.PrettyPhoto');
    ?>  
</div>
<div style="clear:both"></div>

<?php 
  Yii::app()->clientScript->registerScriptFile("js/prettyphoto/jquery.prettyPhoto.js", CClientScript::POS_END);
 /* Yii::app()->getClientScript()->registerCssFile('css/prettyphoto/prettyPhoto.css');*/
?>

<div class="article-content content-border span8">
    <?php echo CHtml::decode($model->text); ?>
</div>

<?php $this->renderPartial('view_footer',array(
  'model'=>$model,
)); ?>
