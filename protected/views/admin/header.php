<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Пользователи', 'url'=>Yii::app()->createUrl('/account/admin')),
        array('label'=>'Посты', 'url'=>Yii::app()->createUrl('/post/manage')),
        array('label'=>'Комментарии', 'url'=>Yii::app()->createUrl('/comment/manage')),
        array('label'=>'Категории', 'url'=>Yii::app()->createUrl('/category/manage')),
    ),
)); ?>

