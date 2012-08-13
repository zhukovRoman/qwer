
    
    <?php echo $form->textFieldRow($model, 'code', 
            array('hint'=>'код видео', 
                'class'=>'span7')); ?>

    <?php echo $form->textAreaRow($model, 'text', array('class'=>'span8', 'rows'=>15, 'id'=>"redactor")); ?>
    <script type="text/javascript">
    $(document).ready(
        function()
        {
            var buttons = ['html', '|', 'formatting', '|', 'bold', 'italic', '|',
                                            'unorderedlist', 'orderedlist', '|',
                                            'image', 'link', '|', 
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
    
