<div style="clear:both"></div>
    <hr>

<?php $this->renderPartial('_icons',array(
  'model'=>$model,
)); ?>

<?php $this->renderPartial('_tags',array(
  'model'=>$model,
)); ?>
    
<?php $this->renderPartial('raiting',array(
  'model'=>$model,
)); ?>    
<?php $this->renderPartial('_soc',array(
  'model'=>$model,
)); ?>  
<br>
</div>