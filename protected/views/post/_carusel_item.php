<div class="<?php 
                $url = $item->preview_url;
                if ($url=="" || !file_exists($url)) $url=Post::DEF_URL;
                   echo ($i==0)? "active" : "" ?> item">
                   <?php echo CHtml::link(
					CHtml::image($url),
						array('/post/view', 'id'=>$item->id)); 
                    ?>
                    <div class="carousel-caption">
                        <h4><?php echo CHtml::link(CHtml::encode($item->title), 
                  array('/post/view', 'id'=>$item->id), array('class'=>'ellipsis green-a'));?></h4>
                      <p><?php echo CHtml::encode((mb_substr($item->subtitle, 0, 100, 'utf-8'))."...");?></p>
                          <div class="main-user">
                            <b><?php echo CHtml::link('<i class="icon-user" rel="tooltip" title="автор">&nbsp;</i>'.substr($item->author->login, 0, 14),
                                Yii::app()->createUrl('account/view',
                                array ("id"=>$item->author->id)), array('class'=>'green-a')); ?></b>
                          </div>
                          <i class="icon-star" rel="tooltip" title="рейтинг"></i>
                          <?php echo CHtml::encode($item->getraiting());?>
                          <i class="icon-comment" rel="tooltip" title="число комментариев"></i>
                          <?php echo CHtml::encode($item->comment_count);?> 
                    </div>
</div>
