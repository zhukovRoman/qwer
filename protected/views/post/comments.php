<?php if (!Yii::app()->user->isGuest) { ?>
<legend>
    <?php
    echo ($model->comment_count != 0) ? "Комментарии ($model->comment_count) :" : "Вы можете стать первым!"
    ?>

</legend>
    <div class="btn comment-btn">Написать комментарий</div>
    <div class="def-pos-form">
    <?php
    $this->renderPartial('/comment/create_form', array(
        'post' => $model,
        'model' => new Comment,
    ));
    ?>
    </div>
 <?php }; ?>
<div id="comments">
    <?php
    $this->renderPartial('/comment/tree', array(
        'post' => $model,
        'comments' => $model->comments,
        'parent_id' => null
    ));
    ?>
</div>