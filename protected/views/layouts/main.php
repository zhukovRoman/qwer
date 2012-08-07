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
<div class="container">
	<div class="header">
		<?php include "protected/views/site/header.php";?>
	</div>
	<div class="row">
		<div class="span3">
	    	<?php include "protected/views/site/left.php";?>
	  	</div>
	  	<div class="span9">
	  		<?php echo $content;?>
	  	</div>
	</div>
	<div id="clear"></div>
<div class="footer">
  <div class="row">
    <div class="span4 offset4">
      <?php include "protected/views/site/footer.php";?>
    </div>
  </div>
</div>
</div>
</body>
</html>


