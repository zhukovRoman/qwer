
<div> <h3>Сделайте свой выбор: </h3></div>

<?php
$vars = json_decode($model->code);
$i=0;
foreach ($vars as $var) {
    ?>

<div class="vars">
    <?php echo CHtml::ajaxLink($var, Yii::app()->createUrl('post/poll'), array (
        'data'=>"id_var=$i&id_poll=$model->id",
        'type' => 'POST',
        'success' => "js:function(data) {poll_success(data);}",
        'error' => 'js:function(data) {poll_error();}',
    ) )?>
</div>

        <?php
        $i++;
    }
    ?>