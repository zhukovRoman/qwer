<div style="clear:both"></div>
    <hr>
<div class="span5">
  <?php $this->renderPartial('_icons',array(
    'model'=>$model,
  )); ?>
</div>
<div class="span3">
<?php $this->renderPartial('raiting',array(
  'model'=>$model,
)); ?>
</div>
<div class="clearfix"></div>
<div class="span9">
  <?php $this->renderPartial('_tags',array(
    'model'=>$model,
  )); ?>    
  <?php $this->renderPartial('_soc',array(
    'model'=>$model,
  )); ?>  
</div>
<br>
</div>
<div class="clearfix"></div>