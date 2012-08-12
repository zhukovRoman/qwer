<?php // /** @var BootActiveForm $form */

$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'comment-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
            'clientOptions'=>array(
                    'validateOnChange'=>true,
                    #'validateOnSubmit'=>false,
            ),
));
?>


 
<fieldset>

<div class="alert alert-block alert-error fade out" style="display:none;" id="allert-box">
        <a class="close" data-dismiss="alert">×</a>
        <span class="error_msg">
            <strong>Ошибка!</strong> Приносим свои извинения! 
        </span>
</div>

   
		
<?php echo $form->textAreaRow($model,'text',array('class'=>'span7')); ?>
    
<INPUT TYPE="HIDDEN" CLASS="post_id_form" VALUE ="<?php echo $post->id; ?>">
<INPUT TYPE="HIDDEN" CLASS="parent_id_form" VALUE ="0">
  
<?php  Yii::app()->clientScript->registerScriptFile("js/comments.js",
                                CClientScript::POS_END);    ?>



<?php $this->widget('bootstrap.widgets.BootButton', array(
    'buttonType'=>'button',
    'type'=>'primary',
    'size'=>'',
    'label'=>'Отправить',
    'loadingText'=>'Отправка...',
    'htmlOptions'=>array(
                'id'=>'sendComment',
                'ajax' => array(
                        'type'   => 'POST',
                        'data' => 'js:"post="
                                    +$(".post_id_form").val()
                                    +"&comment_parent="
                                    +$(".parent_id_form").val()
                                    +"&text="
                                    +$("#Comment_text").val()', 
                        'url'    => Yii::app()->createUrl('comment/addcomment'),
                        'success'=>"js:function(data) {getcomment (data);}",
                        'error'=>"js:function(data) {flashError ('Неудалось отправить комментарий. Попробуйте еще раз!');}",
                    )
        ),
)); ?>  

<?php $this->widget('bootstrap.widgets.BootButton', array(
    'buttonType'=>'button',
    'type'=>'primary',
    'size'=>'mini',
    'label'=>'Оставить комментарий',
    'htmlOptions'=>array(
                        'onclick'=>'js:attachForm('.$model->id.')',
                        'id'=>'replay-button0',
                        'style'=>'display:none;',
                    )
            )
        ); ?>  
</fieldset>

<?php $this->endWidget(); ?>
