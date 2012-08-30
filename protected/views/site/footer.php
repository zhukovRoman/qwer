<div class="span2">
  <h4>Пользователь</h4>
  <ul class="items">
  <?php    
  if (!Yii::app()->user->isGuest) {     
        echo '<li>'.CHtml::link(CHtml::encode('Профиль'), array('/account/view', 'id' => Yii::app()->user->getId())).'</li>';
        echo '<li>'.CHtml::link(CHtml::encode('Созданное'), array('/account/created', 'id' => Yii::app()->user->getId())).'</li>';
        echo '<li>'.CHtml::link(CHtml::encode('Избранное'), array('/account/fav', 'id' => Yii::app()->user->getId())).'</li>';
        echo '<li>'.CHtml::link(CHtml::encode('Выйти'), array('/site/logout')).'</li>';      
  } else {
        echo '<li>'.CHtml::link(CHtml::encode('Войти'), array('/#modal_login'), array('data-toggle'=>'modal', 'type'=>'primary')).'</li>';
        echo '<li>'.CHtml::link(CHtml::encode('Регистрация'), array('/account/signup')).'</li>';
  }
?>
</ul>
</div>
<div class="span2">
  <h4>О сайте</h4>
  <ul class="items">
    <li>  <?php echo CHtml::link(CHtml::encode('О нас'), array('/site/page', 'view'=>'about'));?></li>
    <li> <?php echo CHtml::link(CHtml::encode('Контакты'), array('/site/page', 'view'=>'contacts'));?></li>
    <li> <?php echo CHtml::link(CHtml::encode('Cоглашение'), array('/site/page', 'view'=>'license'));?></li>
  </ul>
</div>
<div class="span4">
  <h4>Контакты в соцсетях</h4>
  <ul class="items">
    <li><a href="http://vk.com/fresh_i">ВКонтакте</a></li>
    <li><a href="http://twitter.com/fresh_iru">Twitter</a></li>
    <li><a href="http://www.facebook.com/pages/Fresh-i/352947024776701">Facebook</a></li>
  </ul>
</div>
<div class="span1">
  <br>
  <h6>&copy;2012</h6>
  <h5>&quot;Fresh-i&quot;</h5>
</div>


<?php  

/*echo Yii::app()->user->role;

if(Yii::app()->user->checkAccess('administrator'))
{
	echo Yii::app()->user->getId();
	echo "hello, I'm administrator";
	//echo $params["Account"]->id;
	
}*/

?>
