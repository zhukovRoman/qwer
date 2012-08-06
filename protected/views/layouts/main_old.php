<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<!-- <div class="container" id="page"> -->
<div class="container">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	
	<?php $this->widget('bootstrap.widgets.BootNavbar', array(
    'fixed'=>false,
    'brand'=>'Fresh-i',
    'brandUrl'=>'#',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.BootMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>'#', 'active'=>true),
                array('label'=>'Link', 'url'=>'#'),
                array('label'=>'Dropdown', 'url'=>'#', 'items'=>array(
                    array('label'=>'Action', 'url'=>'#'),
                    array('label'=>'Another action', 'url'=>'#'),
                    array('label'=>'Something else here', 'url'=>'#'),
                    '---',
                    array('label'=>'NAV HEADER'),
                    array('label'=>'Separated link', 'url'=>'#'),
                    array('label'=>'One more separated link', 'url'=>'#'),
                )),
            ),
        ),
        '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
    	array(
            'class'=>'bootstrap.widgets.BootMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(                
            		
            		array('label'=> Yii::app()->user->name, //Account::model()->findByPk(Yii::app()->user->getId())->login,
                	  'url'=>'#', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
                    array('label'=>'Рейтинг', 'url'=>'#', 'visible'=>!Yii::app()->user->isGuest),
                	'---',
                    array('label'=>'Профиль', 'url'=> array('/account/view', 'id' => Yii::app()->user->getId())),
                    array('label'=>'Созданное', 'url'=>'#'),
                	array('label'=>'Избранное', 'url'=>'#'),
                	array('label'=>'Подписки', 'url'=>'#'),
                    '---',
                    array('label'=>'Выйти', 'url'=>array('/site/logout')),
                )),
                
            	array('label'=>'Войти', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
            		
            	array(//'class'=>'bootstrap.widgets.BootMenu', array(
            			 'label'=>'Click me', 'url'=>'#myModal','linkOptions'=>array('data-toggle'=>'modal', 'type'=>'primary',)),
            	
                '---',
            	array('label'=>'Регистрация', 'url'=>array('/account/signup/'), 'visible'=>Yii::app()->user->isGuest),
            	array('label'=>'Создать', 'url'=>'#', 'icon'=>'pencil', 'visible'=>!Yii::app()->user->isGuest),
            ),
        ),
    ),
)); ?>
	

	
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),	
				array('label'=>'Private office ('.Yii::app()->user->name.')', 'url'=>array('/account/view', 'id' => Yii::app()->user->getId()), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Registration', 'url'=>array('/account/signup/'), 'visible'=>Yii::app()->user->isGuest),
			 	array('label'=>'Password recovery', 'url'=>array('/account/passrecovery/'), 'visible'=>Yii::app()->user->isGuest),
				
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	
<div class="row">
	<div class="span2">
    	<?php include "protected/views/site/left.php";?>
  	</div>
  	<div class="span8">
  		<?php echo $content;?>
  	</div>
  	<div class="span2">
  		<?php include "protected/views/site/right.php";?>
  	</div>
</div>

<div id="clear"></div>

<div id="footer">
	<?php include "protected/views/site/footer.php";?>
</div><!-- footer -->

</div><!-- page -->

<!-- Модальное окно логина -->

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Modal header</h3>
</div>
 
<div class="modal-body">
    <p>One fine body...</p>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'type'=>'primary',
        'label'=>'Save changes',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>

</body>
</html>


