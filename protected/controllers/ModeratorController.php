<?php

class ModeratorController extends Controller
{

	public function actionIndex()
	{
		if (!Yii::app()->user->checkAccess('moderatePost'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');
		$this->redirect(Yii::app()->createUrl ("/post/manage"));
	}

	
}
