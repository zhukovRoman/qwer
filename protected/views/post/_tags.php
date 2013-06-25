<?php  $tags_array = $model->getTags();?>
<?php if (count($tags_array)!==0){?>
  <div class="article-tags">
      <i class="icon-tags" rel="tooltip" title="теги"></i>
      <?php 
            $c=count($tags_array);
          for ($i=0; $i<$c; $i++)
          {
              if ($i!=0) echo ", ";
              //echo CHtml::link($tags_array[$i], Yii::app()->createUrl('tag/view',
              //                      array ("tag"=>$tags_array[$i])));
              echo CHtml::encode($tags_array[$i]);
          }
      ?>
</div>
<?php };?>