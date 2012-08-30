    <?php 
      echo CHtml::link(
          CHtml::image($model->preview_url), 
            array('/post/view', 'id'=>$model->id)); 
    ?>
    <div class="spec">
      <?php echo CHtml::link(CHtml::encode($model->title), 
            array('/post/view', 'id'=>$model->id), array('class'=>'black-a ellipsis'));?>
    </div>
