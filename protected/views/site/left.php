
<?php 
  $spec = Post::getSpecProj();
  if ($spec!=null)
  {
   echo '<h3><i class="icon-bullhorn icon-large">&nbsp;Выбор редакции</i></h3>';   
echo '<div class="green-border content-border">';
  $this->renderPartial("/site/specpost", array ('model'=> $spec)); 
echo '</div>';
  }
  ?>
  <div id="vk_groups" style="margin-bottom: 5px;" ></div>
<!--<img src="http://placehold.it/220x300" alt=""> -->