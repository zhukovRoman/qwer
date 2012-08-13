<div class="comment-item" 
     id ="<?php echo $model->id;?>" 
     style="margin-left: 10px; border: 1px solid;" 
     parent-id ="<?php echo $model->parent_id; ?>"
     is_hide="0">
    <?php $this->renderPartial("/comment/tree_item_header", 
                        array('model'=>$model,));
                                                ?>
    <div class="comment_text">
    <?php echo CHtml::encode($model->text); ?>
    </div>
    <?php $this->widget('bootstrap.widgets.BootButton', array(
    'buttonType'=>'button',
    'type'=>'primary',
    'size'=>'mini',
    'label'=>'Oтветить',
    'htmlOptions'=>array(
                        'onclick'=>'js:attachForm('.$model->id.')',
                        'id'=>'replay-button'.$model->id,
                        'class'=>'button-replay',
                    )
            )
        ); ?> 
    
    
    <div id="reply-<?php echo $model->id ; ?>"></div>
    <?php  
        $this->renderPartial('/comment/tree',array(
                                    'comments'=>$model->comments,
                                    'parent_id'=>$model->id));
    ?>
</div>