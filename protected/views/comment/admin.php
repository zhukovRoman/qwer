

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
             array(
                'name'=>'text',
                'value' => 'mb_substr($data->text,0,10,"UTF-8")',
                'sortable'=>true,
                 ),
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
