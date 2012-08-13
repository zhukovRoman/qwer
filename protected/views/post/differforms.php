<?php

if ($model->is_video) {
    echo $this->renderPartial('create_video', array('model' => $model,
        'form' => $form));
}
if ($model->is_photoset) {
    echo $this->renderPartial('create_photo', array('model' => $model,
        'form' => $form));
}
if (!$model->is_photoset && !$model->is_video) {
    echo $this->renderPartial('create_text', array('model' => $model,
        'form' => $form));
}
?>