<h1>
<!--    <img src="<?php echo "images/category/$category->name.jpg";?>">-->
    <?php echo $category->name;?>
</h1>
      <div class="article-title">
        <a class="subcat" href="#">Подробнее</a>
        <hr>
          <div class="description">
            <?php echo $category->description; ?>   
          </div>
          <?php if (count($category->getSubCats($category) )!=0){ ?>
           <ul class="breadcrumb span8">
            <?php 
                foreach ($category->getSubCats($category) as $cat)
               {
                    echo '<li>&emsp;'.CHtml::link('&sect'.$cat->name, 
                               Yii::app()->createUrl('category/subcatview',
                                            array ("id"=>$cat->id)));'</li>';
                }
            ?>
          <?php } ?>
          </ul>
          <div class="clearfix"></div>
    </div>
    

<?php $this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'/post/_view',
  'itemsTagName'=>'ul',
  'cssFile'=>false,
  'ajaxUpdate'=>false,
  'baseScriptUrl'=>Yii::app()->request->baseUrl.'/js',
)); ?>
