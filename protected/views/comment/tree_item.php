<div class="comment-item" 
     id ="<?php echo $model->id; ?>" 
     parent-id ="<?php echo $model->parent_id; ?>"
     is_hide="0">
         <?php
         $this->renderPartial("/comment/tree_item_header", array('model' => $model,));
         ?>
    <div class="comment-body content-border" id="comment-<?php echo $model->id; ?>">
        <div class="comment_text" >
            <?php
            if ($model->status_id == 2) {
                echo "<div style='color:red'> Коммнетарий удален </div>";
                echo Chtml::encode($model->text);
            }
            if ($model->status_id == 3) {
                echo CHtml::encode('Здесь был спам!');
            }
            if ($model->status_id == 1 || $model->status_id == 4) {
                     echo CHtml::encode($model->text);
                 }
            ?>
        </div>
    <?php if (!(Yii::app()->user->isGuest || $model->status_id == 2)) { ?>
        <div class="comment-resp">
            <?php
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
            );
            ?> 
            <span id="spam-link-<?php echo $model->id; ?> ">
                <?php
                $this->widget('bootstrap.widgets.BootButton', array(
                'buttonType' => 'button',
                'type' => 'warning',
                'size' => 'mini',
                'label' => 'Спам',
                'htmlOptions' => array(
                    'ajax' => array(
                        'type' => 'POST',
                        'data' => "js:'id-comment='+$model->id",
                        'url' => Yii::app()->createUrl('comment/spam'),
                        'update' => '#commentbody-' . $model->id,
                    ),
                )
            ));
            ?>
            </span>

            <?php
            $this->widget('bootstrap.widgets.BootButton', array(
                'buttonType' => 'button',
                'type' => 'danger',
                'size' => 'mini',
                'label' => 'Удалить',
                'htmlOptions' => array(
                    'ajax' => array(
                        'type' => 'POST',
                        'data' => "js:'id-comment='+$model->id",
                        'url' => Yii::app()->createUrl('comment/delete'),
                        'success' => "js:function(data) {show_preview(data);}",
                    ),
                )
            ));
            ?> 
        </div>
    <?php }; ?>
    </div>
    <div id="reply-<?php echo $model->id; ?>"></div>
    <?php
    $this->renderPartial('/comment/tree', array(
        'comments' => $model->comments,
        'parent_id' => $model->id));
    ?>
</div>