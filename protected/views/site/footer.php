<div class="span2">
	<h4>Партнеры</h4>
	<img width="50px" src="/adv/az.png" alt="азкон" style="vertical-align: top;">
	<img width="50px" src="/adv/leco.png" alt="LeCoMedia">
</div>
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
    <li>  <?php echo CHtml::link(CHtml::encode('О нас'), array('/pages/view', 'id'=>2));?></li>
    <li> <?php echo CHtml::link(CHtml::encode('Контакты'), array('/pages/view', 'id'=>1));?></li>
    <li> <?php echo CHtml::link(CHtml::encode('Cоглашение'), array('/pages/view', 'id'=>3));?></li>
	<li> <a href="http://old.fresh-i.ru">Старая версия</a></li>
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
  <h6>&copy;2012</h6>
  <h5>&quot;Fresh-i&quot;</h5>
  <h2 style="background-color: #399C72; text-align:center;">18+</h2>
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
