<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'pictureLoad')); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Создание превью</h3>
</div>

<div class="modal-body">

    <div  id="div_modal_target" >

        <img src="<?php
        echo ($model->preview_url != '') ?
        substr($model->preview_url, 0, strlen($model->preview_url) - 9) . ".jpg" : ''
?>" 
             id="target" 
             style="padding-bottom: 5px ;"
             >

    </div> 

    <div id="coords" style="display: none"></div>   

</div>
<div class="modal-footer">

    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'type' => 'primary',
        'label' => 'Обрезать',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal',
            'id' => 'append_crop',
            'ajax' => array(
                'type' => 'POST',
                'data' => 'js:"url="+$("#target").attr("src")+"&coord="+$("#coords").text()', // тут мы выбираем данные которые нужно передать.
                'url' => Yii::app()->createUrl('site/CropTopicPreview'),
                'success' => "js:function(data) {cropPreview();}", // при успехе экшена выполняется это.
        ))
            )
    );
    ?>

    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => 'Close',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal',
        ),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>