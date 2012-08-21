<?php $path = Account::ACCOUNT_DIR . Yii::app()->user->getId() . DIRECTORY_SEPARATOR  . Account::USERPIC_NAME ;
	if (!Yii::app()->user->isGuest) $src = $path; else $src='';
	if (!file_exists($path)) $src = Account::ACCOUNT_DIR . Account::DEFAULT_DIR . Account::AVATAR_NAME; 
?>

<?php $this->widget('bootstrap.widgets.BootNavbar', array(
    'fixed'=>false,
    'brand'=>'<img src="http://fresh-i.ru/templates/skin/simple/images/logo.png">',
    'brandUrl'=>Yii::app()->homeUrl,
    'collapse'=>false, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.BootMenu',
            'htmlOptions'=>array('class'=>'l-nav'),
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
    	array(
            'class'=>'bootstrap.widgets.BootMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
    		'encodeLabel'=>false,
            'items'=>array( 
            		'---',
            		//array('label' => '<img src="'.Yii::app()->request->baseUrl.'/uploads/userpic.gif" />' ),
            		array('label' => "<img src='$src' class='userpic photo-border' alt='Личный кабинет' title='Личный кабинет' >",
            			  'visible'=>!Yii::app()->user->isGuest, 'url'=> array('/account/view', 'id' => Yii::app()->user->getId()) ),
            		array('label'=> Yii::app()->user->name, //Account::model()->findByPk(Yii::app()->user->getId())->login,
                	  'url'=>'#', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
                   
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
            	array('label'=>'Создать', 'url'=>'#postcreate', 'icon'=>'pencil', 'visible'=>!Yii::app()->user->isGuest,
            		  'linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',)),
            ),
        ),
    ),
)); ?>
<form class="navbar-search pull-right span2" action=""><input type="text" class="span2" placeholder="Поиск..."></form>
<!-- 	<div id="mainmenu">	 -->
	<?php $this->widget('bootstrap.widgets.BootMenu', array(
	    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
	    'stacked'=>false, // whether this is a stacked menu
        'htmlOptions'=>array('class'=>'nav-head span12'),
	    'items'=>array(
                array('label'=>'Cпецпроекты', 'url'=>'#', 'items'=>array(
                        array('label'=>'Start-Up', 'url'=>'#'),
                        array('label'=>'Another action', 'url'=>'#'),
                        array('label'=>'Something else here', 'url'=>'#'),
                        '---',
                        array('label'=>'NAV HEADER'),
                        array('label'=>'Separated link', 'url'=>'#'),
                        array('label'=>'One more separated link', 'url'=>'#'),
                )),
	    		array('label'=>'Афиша', 'url'=>'#'),
	    		array('label'=>'Новости', 'url'=>'#'),
	    		array('label'=>'Слово', 'url'=>'#'),
	    		array('label'=>'Музыка', 'url'=>'#'),
	    		array('label'=>'Путешествия', 'url'=>'#'),
	    		array('label'=>'Фото', 'url'=>'#'),
	    		array('label'=>'Спорт', 'url'=>'#'),
	    		array('label'=>'Кино', 'url'=>'#'),
	    		array('label'=>'Hi-tech', 'url'=>'#'),
	    ),
	)); ?>
<div style="clear:both"></div>
<!-- </div>  --><!-- mainmenu -->
