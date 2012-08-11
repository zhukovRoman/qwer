<div class="comment-item" 
     id ="<?php echo $model->id;?>" 
     style="margin-left: 10px; border: 1px solid;" 
     parent-id ="<?php echo $model->parent_id; ?>"
     is_hide="0">
    <div class="comment-header">
        <img src="<?php echo "uploads/".$model->author->id."/25x25.jpg"?>" 
            class="userpic-comment" width="25" height="25">
        <?php echo Chtml::link($model->author->login, 
                array('/account/view', 'id'=>$model->author->id)); ?>
        <?php echo Chtml::encode(date("d/m/y в H:i", strtotime($model->time_add)))?>

        <?php echo Chtml::link("#",Yii::app()->request->url."#".$model->id ); ?>

        <?php echo ($model->parent_id != Null)?
            Chtml::link("^",Yii::app()->request->url."#".$model->parent_id ) :
            ""; ?>
        <?php echo 'избранное'; ?>
        
        <?php if ($model->parent_id != Null) {?>
            <span onclick="js:showtree(<?php echo $model->id; ?>);" >↵</span>
         <?php } ?>   
        <?php echo $model->getRaiting(); ?>
        <?php echo '+'; ?>
        <?php echo '-'; ?>

    </div>
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