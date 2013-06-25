
    
    <?php echo $form->textAreaRow($model, 'code', array('class'=>'span7', 
        'rows'=>7,
        'id'=>"poll",
        'disabled'=>($model->isNewRecord)? false: true ,
        'hint' => 'Варианты ответов, каждый на новой строке.')); ?>

    <?php echo $form->textAreaRow($model, 'text', array('class'=>'span7', 'rows'=>15, 'id'=>"redactor")); ?>
    <script type="text/javascript">
    $(document).ready(
        function()
        {
            var buttons = ['html', '|', 'formatting', '|', 'bold', 'italic', '|',
                                            'unorderedlist', 'orderedlist', '|',
                                            'image', 'link', 'video','|', 
                                            'alignleft', 'aligncenter', 'alignright', 'justify', '|',
                                            'horizontalrule'];
                        $('#redactor').redactor({ 
                                imageUpload: 'index.php?r=site/RedactorUploadImage',
                                //autoresize: true,
                                cleanUp: true,
                                buttons: buttons,
                                removeClasses: true,
                                removeStyles: true,
                                css: 'docstyle.css'
                            });
            
        }
    );
    </script>
    
