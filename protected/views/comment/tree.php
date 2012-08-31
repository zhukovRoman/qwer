<?php

if (Yii::app()->user->checkAccess('commentModeration')) {
// //админский вид
    foreach ($comments as $comm) {
        if ($comm->parent_id == $parent_id ) {
            $this->renderPartial("/comment/tree_item", array('model' => $comm,));
        }
    }
}
else {
    foreach ($comments as $comm) {
     if ($comm->parent_id == $parent_id && $comm->status_id !=2) {
            $this->renderPartial("/comment/tree_item", array('model' => $comm,));
        }
    }
}
?>
