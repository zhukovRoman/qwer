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
<!-- .article-title -->
<?php $this->renderPartial('_article_title',array(
  'model'=>$model,
)); ?>
<!-- .article-title -->

<img src="<?php echo $model->preview_url;?>">
<hr>
<?php echo ($model->code); ?>
<?php echo CHtml::decode($model->text); ?>

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
<br>
Блок поделиться? лайки <br>

комменты
