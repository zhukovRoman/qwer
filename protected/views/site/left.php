<h3><i class="icon-bullhorn icon-large">&nbsp;Выбор редакции</i></h3>
<?php 
  $spec = Post::getSpecProj();
  if ($spec!=null)
  {
      
echo '<div class="green-border">';
  $this->renderPartial("/site/specpost", array ('model'=> $spec)); 
echo '</div>';
  }
  ?>
  <img src="css/img/vk.png" alt="">
<img src="http://placehold.it/220x700" alt="">