<?php 
    if ($model->is_video)
    {
        echo $this->renderPartial('video_view', array('model'=>$model));
    }
    if ($model->is_photoset)
    {
        echo $this->renderPartial('photoset_view', array('model'=>$model));
    }
    if (!$model->is_photoset&& !$model->is_video)
    {
        echo $this->renderPartial('text_view', array('model'=>$model));
    }
?>



