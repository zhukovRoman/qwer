<div class="span5 content-border">
  <legend>Прямой эфир</legend>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#discussed" data-toggle="tab">Обсуждаемое</a></li>
    <li><a href="#best" data-toggle="tab">Лучшие высказывания</a></li>
    <li><a href="#afisha" data-toggle="tab">Афиша</a></li>
  </ul>
  <div class="tab-content fix-tabs">
    <div class="tab-pane active" id="discussed">
      <?php 
        $this->renderPartial ('/post/discussed', array ('items'=> Post::getDiscussed())); 
      ?>
    </div>
    <div class="tab-pane" id="best">
      <?php 
        $this->renderPartial ('/comment/best', array ('items'=> Comment::getBest())); 
      ?>
    </div>
    <div class="tab-pane" id="afisha">
      Афиша на сегодня 0о
    </div>
  </div>
</div>
<div class="span5 content-border" style="margin-left: 6px">
  <legend>Спецпроекты</legend>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#babushka" data-toggle="tab">Бабушка Пушкина</a></li>
    <li><a href="#life" data-toggle="tab">Start-Up Life</a></li>
  </ul>
  <div class="tab-content fix-tabs">
    <div class="tab-pane active" id="babushka">
      Бабушка Пушкина Бабушка Пушкина м Бабушка Пушкина
    </div>
    <div class="tab-pane active" id="life">
      Start-Up Life
    </div>
  </div>
</div>