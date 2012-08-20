<div class="<?php echo ($i==0)? "active" : "" ?> item">
                    <?php echo CHtml::image($item->preview_url);?>
                    
                    <div class="carousel-caption">
                        <h4><?php echo CHtml::encode($item->title);?></h4>
                      <p><?php echo CHtml::encode($item->subtitle);?></p>
                    </div>
</div>
