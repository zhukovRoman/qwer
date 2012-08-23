Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
All Rights Reserved.<br/>

<?php  

echo Yii::app()->user->role;

if(Yii::app()->user->checkAccess('administrator'))
{
	echo Yii::app()->user->getId();
	echo "hello, I'm administrator";
	//echo $params["Account"]->id;
	
}

?>
