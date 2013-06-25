    <?php 
					$url = $model->preview_url;
                     if ($url=="" || !file_exists($url)) $url=Post::DEF_URL;
					 
					 $link = CHtml::image($url, $data->title);
      echo CHtml::link(
          $link, 
            array('/post/view', 'id'=>$model->id)); 
    ?>
    <div class="spec">
      <?php echo CHtml::link(CHtml::encode($model->title), 
            array('/post/view', 'id'=>$model->id), array('class'=>'black-a'));?>
    </div>
