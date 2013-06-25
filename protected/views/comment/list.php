 <?php
      foreach ($items as $item)
      {
  ?>
        
           <?php echo CHtml::encode($item->text); ?> 
<div class="main-view-bottom">
          <div class="main-user">

        <b><?php echo CHtml::link('<i class="icon-user" rel="tooltip" title="Автор">'.$item->author->login,
            Yii::app()->createUrl('account/view',
            array ("id"=>$item->author->id)), array('class'=>'green-a')); ?></i></b>
      </div>
      <i class="icon-sign-blank", title="Название статьи">&nbsp;<?php echo CHtml::link(CHtml::encode($item->post->title), 
              array('/post/view', 'id'=>$item->post->id));?></i>
      <i class="icon-star" rel="tooltip" title="Рейтинг"></i>
      <?php echo CHtml::encode($item->getraiting());?>
      <hr>
</div>
  <?php
      }
  ?>  
