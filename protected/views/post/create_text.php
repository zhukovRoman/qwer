<?php
echo $form->textAreaRow($model, 'text', array('class' => 'span8',
    'rows' => 25,
    'id' => "redactor"));
?>    
<script type="text/javascript">
    $(document).ready(
    function()
    {
			
        $('#redactor').redactor({ 
            imageUpload: 'index.php?r=site/RedactorUploadImage',
            //autoresize: true,
            cleanUp: true,
            removeClasses: true,
            removeStyles: true,
            css: 'docstyle.css'
        });
			
    }
);
</script>
