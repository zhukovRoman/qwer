
<div class="comment-header">
    <img src="<?php echo "uploads/" . $model->author->id . "/25x25.jpg" ?>" 
         class="userpic-comment" width="25" height="25">
         <?php echo Chtml::link($model->author->login, array('/account/view', 'id' => $model->author->id));
         ?>
         <?php echo Chtml::encode(date("d/m/y в H:i", strtotime($model->time_add))) ?>

    <?php echo Chtml::link("#", Yii::app()->request->url . "#" . $model->id); ?>

    <?php
    echo ($model->parent_id != Null) ?
            Chtml::link("^", Yii::app()->request->url . "#" . $model->parent_id) :
            "";
    ?>


    <?php if ($model->parent_id != Null) { ?>
        <span onclick="js:showtree(<?php echo $model->id; ?>);" >↵</span>
<?php } ?>  

    <span id="vote-error-<?php echo $model->id; ?>" 
          style="display: none;">Ошибка!</span>
    <span id="vote-success-<?php echo $model->id; ?>" 
          style="display: none;">Спасибо за отзыв!</span>

    <span id="rait-<?php echo $model->id; ?>" >  

        <?php
        if ((Yii::app()->user->getId() == $model->author->id) ||
                (Yii::app()->user->isGuest) ||
                (Comment::alreadyVote(Yii::app()->user->getId(), $model->id))) {
            // показываем только оценки
            echo $model->getRaiting();
        } else {
            echo CHtml::ajaxLink("-", Yii::app()->createUrl('comment/raiting'), array(
                'type' => 'POST',
                'data' => "js:'delta=-1&id-comment='+$model->id",
                'success' => 'js:function(data) {commentvotesuccess(data);}',
                'error' => 'js:function(data) {commentvoteeror(data);}',
            ));

            echo $model->getRaiting();

            echo CHtml::ajaxLink("+", Yii::app()->createUrl('comment/raiting'), array(
                'type' => 'POST',
                'data' => "js:'delta=1&id-comment='+$model->id",
                'success' => 'js:function(data) {commentvotesuccess(data);}',
                'error' => 'js:function(data) {commentvoteeror(data);}',
            ));
        }
        ?>

    </span>

</div>