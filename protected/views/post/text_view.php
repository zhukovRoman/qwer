<!-- .crumbs -->
<?php $this->renderPartial('_crumbs',array(
  'model'=>$model,
)); ?>
<!-- /.crumbs -->
<br>
<!-- .moderate -->
<?php $this->renderPartial('_moderate',array(
	'model'=>$model,
)); ?>
<!-- /.moderate -->
<!-- .row -->
<!-- .article -->
<div class="article">
<!-- .article-title -->
<?php $this->renderPartial('_article_title',array(
  'model'=>$model,
)); ?>
<!-- .article-title -->
<!-- .article-content -->
<div class="article-content content-border span7">
    <?php echo CHtml::decode($model->text); ?>
</div>
<div style="clear:both"></div>
    <hr>
<!-- .icons -->
<?php $this->renderPartial('_icons',array(
  'model'=>$model,
)); ?>
<!-- /.icons -->
<!-- .article-tags -->
<?php $this->renderPartial('_tags',array(
  'model'=>$model,
)); ?>
<!-- /.article-tags -->
Блок поделиться? лайки <br>
комменты
<!-- /.article-content -->
</div>
<!-- /.article -->
<!-- /.row -->
