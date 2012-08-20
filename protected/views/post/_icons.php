<div class="icons">
<i class="icon-user" rel="tooltip" title="автор"></i>
<b><?php echo CHtml::encode($model->author->login);?></b>
<i class="icon-time" rel="tooltip" title="дата публикации"></i>
<?php echo date ("d/m/Y", strtotime($model->time_add));?>
<i class="icon-star" rel="tooltip" title="рейтинг"></i>
<?php echo $model->getraiting();?> 
<i class="icon-comment" rel="tooltip" title="число комментариев"></i>
<?php echo  $model->comment_count;?> 
<i class="icon-eye-open" rel="tooltip" title="число просмотров"></i>
<?php echo  $model->view_count;?> 
<?php 
echo CHtml::ajaxLink('<i class="icon-heart" 
                                rel="tooltip" 
                                title="добавили в избранное"></i>',
        Yii::app()->createUrl('post/favorite'), array(
        'type' => 'POST',
        'data' => "js:'id-post='+$model->id",
        'success' => 'js:function(data) {postvotesuccess(data);}',
        'error' => 'js:function(data) {postvoteeror();}',
    ));
?>

<?php echo  $model->favourite_count;?>
</div>
