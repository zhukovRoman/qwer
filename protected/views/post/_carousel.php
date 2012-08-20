<?php 
$carusel = $this->renderPartial('/post/best_carusel', array('best'=>Post::getBest(),), true);
$this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'_view',
  'itemsTagName'=>'ul',
  'cssFile'=>false,
  'ajaxUpdate'=>false,
  'baseScriptUrl'=>Yii::app()->request->baseUrl.'/js',
  'template'=>"$carusel{items}",  
)); ?>