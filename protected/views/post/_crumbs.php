<?php echo CHtml::link($model->category->name, 
                        Yii::app()->createUrl('category/view',
                                    array ("id"=>$model->category->id))); ?>

<?php if ($model->subCat!=NULL) {echo " / ".
            CHtml::link($model->subCat->name, 
                        Yii::app()->createUrl('category/view',
                                    array ("id"=>$model->subCat->id))); }?>