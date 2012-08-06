<?php $path = Account::ACCOUNT_DIR . Yii::app()->user->getId() . DIRECTORY_SEPARATOR  . Account::USERPIC_NAME ;
	if (!Yii::app()->user->isGuest) $src = $path; else $src='';
	if (!file_exists($path)) $src = Account::ACCOUNT_DIR . Account::DEFAULT_DIR . Account::AVATAR_NAME; 
?>

<?php $this->widget('bootstrap.widgets.BootNavbar', array(
    'fixed'=>false,
    'brand'=>'Fresh-i',
    'brandUrl'=>Yii::app()->homeUrl,
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.BootMenu',
            'items'=>array(
            	'---',
                array('label'=>'Лекторий', 'url'=>'#'), //'active'=>true),
                array('label'=>'Правила', 'url'=>'#'),
            	array('label'=>'Блоги', 'url'=>'#'),
            	array('label'=>'Идеи', 'url'=>'#'),
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
        '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Поиск..."></form>',
    	array(
            'class'=>'bootstrap.widgets.BootMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
    		'encodeLabel'=>false,
            'items'=>array( 
            		'---',
            		//array('label' => '<img src="'.Yii::app()->request->baseUrl.'/uploads/userpic.gif" />' ),
            		array('label' => "<img src='$src' class='userpic' alt='Личный кабинет' title='Личный кабинет' width='25' height='25'>",
            			  'visible'=>!Yii::app()->user->isGuest, 'url'=> array('/account/view', 'id' => Yii::app()->user->getId()) ),
            		array('label'=> Yii::app()->user->name, //Account::model()->findByPk(Yii::app()->user->getId())->login,
                	  'url'=>'#', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
                    array('label'=> Yii::app()->user->name),
                	'---',
                    array('label'=>'Профиль', 'url'=> array('/account/view', 'id' => Yii::app()->user->getId())),
                    array('label'=>'Созданное', 'url'=>'#'),
                	array('label'=>'Избранное', 'url'=>'#'),
                	array('label'=>'Подписки', 'url'=>'#'),
                    '---',
                    array('label'=>'Выйти', 'url'=>array('/site/logout')),
                )),
                
            	//array('label'=>'Войти', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
            	
            	array('label'=>'Войти', 'url'=>'#mydialog', 'visible'=>Yii::app()->user->isGuest,
            		  'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',)),
            	
            	
            	
                '---',
            	array('label'=>'Регистрация', 'url'=>array('/account/signup/'), 'visible'=>Yii::app()->user->isGuest),
            	array('label'=>'Создать', 'url'=>'#postcreate', 'icon'=>'pencil white', 'visible'=>!Yii::app()->user->isGuest,
            		  'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',)),
            ),
        ),
    ),
)); ?>

<!-- 	<div id="mainmenu">	 -->
	<?php $this->widget('bootstrap.widgets.BootMenu', array(
	    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
	    'stacked'=>false, // whether this is a stacked menu
	    'items'=>array(
	    		array('label'=>'Спецпроекты', 'url'=>'#'),
	    		array('label'=>'Новости', 'url'=>'#'),
	    		array('label'=>'Слово', 'url'=>'#'),
	    		array('label'=>'Музыка', 'url'=>'#'),
	    		array('label'=>'Путешествия', 'url'=>'#'),
	    		array('label'=>'Фото', 'url'=>'#'),
	    		array('label'=>'Спорт', 'url'=>'#'),
	    		array('label'=>'Кино', 'url'=>'#'),
	    		array('label'=>'Hi-tech', 'url'=>'#'),
	    		array('label'=>'Книги', 'url'=>'#'),
	    		array('label'=>'Start-Up', 'url'=>'#'),
	    		array('label'=>'Афиша', 'url'=>'#'),
	    		array('label'=>'Еще', 'url'=>'#', 'items'=>array(
	    				array('label'=>'Action', 'url'=>'#'),
	    				array('label'=>'Another action', 'url'=>'#'),
	    				array('label'=>'Something else here', 'url'=>'#'),
	    				'---',
	    				array('label'=>'NAV HEADER'),
	    				array('label'=>'Separated link', 'url'=>'#'),
	    				array('label'=>'One more separated link', 'url'=>'#'),
	    		)),
	    ),
	)); ?>
<!-- </div>  --><!-- mainmenu -->

	
<!-- Модальное окно логина -->

<?php /** @var BootActiveForm $form */
	$this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'mydialog',));
	$model = new LoginForm;

$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'action' => array('site/login'),
)); 
 ?>
	 
<div class="modal-header">
    	<a class="close" data-dismiss="modal">&times;</a>
		<h3>Вход на сайт</h3>
	</div>
	
<div class="modal-body"> 
<fieldset>
	<p>Пожалуйста, заполните следующую форму для входа на наш портал!</p>
	<p><span class="label label-info">Внимание!</span>
	<i>Поля, отмеченные звездочкой <span class="required">*</span>, обязательны для заполнения.</i></p>

	<?php echo $form->textFieldRow($model, 'username', array('hint' => CHtml::link(CHtml::encode("Зарегистрироваться"), array('account/signup')))); ?>
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
