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
    

    <?php
    if (Yii::app()->user->checkAccess('commentModeration')) {
        
        ($model->status_id!=2)? 
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
        )): 
        $this->widget('bootstrap.widgets.BootButton', array(
            'buttonType' => 'button',
            'type' => 'info',
            'size' => 'mini',
            'label' => 'Восстановить',
            'htmlOptions' => array(
                'id' => "delete-btn-$model->id",
                'class' => 'restore-btn',
                'ajax' => array(
                    'type' => 'POST',
                    'data' => "js:'id-comment='+$model->id",
                    'url' => Yii::app()->createUrl('comment/restore'),
                    'success' => "js:function(data) {}",
                ),
            )
        ))
        ;
    }
    ?> 
</div>
