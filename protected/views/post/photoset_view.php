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
<br>
<?php
       $this->beginWidget('ext.prettyPhoto.PrettyPhoto', array(
        'id'=>'pretty_photo',
        // prettyPhoto options
        'options'=>array(
            'opacity'=>0.80,
            'modal'=>true,
            'animation_speed'=> 'fast', 
        ),
        ));
        echo $model->getGalleryPhoto();
        $this->endWidget('ext.prettyPhoto.PrettyPhoto');
?>

<?php  ?>

<br>
<?php  //$model->convertCode();  echo $model->code; ?>
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