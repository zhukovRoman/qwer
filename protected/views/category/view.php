<legend><?php echo $category->name;?></legend>

<?php $this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'/post/_view',
  'itemsTagName'=>'ul',
  'cssFile'=>false,
  'ajaxUpdate'=>false,
  'baseScriptUrl'=>Yii::app()->request->baseUrl.'/js',
)); ?>
