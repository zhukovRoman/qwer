<?php

    foreach ($items as $item)
    {
?>
     <div> <?php echo CHtml::link(CHtml::encode($item->title), 
              array('/post/view', 'id'=>$item->id));?></div> 
<div class="main-view-bottom">
          <div class="main-user">
        <b><?php echo CHtml::link('<i class="icon-user" rel="tooltip" title="автор">'.substr($item->author->login, 0, 14),
            Yii::app()->createUrl('account/view',
            array ("id"=>$item->author->id)), array('class'=>'black-a')); ?></i></b>
      </div>
      <i class="icon-star" rel="tooltip" title="рейтинг"></i>
      <?php echo CHtml::encode($item->getraiting());?>
      <i class="icon-comment" rel="tooltip" title="число комментариев"></i>
      <?php echo CHtml::encode($item->comment_count);?> 
        / 
      <?php echo CHtml::link(CHtml::encode($item->category->name), 
              array('/category/view', 'id'=>$item->category->id));?>
      <hr>
</div>
<?php
    }
?>