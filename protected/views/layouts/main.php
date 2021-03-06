<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="ru" class="no-js"> <!--<![endif]-->
<head>
<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?49"></script>
	<script type="text/javascript">
		VK.init({apiId: 2998706, onlyWidgets: true});
		VK.Widgets.Group("vk_groups", {mode: 1, width: "220"}, 40014299);
		</script>
  <meta charset="utf-8">
  <link href="css/favicon.ico" rel="shortcut icon">
  <link rel="apple-touch-icon" href="css/favicon.png">
  <meta charset="utf-8">
  <meta name="Keywords" content="fresh-i, freshi, mkrv, дануче, поэты "/> 
  <meta name="description" content="Fresh-i — новости моды, музыки, кино, дизайна. Афиша мероприятий. Фотографии. Луки.">
  <meta name="viewport" content="width=1024">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/min/all.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/min/add_style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/tooltipster/css/tooltipster.css" />
  <link href='http://fonts.googleapis.com/css?family=Comfortaa:700&subset=cyrillic' rel='stylesheet' type='text/css'>
 <!--  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap-yii.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fontawesome/font-awesome.css" /> -->
  <!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fontawesome/font-awesome-ie7.css" /> 
  <![endif]--> 
<!--   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" /> -->
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <?php //include "protected/views/layouts/_modal.php";?>
  <div class="container content-border wrap">
    <div class="header">
      <?php include "protected/views/site/header.php";?>
    </div>
    <div class="main row">
        <div class="span9">
          <?php echo $content;?>
        </div>
        <div class="span3" >
          <?php include "protected/views/site/left.php";?>
        </div>
        <div class="arrow-up black-a"><i class=" icon-arrow-up"></i></div>
    </div>
    <div class="footer">
      <div class="span12">
        <?php include "protected/views/site/footer.php";?>
      </div>
    </div>
  </div>  
  <!-- <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/min/primary.js"></script>-->
 <!-- <a class="promo-link" href="http://ads.adfox.ru/6902/goLink?p1=birgs&amp;p2=v&amp;p5=bkeah&amp;pr=[RANDOM]" target="_blank"></a>  -->
 <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery.scrollto.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/noty/min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
<?php  Yii::app()->clientScript->registerScriptFile("js/vendor/jquery.hoverdir.js", CClientScript::POS_END);?>
<?php  Yii::app()->clientScript->registerScript(0, "$(function() {
    $('ul.items > li.main-view .main-view-top').hoverdir();
    $('.main-carousel').carousel();
  });", CClientScript::POS_END);?>



<script>
  var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<!--<script src="http://cssrefresh.frebsite.nl/js/cssrefresh.js"></script>-->
</body>
</html>


