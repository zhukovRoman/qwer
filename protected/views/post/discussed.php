<?php

    foreach ($items as $item)
    {
?>
     <div> <?php echo CHtml::link(CHtml::encode($item->title), 
              array('/post/view', 'id'=>$item->id), array('class'=>'black-a'));?></div> 
<div class="main-view-bottom">
          <div class="main-user">
        <b><?php echo CHtml::link('<i class="icon-user" rel="tooltip" title="Автор">'.substr($item->author->login, 0, 14),
            Yii::app()->createUrl('account/view',
            array ("id"=>$item->author->id)), array('class'=>'green-a')); ?></i></b>
      </div>
      <i class="icon-star" rel="tooltip" title="Рейтинг"></i>
      <?php echo CHtml::encode($item->getraiting());?>
      <i class="icon-comment" rel="tooltip" title="Число комментариев"></i>
      <?php echo CHtml::encode($item->comment_count);?> 
        / 
      <?php echo CHtml::link(CHtml::encode($item->category->name), 
              array('/category/view', 'id'=>$item->category->id));?>
      <hr>
</div>
<?php
    }
?>