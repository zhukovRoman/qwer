<legend>
    <?php
   
        echo ($model->comment_count!=0)? "Комментарии ($model->comment_count) :"
                                : "Вы можете стать первым!" 
    ?>
   
</legend>
<div class="def-pos-form">
    <?php $this->renderPartial('/comment/create_form',array(
                'post'=>$model,
                'model'=>new Comment,
        )); ?>
</div>
<div id="comments">
    <?php $this->renderPartial('/comment/tree',array(
                'post'=>$model,
                'comments'=>$model->comments,
                'parent_id'=>null
        )); 
    ?>
</div>