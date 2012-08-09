<?php $this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'_view',
  'itemsTagName'=>'ul',
  'template'=>'<div class="main-carousel carousel photo-border">
                <div class="carousel-inner">
                  <div class="active item">
                    <img src="http://potapov.klimgo.com/qwer/topics/2012_08_06/8759b17eeae1a84c_10_crop.jpg" alt="">
                    <div class="carousel-caption">
                      <h4>First Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                  </div>
                      <div class="item">
                        <img src="http://placehold.it/450x290&amp;text=Second+thumbnail" alt="">
                        <div class="carousel-caption">
                          <h4>Second Thumbnail label</h4>
                          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                      </div>
                      <div class="item">
                        <img src="http://placehold.it/450x290&amp;text=Third+thumbnail" alt="">
                        <div class="carousel-caption">
                          <h4>Third Thumbnail label</h4>
                          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                      </div>
                    </div>
                    <a class="carousel-control left" href="#yw0" data-slide="prev">‹</a>
                    <a class="carousel-control right" href="#yw0" data-slide="next">›</a>
                  </div>
                  {items}'
)); ?>