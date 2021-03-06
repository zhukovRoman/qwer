
<div class="bg-grey content-border">
    <?php  $path = Account::ACCOUNT_DIR . $model->author->id . DIRECTORY_SEPARATOR  . Account::USERPIC_NAME ;
	if (!file_exists($path)) {$src = Account::ACCOUNT_DIR . Account::DEFAULT_DIR . Account::AVATAR_NAME;}
                else {$src = $path;}
        ?>
    <img src="<?php echo $src ?>" 
         class="userpic-comment" width="25" height="25">
         <?php echo Chtml::link($model->author->login, array('/account/view', 'id' => $model->author->id));
         ?>
         <?php echo Chtml::encode(date("d/m/y в H:i", strtotime($model->time_add))) ?>


    <?php echo Chtml::link('<b title="Ccылка на этот комментарий" style="color:#333">#</b>', 
            Yii::app()->createUrl('post/view', array ("id"=>$model->post->id)). "#" . $model->id); ?>




    <?php
    echo ($model->parent_id != Null) ?
            Chtml::link('<b title="Показать родителя комментария" style="color:#333">^</b>', Yii::app()->createUrl('post/view', array ("id"=>$model->post->id)) . "#" . $model->parent_id) :
            "";
    ?>


    <?php if ($model->parent_id != Null) { ?>
        <!-- <span onclick="js:showtree(<?php echo $model->id; ?>);" >↵</span> -->
        <span title="Показать ветвь комментариев отдельно" class="showtree" id="<?php echo $model->id; ?>"><b>↵</b></span>
    <?php } ?>  

    <span id="vote-error-<?php echo $model->id; ?>" 
          style="display: none;">Ошибка!</span>
    <span id="vote-success-<?php echo $model->id; ?>" 
          style="display: none;">Спасибо за отзыв!</span>
          &nbsp;
    <span title="Рейтинг комментария" id="rait-<?php echo $model->id; ?>" >  
        <?php
        if ((Yii::app()->user->getId() == $model->author->id) ||
                (!Yii::app()->user->checkAccess('commentVote')) ||
                (Comment::alreadyVote(Yii::app()->user->getId(), $model->id))) {
            // показываем только оценки
            echo '<b>'.CHtml::encode($model->getRaiting()).'</b>';
        } else {
             echo CHtml::ajaxLink("<i class='icon-plus'></i>", Yii::app()->createUrl('comment/raiting'), array(
                'type' => 'POST',
                'data' => "js:'delta=1&id-comment='+$model->id",
                'success' => 'js:function(data) {commentvotesuccess(data);}',
                'error' => 'js:function(data) {commentvoteeror(data);}',
            ));
            
            echo '<b>'.CHtml::encode($model->getRaiting()).'</b>';

            echo CHtml::ajaxLink("<i class='icon-minus'></i>", Yii::app()->createUrl('comment/raiting'), array(
                'type' => 'POST',
                'data' => "js:'delta=-1&id-comment='+$model->id",
                'success' => 'js:function(data) {commentvotesuccess(data);}',
                'error' => 'js:function(data) {commentvoteeror(data);}',
            ));
           
        }
        ?>

    </span>

</div>