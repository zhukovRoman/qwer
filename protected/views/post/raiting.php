<div id="post-rating">
    
    <?php
   
    if (    Yii::app()->user->getId() &&
            ($model->author_id != Yii::app()->user->getId()) && 
            !PostRating::allreadyVote(Yii::app()->user->getId(), $model->id))
    {
    echo CHtml::ajaxLink("+", Yii::app()->createUrl('post/raiting'), array(
        'type' => 'POST',
        'data' => "js:'delta=1&id-post='+$model->id",
        'success' => 'js:function(data) {postvotesuccess(data);}',
        'error' => 'js:function(data) {posterror();}',
    ));

    echo CHtml::encode($model->getRaiting());
    echo "(".$model->all_vote_count.")";

    echo CHtml::ajaxLink("-", Yii::app()->createUrl('post/raiting'), array(
        'type' => 'POST',
        'data' => "js:'delta=-1&id-post='+$model->id",
        'success' => 'js:function(data) {postvotesuccess(data);}',
        'error' => 'js:function(data) {posterror();}',
    ));
    }
    else {
        echo CHtml::encode($model->getRaiting());
        echo "(".$model->all_vote_count.")";
    }
    ?>
</div>

