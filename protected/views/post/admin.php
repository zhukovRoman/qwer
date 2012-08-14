<div class="span9">
  <?php

  Yii::app()->clientScript->registerScript('search', "
  $('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
  });
  $('.search-form form').submit(function(){
    $.fn.yiiGridView.update('post-grid', {
      data: $(this).serialize()
    });
    return false;
  });
  ", CClientScript::POS_END);
  ?>

  <legend>Модерация</legend>



  <?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
  <div class="search-form" style="display:none">
  <?php $this->renderPartial('_search',array(
    'model'=>$model,
  )); ?>
  </div><!-- search-form -->

  <?php $this->widget('bootstrap.widgets.BootGridView',array(
    'id'=>'post-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(

                  array(            // display 'create_time' using an expression
                      'name'=>'category_id',
                      'value'=>$model->title,
                  ),
                  array(            // display 'create_time' using an expression
                      'name'=>'id',
                      'value'=>$model->title,
                  ),


      array(
        'class'=>'bootstrap.widgets.BootButtonColumn',
      ),
    ),
  )); ?>

</div>
