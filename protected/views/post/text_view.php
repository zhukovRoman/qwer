<?php $this->renderPartial('view_header',array(
  'model'=>$model,
)); ?>

<div class="article-content content-border span8">
    <?php echo CHtml::decode($model->text); ?>
</div>
<?php $this->renderPartial('view_footer',array(
  'model'=>$model,
)); ?>