
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
        
        
        <?php if ($model->parent_id != Null) {?>
            <span onclick="js:showtree(<?php echo $model->id; ?>);" >↵</span>
         <?php } ?>   
        <?php echo $model->getRaiting(); ?>
        
            
        <?php echo CHtml::ajaxLink("-", $this->createUrl('comment/raiting'), array(
                 'type'   => 'POST',
                 'update' => '#fjf',
                 'data' => 'js:"delta=-"',
                 'update'=> ''
        ))  ?>
            
        <?php echo CHtml::ajaxLink("+", $this->createUrl('comment/raiting'), array(
                 'type'   => 'POST',
                 'update' => '#fjf',
                 'data' => 'js:"delta=-1"',
                 'update'=> ''
        ))  ?>
        

    </div>