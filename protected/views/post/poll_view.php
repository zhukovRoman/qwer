<?php $this->renderPartial('view_header',array(
  'model'=>$model,
)); ?>
<div class="article-video">
<div style="clear:both"></div>
<?php 
if (User_Vote::alreadyVote($model->id)) 
{
    $this->renderPartial('_poll_res',array(
    'model'=>$model,
  )); 
}
else {
    $this->renderPartial('_poll_vars',array(
    'model'=>$model,
  )); 
}
?>
</div>
<br>
<div class="article-content content-border span8">
    <?php echo CHtml::decode($model->text); ?>
</div>
<?php $this->renderPartial('view_footer',array(
  'model'=>$model,
)); ?>

