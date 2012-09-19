<?php $path = Account::ACCOUNT_DIR . Yii::app()->user->getId() . DIRECTORY_SEPARATOR  . Account::USERPIC_NAME ;
	if (!Yii::app()->user->isGuest) $src = $path; else $src='';
	if (!file_exists($path)) $src = Account::ACCOUNT_DIR . Account::DEFAULT_DIR . Account::AVATAR_NAME; 
	
        if (!Yii::app()->user->isGuest)
      $menu = array(
                array('label'=> Account::model()->findByPk(Yii::app()->user->getId())->login),
                '---',
                array('label'=>'Профиль', 'url'=> array('/account/view', 'id' => Yii::app()->user->getId())),
                array('label'=>'Созданное', 'url'=>Yii::app()->
                                                    createUrl('/account/created',
                                                    array ('id'=>Yii::app()->user->getId()))),
                array('label'=>'Избранное', 'url'=>Yii::app()->
                                                    createUrl('/account/fav',
                                                    array ('id'=>Yii::app()->user->getId()))),
                //array('label'=>'Подписки', 'url'=>'#'),


                '---',
                array('label'=>'Выйти', 'url'=>array('/site/logout')));  
      if (Yii::app()->user->checkAccess('moderatePost'))
      { 
        $menu[] = '---';
        $menu[] = array('label'=>'Админка', 'url'=>Yii::app()->  createUrl('/moderator/')); 
      }
	// Формируем бар меню в зависимости от того, кем является посетитель (гость/авторизованный) 
	$bar = array();
	array_push($bar,'---');
	if (!Yii::app()->user->isGuest) 
	{
		//array_push($bar,array('label'=>'Rights', 'url'=>array( '/rights' ),
				//'visible'=>Yii::app()->user->checkAccess(Rights::module()->superuserName ) 
		//));
		
/*		array_push($bar, array('label' => "<img src='$src' class='userpic content-border' alt='Личный кабинет' title='Личный кабинет' width='25' height='25'>", 
							   'url'=> array('/account/view', 'id' => Yii::app()->user->getId())));*/
				
		array_push($bar, array('label'=> "<img src='$src' class='userpic content-border' alt='Личный кабинет' title='Личный кабинет' width='25' height='25'>", 
                 'url'=> array('/account/view', 'id' => Yii::app()->user->getId()),//Account::model()->findByPk(Yii::app()->user->getId())->login, 
							   'items'=>$menu));
		array_push($bar, '---');
		
		array_push($bar, array('label'=>'Создать', 'icon'=>'pencil white', 
							 //'url'=>'#postcreate', 'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',)));
							   'items' => array(
							   			  array('label'=>'Выберите тип:'),
								          array('label'=>'Статья', 'icon'=>'pencil', 'url'=> Yii::app()->createUrl('/post/create'),),
								          array('label'=>'Видео', 'icon'=>'film', 'url'=> Yii::app()->createUrl('/post/createvideo')),
								          array('label'=>'Фотоотчет', 'icon'=>'camera', 'url'=>Yii::app()->createUrl('/post/createphoto')))));
							  
	}
	else
	{
		array_push($bar, array('label'=>'Войти', // 'url'=>array('/site/login/'),));//modal_login
							   'url'=>'#modal_login', 'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary')));
		array_push($bar, '---');
		array_push($bar, array('label'=>'Регистрация', 'url'=>array('/account/signup/'), 'visible'=>Yii::app()->user->isGuest));
	}
?>

<?php $this->widget('bootstrap.widgets.BootNavbar', array(
    'fixed'=>false,
    'brand'=>' ',
    'brandUrl'=>Yii::app()->homeUrl,
    'collapse'=>false, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.BootMenu',
			'htmlOptions'=>array('class'=>'l-nav'),
            'items'=>array(
            	'---',
                array('label'=>'О нас', 'url'=>array('/site/page', 'view'=>'about')), //'active'=>true),
//                array('label'=>'Правила', 'url'=>'#'),
//            	array('label'=>'Блоги', 'url'=>'#'),
//            	array('label'=>'Идеи', 'url'=>'#'),
               /* array('label'=>'Еще', 'url'=>'#', 'items'=>array(
                    array('label'=>'Action', 'url'=>'#'),
                    array('label'=>'Another action', 'url'=>'#'),
                    array('label'=>'Something else here', 'url'=>'#'),
                    '---',
                    array('label'=>'NAV HEADER'),
                    array('label'=>'Separated link', 'url'=>'#'),
                    array('label'=>'One more separated link', 'url'=>'#'),
                )),*/
            ),
        ),
    	array(
            'class'=>'bootstrap.widgets.BootMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
    		'encodeLabel'=>false,
            'items'=> $bar
        ),
    ),
)); ?>
<!--<form class="navbar-search pull-right span2 bg-black" action="<?php // echo Yii::app()->urlManager->createUrl('site/search'); ?>" method="get">
    <input type="text" class="span2" placeholder="Поиск..." name="find">
    <input type="submit" value="Отправить">
