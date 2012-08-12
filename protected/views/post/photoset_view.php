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
<div class="article">
<?php $this->renderPartial('_article_title',array(
  'model'=>$model,
)); ?>
<!-- .article-title -->
<br>
<div class="content-border span7">
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
</div>


<?php  ?>

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
</div>
<br>
Блок поделиться? лайки <br>
комменты