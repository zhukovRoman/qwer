<?php

class ModeratorController extends Controller
{

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Tag');
		$this->redirect(Yii::app()->createUrl ("/post/manage"));
	}

	
}
