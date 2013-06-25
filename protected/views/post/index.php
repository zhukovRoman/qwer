<?php  Yii::app()->clientScript->registerScript(0, "$(function() {
    $('ul.items > li.main-view .main-view-top').hoverdir();
    $('.main-carousel').carousel();
  });", CClientScript::POS_END);?>

<?php  Yii::app()->clientScript->registerScriptFile("js/tooltipster/js/jquery.tooltipster.min.js", CClientScript::POS_HEAD);?>

 

<?php echo Alert::showAlerts(); ?>
<script>
        $(document).ready(function() {
            $('.tooltip').tooltipster({
    animation: 'slide',				// Default: fade
    arrow: true,				// Default: true
    arrowColor: '',				// Default: tooltip's background color
    delay: 200, 				// Default: 200
   // fixedWidth: 400,				// Default: 0
    followMouse: true, 				// Default: false
   // offsetX: 0,					// Default: 0
   // offsetY: 0,					// Default: 0
    overrideText: '',				// Default: ''
    position: 'top-right', 			// Default: top
    speed: 200				// Default: 100
    //timer: 1000				// Default: 0
    //tooltipTheme: '.my-custom-theme'		// Default: '.tooltip-message'
});
        });
    </script>

<?php echo $this->renderPartial('_carousel', array('dataProvider'=>$dataProvider));?>
  <div class="clearfix"></div>
  <hr>
  <div class="row">
    <?php echo $this->renderPartial('_tabs', array('dataProvider'=>$dataProvider));?>
  </div>  
