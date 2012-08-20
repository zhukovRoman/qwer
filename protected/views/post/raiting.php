<div>
    <?php
    echo CHtml::ajaxLink("+", Yii::app()->createUrl('post/raiting'), array(
        'type' => 'POST',
        'data' => "js:'delta=1&id-post='+$model->id",
        'success' => 'js:function(data) {postvotesuccess(data);}',
        'error' => 'js:function(data) {postvoteeror(data);}',
    ));

    echo CHtml::encode($model->getRaiting());

    echo CHtml::ajaxLink("-", Yii::app()->createUrl('post/raiting'), array(
        'type' => 'POST',
        'data' => "js:'delta=-1&id-post='+$model->id",
        'success' => 'js:function(data) {postvotesuccess(data);}',
        'error' => 'js:function(data) {postvoteeror(data);}',
    ));
    ?>
</div>

