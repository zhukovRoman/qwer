
<?php
    foreach ($comments as $comm)
    {
        if ($comm->parent_id==$parent_id)
        {
    ?>
        
    <?php 
            $this->renderPartial("/comment/tree_item", 
                        array('model'=>$comm,));
        }
        
    }

?>
