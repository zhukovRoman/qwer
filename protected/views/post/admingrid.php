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
                'value' => 'substr($data->title,0,15)."..."',
                'sortable' => true,
            ),
            array 
            (
                'name' => "category_id",
                'value' => '$data->category->name',
                'filter' => CHtml::listData(Category::model()->findAll('parent_id=0'),
                        'id', 'name'),
                'sortable' => true,
            ),
                        
            
            array(
                'class'=>'bootstrap.widgets.BootButtonColumn',
                'template' => '{update}{view}',
                'buttons' => array(
                    'approve' => array (
                        'url' =>  "#",
                        'icon'=>"ok",
                        )
                    ),
            ),
            
        ),
    ));
 

?>


