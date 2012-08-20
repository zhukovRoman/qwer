<div class="row article-title span8">
    <h1><span><?php echo CHtml::encode($model->title);?></span></h1>
    <h3 class="color-grey"><span><?php echo CHtml::encode($model->subtitle);?></span></h3>
    <!-- .icons -->
    <div class="icons color-grey">
    <?php $this->renderPartial('_icons',array(
      'model'=>$model,
    )); ?>
  </div>
</div>