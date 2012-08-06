<?php  $tags_array = $model->getTags();?>
<?php if (count($tags_array)!==0){?>
  <div class="article-tags">
      <i class="icon-tags" rel="tooltip" title="теги"></i>
      <?php 
          foreach ($tags_array as $tag)
          {
              echo CHtml::link($tag, Yii::app()->createUrl('tag/view',
                                    array ("tag"=>$tag))).", ";
          }
      ?>
</div>
<?php };?>