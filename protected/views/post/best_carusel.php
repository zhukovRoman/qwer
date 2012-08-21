
<div class="main-carousel carousel photo-border">
                <div class="carousel-inner">
                  <?php 
                  $i=0;
                  foreach ($best as $item)
                  {
                    $this->renderPartial ('/post/_carusel_item', array ('item'=>$item, 'i'=>$i++));  
                  }
                  ?>
                </div>
                    <a class="carousel-control left" href="#yw0" data-slide="prev">‹</a>
                    <a class="carousel-control right" href="#yw0" data-slide="next">›</a>
</div>

