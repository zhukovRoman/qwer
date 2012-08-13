<?php
echo $form->textFieldRow($model, 'title', array(
    'class' => 'span5',
    'hint' => 'Заголовок должен быть наполнен смыслом, чтобы можно было понять, о чем будет топик.'));
?>
<?php
echo $form->textFieldRow($model, 'subtitle', array(
    'class' => 'span5',
    'hint' => 'подзаголовок должен более глубоко раскрывать смысл статей.'));
?>
<?php
echo $form->dropDownListRow($model, 'category_id', Post::getCategories(),
        //html options
        array('ajax' => array(
        'type' => 'POST',
        'url' => $this->createUrl('post/changeSubCat'),
        'update' => '#' . CHtml::activeId($model, 'sub_cat_id'),
        'success' => "js:function(data) {
                            if (data!=''){
                            
                            $('#subcat_row').show(300);
                            $('#" . CHtml::activeId($model, 'sub_cat_id') . "').empty();
                            $('#" . CHtml::activeId($model, 'sub_cat_id') . "').append(data);
                            }
                            else {
                                $('#" . CHtml::activeId($model, 'sub_cat_id') . "').empty();
                                $('#subcat_row').hide(300);
                             }                           
                            }",
        ))
);
?>


<div id="subcat_row" style="display:<?php echo (($model->sub_cat_id==NULL)&& !$model->isNewRecord)? 'none;':''?>"> 
    <?php
    echo $form->dropDownListRow($model, 'sub_cat_id', Post::getSubCategories($model->category_id)
    );
    ?>
</div>
<hr>