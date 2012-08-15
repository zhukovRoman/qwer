<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap-yii.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-ui.min.js"></script>
</head>
<body>
<div class="body">
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <!--[if lte IE 8]> <style type="text/css">.navbar-search {margin-bottom:40px;}</style>  <![endif]--> 
  <?php include "protected/views/layouts/_modal.php";?>
  <div id="pos" class="container">
    <div class="header">
      <?php include "protected/views/site/header.php";?>
    </div>
    <div class="main row">
        <div class="span10">
          <?php echo $content;?>
        </div>
        <div class="ads">
          <?php include "protected/views/site/left.php";?>
        </div>
    </div>
    <div class="footer">
        <div class="span5 offset5">
          <?php include "protected/views/site/footer.php";?>
        </div>
    </div>
  </div>  
<!-- <a class="promo-link" href="http://ads.adfox.ru/6902/goLink?p1=birgs&amp;p2=v&amp;p5=bkeah&amp;pr=[RANDOM]" target="_blank"></a> -->
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap/bootstrap.min.js"></script>
<script>
  var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
</body>
</html>


