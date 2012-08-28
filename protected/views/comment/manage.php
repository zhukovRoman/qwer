<div class="span8">



    <legend>Работа с комментариями</legend>

    <?php 
        $this->widget('bootstrap.widgets.BootMenu', array(
            'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
            'stacked'=>false, // whether this is a stacked menu
            'items'=>array(
                array('label'=>'Все', 
                        'url'=>Yii::app()->
                                            createUrl('comment/manage',
                                                                    array ('status'=>0)),
                    'active'=> ($status==0) ? true: false,
                    ),
                array('label'=>'Нормальные', 
                        'url'=>Yii::app()->
                                            createUrl('comment/manage',
                                                                    array ('status'=>1)),
                    'active'=> ($status==1) ? true: false,
                    ),
                array('label'=>'Проверенные', 'url'=>Yii::app()->
                                                            createUrl('comment/manage',
                                                                    array ('status'=>4)),
                    'active'=> ($status==4) ? true: false,
                    ),
                array('label'=>'Спам', 'url'=>Yii::app()->
                                                            createUrl('comment/manage',
                                                                    array ('status'=>3)),
                    'active'=> ($status==3) ? true: false,
                    ),
                array('label'=>'Удаленные', 'url'=>Yii::app()->
                                                            createUrl('comment/manage',
                                                                    array ('status'=>2)),
                    'active'=> ($status==2) ? true: false,

                    ),

                )
            )); 
    ?>
    <?php $this->renderPartial('admingrid',array(
        'model'=>$model,
            'status'=>$status,
    )); ?>



</div>