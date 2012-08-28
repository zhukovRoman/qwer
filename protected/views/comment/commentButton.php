<div class="comment-resp">
    <?php
    if (Yii::app()->user->checkAccess('addComment')) {
    $this->widget('bootstrap.widgets.BootButton', array(
        'buttonType' => 'button',
        'type' => 'primary',
        'size' => 'mini',
        'label' => 'Oтветить',
        'htmlOptions' => array(
            'id' => 'replay-button' . $model->id,
            'class' => 'button-replay',
        )
            )
    ); }
    ?> 
    <span id="spam-link-<?php echo $model->id; ?> ">
        <?php
        if (Yii::app()->user->checkAccess('commentVote')) {
            $this->widget('bootstrap.widgets.BootButton', array(
                'buttonType' => 'button',
                'type' => 'warning',
                'size' => 'mini',
                'label' => 'Спам',
                'htmlOptions' => array(
                    'id' => "spam-btn-$model->id",
                    'class' => 'spam-btn',
                    'ajax' => array(
                        'type' => 'GET',
                        'data' => "js:'id-comment='+$model->id",
                        'url' => Yii::app()->createUrl('comment/spam'),
                        'update' => '#commentbody-' . $model->id,
                    ),
                )
            ));
        }
        ?>
    </span>

    <?php
    if (Yii::app()->user->checkAccess('commentModeration')) {
        $this->widget('bootstrap.widgets.BootButton', array(
            'buttonType' => 'button',
            'type' => 'danger',
            'size' => 'mini',
            'label' => 'Удалить',
            'htmlOptions' => array(
                'id' => "delete-btn-$model->id",
                'class' => 'delete-btn',
                'ajax' => array(
                    'type' => 'POST',
                    'data' => "js:'id-comment='+$model->id",
                    'url' => Yii::app()->createUrl('comment/delete'),
                    'success' => "js:function(data) {show_preview(data);}",
                ),
            )
        ));
    }
    ?> 
</div>
