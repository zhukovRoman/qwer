<legend><img src="<?php echo "images/category/$category->name.jpg";?>"><?php echo $category->name;?></legend>
<div>
    <?php echo $category->description; ?> 
    <?php 
        foreach ($category->getSubCats($category) as $cat)
        {
            echo CHtml::link($cat->name, 
                        Yii::app()->createUrl('category/subcatview',
                                    array ("id"=>$cat->id)));
        }
    ?>
</div>

<?php $this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'/post/_view',
  'itemsTagName'=>'ul',
  'cssFile'=>false,
  'ajaxUpdate'=>false,
  'baseScriptUrl'=>Yii::app()->request->baseUrl.'/js',
)); ?>
