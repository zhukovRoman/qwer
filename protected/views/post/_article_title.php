<div class="row article-title">
    <h1><span><?php echo CHtml::encode($model->title);?></span></h1>
    <h3><span><?php echo CHtml::encode($model->subtitle);?></span></h3>
    <!-- .icons -->
    <?php $this->renderPartial('_icons',array(
      'model'=>$model,
    )); ?>
</div>