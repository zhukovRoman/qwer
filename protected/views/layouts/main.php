<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
</head>
<body>
<div class="body">
  <?php include "protected/views/layouts/_modal.php";?>
  <div class="container contain">
    <div class="header">
      <?php include "protected/views/site/header.php";?>
    </div>
    <div class="main row">
        
        <div class="span10 container-column">
          <?php echo $content;?>
        </div>
        <div class="span2">
          <?php include "protected/views/site/left.php";?>
        </div>
    </div>
    <div class="footer">
        <div class="span5 offset5">
          <?php include "protected/views/site/footer.php";?>
        </div>
    </div>
  </div>  
<a class="promo-link" href="http://ads.adfox.ru/6902/goLink?p1=birgs&amp;p2=v&amp;p5=bkeah&amp;pr=[RANDOM]" target="_blank"></a>
</div>

</body>
</html>


