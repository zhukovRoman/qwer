<?php 
  $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'post-grid',
        'dataProvider' => $model->searchModer($status),
        'filter' => $model,
        'columns' => array(
            
            array(
                'name'=>'time_add',
                'sortable' => true,
                'value' => 'date("d-m-Y", strtotime($data->time_add))',
                'filter'=>false,
                
            ),
            array(
                //Это и есть вывод названия меню из связанной таблицы
                'name' => 'author_id',
                //'filter' => CHtml::listData(SubmenuParts::model()->findAll(), 'id', 'part_name'),
                'value' => '$data->author->login',
                'sortable' => true,
            ),
            array(
                //Это и есть вывод названия меню из связанной таблицы
                'name' => 'title',
                //'filter' => CHtml::listData(SubmenuParts::model()->findAll(), 'id', 'part_name'),
                'value' => 'mb_substr($data->title,0,15, "UTF-8")."..."',
                'sortable' => true,
            ),
            array 
            (
                'name' => "category_id",
                'value' => '$data->category->name',
                'filter' => CHtml::listData(Category::model()->findAll('parent_id=0'),
                        'id', 'name'),
                'sortable' => true,
                'htmlOptions'=>array('width'=>'100px'),
            ),
             array 
            (
                'name' => "sub_cat_id",
                'value' => '($data->sub_cat_id!=NULL)? $data->subCat->name: ""',
                'filter' => ($model->category_id==NULL) ? CHtml::listData(Category::model()->findAll('parent_id!=0'),'id','name') :
                                CHtml::listData(Category::model()->findAll('parent_id=:par',array(':par'=>$model->category_id)),
                        'id', 'name'),
                'sortable' => false,
            ),
                        
            
            array(
                'class'=>'bootstrap.widgets.BootButtonColumn',
                'template' => '{update}{view}{approve}',
                'buttons' => array(
                    'approve' => array (
                        'label'=>'approve',
                        'url' =>  'Yii::app()->createUrl("post/approve", array ("id"=>$data->id));',
                        'icon'=>"ok",
                        ),
                    'time'=> array(
                        'label'=>'app and time',
                        'ajax' => true,
                        'click' =>  'function(){alert (123);}',
                        'icon'=>"time",
                    )
                    ),
                'htmlOptions'=>array('width'=>'70px'),
            ),
            
        ),
    ));
 

?>