</form>-->

    <?php 
 //echo CHtml::beginForm(array('site/search'), 'get', array('class'=> 'navbar-search pull-right span2 bg-black')) .
  //    CHtml::textField('q', '', array('placeholder'=> 'Поиск...','class'=>'span2')) .
  //    CHtml::endForm('');
    ?>

<!-- 	<div id="mainmenu">	 -->
	<?php $this->widget('bootstrap.widgets.BootMenu', array(
	    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
	    'stacked'=>false, // whether this is a stacked menu
		'htmlOptions'=>array('class'=>'nav-head span12 bg-black'),
	    'items'=>  Category::getCategories(),
	)); ?>
<div style="clear:both"></div>
<!-- </div>  --><!-- mainmenu -->

	
<!-- files with modalwindow, ajax calls etc for easier reading -->
	<?php echo $this->renderPartial('//site/modal_login'); ?>
	<?php //echo $this->renderPartial('//site/modal_create');?>

<!-- ********************************************************  -->
<!-- *** 				   Модальные окна 				  ***  -->	
<!-- ********************************************************  -->
	
		
<!-- Модальное окно логина -->

<?php /** @var BootActiveForm $form */
/*	$this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'mydialog',));
	$model = new LoginForm;

$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
			'validateOnChange'=>true,
	),
	'action' => array('site/login'),
)); 
 ?>
	 
<div class="modal-header">
    	<a class="close" data-dismiss="modal">&times;</a>
		<h3>Добро пожаловать!</h3>
	</div>
	
<div class="modal-body"> 
<fieldset>
	<p>Пожалуйста, заполните следующую форму для входа на наш портал!</p>
	<p><span class="label label-info">Внимание!</span>
	<i>Поля, отмеченные звездочкой <span class="required">*</span>, обязательны для заполнения.</i></p>

	<?php echo $form->textFieldRow($model, 'username', array('hint' => CHtml::link(CHtml::encode("Зарегистрироваться"), array('account/signup')),  ) ); ?>
    <?php echo $form->passwordFieldRow($model,'password', array('hint' => CHtml::link(CHtml::encode("Забыли пароль?"), array('account/passrecovery')))); ?>
    <?php echo $form->checkBoxRow($model, 'rememberMe'); ?>
</fieldset> 	
</div> 

<div class="modal-footer">
    	<?php $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'submit', 
    			'type'=>'primary', 
    			'icon'=>'ok white', 
    			'label'=>'Войти'
    			)
    	); ?>
</div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>
	

<!-- Модальное окно Создания поста -->

<?php 	$this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'postcreate',));
		$model = new LoginForm; ?>

<div class="modal-header">
    	<a class="close" data-dismiss="modal">&times;</a>
    	<h3>Создание</h3>
</div>
 
<div class="modal-body"> 

<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'Статья', 'icon'=>'pencil', 'url'=> Yii::app()->createUrl('/post/create'),),
        array('label'=>'Видео', 'icon'=>'film', 'url'=>Yii::app()->createUrl('/post/createvideo')),
        array('label'=>'Фотоотчет', 'icon'=>'camera', 'url'=>'#'),
    ),
)); ?>
	
</div>
 
<div class="modal-footer">
    	<?php $this->widget('bootstrap.widgets.BootButton', array(
		    'icon'=>'remove', 
		    'label'=>'Отмена',
		    'type'=>'close',
      	 	'htmlOptions'=>array('data-dismiss'=>'modal'),
    	)); ?>
</div>
                
<?php
    $this->endWidget();
?>
*/ ?>
