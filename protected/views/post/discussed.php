<legend> Обсуждаемое </legend>
<?php

    foreach ($items as $item)
    {
?>
        <div> <?php echo CHtml::link(CHtml::encode($item->title), 
						array('/post/view', 'id'=>$item->id));?></div> 
        <div><?php echo CHtml::encode($item->comment_count)?> </div>
<?php
    }
?>
