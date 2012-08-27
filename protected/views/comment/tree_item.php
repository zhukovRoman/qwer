<?php if ($model->status_id != 2){
   $this->renderPartial("/comment/tree_item_part", array('model' => $model,));
}; ?>
