
<?php $this->renderPartial('_crumbs',array(
  'model'=>$model,
)); ?>

<br>

<?php $this->renderPartial('_moderate',array(
	'model'=>$model,
)); ?>
<div class="article">

<?php $this->renderPartial('_article_title',array(
  'model'=>$model,
)); ?>

<div class="article-content content-border span8">
    <?php echo CHtml::decode($model->text); ?>
</div>
<div style="clear:both"></div>
    <hr>

<?php $this->renderPartial('_icons',array(
  'model'=>$model,
)); ?>

<?php $this->renderPartial('_tags',array(
  'model'=>$model,
)); ?>
Блок поделиться? лайки <br>


</div>

