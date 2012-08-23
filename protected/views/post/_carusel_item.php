<div class="<?php echo ($i==0)? "active" : "" ?> item">
                   <?php echo CHtml::link(
					CHtml::image($item->preview_url),
						array('/post/view', 'id'=>$item->id)); 
                    ?>
                    <div class="carousel-caption">
                        <?php echo CHtml::link(CHtml::encode($item->title), 
						array('/post/view', 'id'=>$item->id));?>
                      <p><?php echo CHtml::encode($item->subtitle);?></p>
                    </div>
</div>
