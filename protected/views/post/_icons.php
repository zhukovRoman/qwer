<i class="icon-user" rel="tooltip" title="автор"></i>
<b><?php echo CHtml::link($model->author->login, 
    Yii::app()->createUrl('account/view',
    array ("id"=>$model->author->id))); ?>
</b>
&nbsp;
<i class="icon-time" rel="tooltip" title="дата публикации"></i>
<?php echo date ("d/m/Y", strtotime($model->time_add));?>
&nbsp;
<i class="icon-star" rel="tooltip" title="рейтинг"><?php echo $model->getraiting();?> </i>
<i class="icon-comment" rel="tooltip" title="число комментариев"><?php echo  $model->comment_count;?> </i>
<i class="icon-eye-open" rel="tooltip" title="число просмотров"><?php echo  $model->view_count;?> </i>
<?php 
if (Post::inFavorite($model->id))
{
//если статья уже в избранном 
 
    echo CHtml::ajaxLink('<i class="icon-heart gray-a" 
                                rel="tooltip" 
                                title="убрать из избранного">'.$model->favourite_count.'</i>', 
                Yii::app()->createUrl('post/favorite'), array(
                'type' => 'POST',
                'data' => "js:'id-post='+$model->id",
                'success' => 'js:function(data) {postfavsuccess(data);}',
                'error' => 'js:function(data) {posterror();}',
            ));
        } else { 
//  если статья не в избранном

            echo CHtml::ajaxLink('<i class="icon-heart black-a" 
                                rel="tooltip" 
                                title="добавить в избранное">'.$model->favourite_count.'</i>', 
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
    <?php echo $model->favourite_count; ?>

