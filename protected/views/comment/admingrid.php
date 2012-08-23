<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->searchModer($status),
	'filter'=>$model,
	'columns'=>array(
             array(
                'name'=>'time_add',
                'sortable' => true,
                'value' => 'date("d-m-Y", strtotime($data->time_add))',
                'filter'=>false,
                 'htmlOptions'=>array('width'=>'100px'),
                
            ),
             array(
                'name'=>'text',
                'value' => 'mb_substr($data->text,0,15,"UTF-8")',
                 'htmlOptions'=>array('width'=>'370px'),
                 ),
             array(
                'name'=>'author_id',
                'value' => 'mb_substr($data->author->login,0,15,"UTF-8")',
                ),
             array(
                'name'=>'post_id',
                'value' => 'mb_substr($data->post->title,0,12,"UTF-8")',
                ),
            array(
                'name'=>'status_id',
                'value' => '$data->status->title',
                 'filter' => ($status==0) ? CHtml::listData(CommentStatus::model()->findAll(),'id','title') :
                                CHtml::listData(CommentStatus::model()->findAll('id=:par',array(':par'=>$status)),
                        'id', 'title'),
                ),
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
                        'template' => '{view}{spam}{nospam}{del}',
                        'buttons' => array(
                            'spam' => array (
                                'label'=>'spam',
                                'url' =>  'Yii::app()->createUrl("comment/itisspam",
                                    array ("id"=>$data->id));',
                                'click' => 'js:function() 
                                    {item_click( $(this).attr("href") ); 
                                        return false;}',
                                'icon'=>"ban-circle",
                                ),
                             'view' => array (
                                'label'=>'view',
                                'url' =>  'Yii::app()->createUrl("post/view",
                                    array ("id"=>$data->post->id))."#".$data->id;',
                                'icon'=>"eye-open",
                                ),
                            'nospam' => array (
                                'label'=>'Nospam',
                                'url' =>  'Yii::app()->createUrl("comment/itIsNoSpam",
                                    array ("id"=>$data->id));',
                                'click' => 'js:function() 
                                    {item_click( $(this).attr("href") ); 
                                        return false;}',
                                'icon'=>"ok-circle",
                                ),
                            'del' => array (
                                'label'=>'delete',
                                'url' =>  'Yii::app()->createUrl("comment/toarchive",
                                    array ("id"=>$data->id));',
                                'click' => 'js:function() 
                                    {item_click( $(this).attr("href") ); 
                                        return false;}',
                                'icon'=>"trash",
                                ),
                            ),
                        'htmlOptions'=>array('width'=>'70px'),
		),
	),
)); ?>

<script type="text/javascript">
function item_click(url) {
        
        var id = parseInt(url.substring(url.indexOf('id=') + 3), 10);

        $.fn.yiiGridView.update('comment-grid', {
                type :'POST',
                url  : url,
                data : id,
                success:function(data) {
                        $.fn.yiiGridView.update('comment-grid');
                        //alert(data);
                }
        });
}

</script>
