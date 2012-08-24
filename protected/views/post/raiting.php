<div class="span2 post-rating">
    <?php
   
    if (    Yii::app()->user->getId() &&
            ($model->author_id != Yii::app()->user->getId()) && 
            !PostRating::allreadyVote(Yii::app()->user->getId(), $model->id))
    {
    echo 'Проголосовать:&nbsp;&nbsp;';
    echo CHtml::ajaxLink("<i class='icon-plus green-a'></i>", Yii::app()->createUrl('post/raiting'), array(
        'type' => 'POST',
        'data' => "js:'delta=1&id-post='+$model->id",
        'success' => 'js:function(data) {postvotesuccess(data);}',
        'error' => 'js:function(data) {posterror();}',
    ));

    /*echo '&nbsp;<b title="Рейтинг">'.CHtml::encode($model->getRaiting()).'</b>';*/
    /*echo "<b title='Всего голосов'>(".$model->all_vote_count.")</b>&nbsp;";*/
    echo "&nbsp;&nbsp;";
    echo CHtml::ajaxLink("<i class='icon-minus green-a'></i>", Yii::app()->createUrl('post/raiting'), array(
        'type' => 'POST',
        'data' => "js:'delta=-1&id-post='+$model->id",
        'success' => 'js:function(data) {postvotesuccess(data);}',
        'error' => 'js:function(data) {posterror();}',
    ));
    }
    else {
     /*   echo '&nbsp;<b title="Рейтинг">'.CHtml::encode($model->getRaiting()).'</b>';
        echo "<b title='Всего голосов'>(".$model->all_vote_count.")</b>&nbsp;";*/
    }
    ?>
</div>

