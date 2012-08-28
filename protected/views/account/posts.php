<legend><?php echo $model->login; ?></legend>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills',  // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Профиль', 'url'=>Yii::app()->
                                            createUrl('/account/view',
                                                                    array ('id'=>$model->id))),
        array('label'=>'Созданное', 'url'=>Yii::app()->
                                            createUrl('/account/created',
                                                                    array ('id'=>$model->id))),
        array('label'=>'Избранное','url'=>Yii::app()->
                                            createUrl('/account/fav',
                                                                    array ('id'=>$model->id))),
    	
    ),
)); ?>



<?php 

  $this->widget('bootstrap.widgets.BootListView', array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'/post/_view',
  'itemsTagName'=>'ul',
  'ajaxUpdate'=>false,
  'baseScriptUrl'=>Yii::app()->request->baseUrl.'/js',
  'template' => '{items}<div class="clearfix"> </div>{pager}'
)); ?>