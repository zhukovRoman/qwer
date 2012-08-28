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
        <?php  $this->renderPartial('/comment/commentButton', 
                array('model' => $model)); ?>
    </div>
    <div id="reply-<?php echo $model->id; ?>"></div>
    <?php $this->renderPartial('/comment/tree', array(
        'comments' => $model->comments,
        'parent_id' => $model->id));
    // не выводить у удаленных
    $this->renderPartial('/comment/tree', array(
        'comments' => $model->comments,
        'parent_id' => $model->id));
    ?>
</div>