<img src="css/img/vk.png" alt="">
<?php 
  $spec = Post::getSpecProj();
  if ($spec!=null)
  {
      
echo '<div class="green-border">';
  $this->renderPartial("/site/specpost", array ('model'=> $spec)); 
echo '</div>';
  }
  ?>
<img src="http://placehold.it/220x700" alt="">