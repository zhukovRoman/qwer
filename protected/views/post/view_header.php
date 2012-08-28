<!-- .crumbs -->
<?php $this->renderPartial('_crumbs',array(
  'model'=>$model,
)); ?>
<!-- /.crumbs -->
<br>
<!-- .moderate -->
<?php if (Yii::app()->user->checkAccess('manageOwnPost', array('Post' => $model))
        || Yii::app()->user->checkAccess('moderatePost'))
$this->renderPartial('_moderate',array(
  'model'=>$model,
)); ?>
<!-- /.moderate -->
<div class="article">
<!-- .article-title -->
<?php $this->renderPartial('_article_title',array(
  'model'=>$model,
)); ?>
<!-- .article-title -->
