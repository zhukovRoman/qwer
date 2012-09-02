

<?php 

  $this->widget('bootstrap.widgets.BootListView', array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'/post/_view',
  'itemsTagName'=>'ul',
  'ajaxUpdate'=>false,
  'baseScriptUrl'=>Yii::app()->request->baseUrl.'/js',
  'template' => '{items}<div class="clearfix"> </div>{pager}'
)); ?>
