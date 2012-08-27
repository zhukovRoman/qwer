<i class="icon-user" rel="tooltip" title="автор"></i>
<b title="Автор"><?php echo CHtml::link($model->author->login, 
    Yii::app()->createUrl('account/view',
    array ("id"=>$model->author->id))); ?>
</b>
&nbsp;
<i class="icon-time" rel="tooltip" title="Дата публикации"><?php echo date ("d/m/Y", strtotime($model->time_add));?></i>
&nbsp;
<i class="icon-comment" rel="tooltip" title="Число комментариев"><?php echo  $model->comment_count;?> </i>
<i class="icon-eye-open" rel="tooltip" title="Число просмотров"><?php echo  $model->view_count;?> </i>
<?php 
if (Yii::app()->user->getId()) {
    if (Post::inFavorite($model->id))
    {
    //если статья уже в избранном 
     
        echo CHtml::ajaxLink('<i class="icon-heart gray-a" 
                                    rel="tooltip" 
                                    title="Убрать из избранного">'.$model->favourite_count.'</i>', 
                    Yii::app()->createUrl('post/favorite'), array(
                    'type' => 'POST',
                    'data' => "js:'id-post='+$model->id",
                    'success' => 'js:function(data) {postfavsuccess(data);}',
                    'error' => 'js:function(data) {posterror();}',
                ));
            } else { 
    //  если статья не в избранном

                echo CHtml::ajaxLink('<i class="icon-heart green-a" 
                                    rel="tooltip" 
                                    title="Добавить в избранное">'.$model->favourite_count.'</i>', 
                    Yii::app()->createUrl('post/favorite'), array(
                    'type' => 'POST',
                    'data' => "js:'id-post='+$model->id",
                    'success' => 'js:function(data) {postfavsuccess(data);}',
                    'error' => 'js:function(data) {posterror();}',
                ));
            }
        }
            else echo '<i class="icon-heart" 
                                    rel="tooltip" 
                                    title="Чтобы добавить в избранное, авторизуйтесь"></i>';
    ?>

<i class="icon-star" rel="tooltip" title="Рейтинг"><?php echo $model->getraiting();?> </i>