<?php

class AlertController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        if (!Yii::app()->user->checkAccess('pagesManage')) {
            throw new CHttpException(403, 'Нет прав');
        }
        $model = new Alert;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Alert'])) {
            $model->attributes = $_POST['Alert'];
            if ($model->save())
               $this->redirect(array('/post/index'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        if (!Yii::app()->user->checkAccess('pagesManage')) {
            throw new CHttpException(403, 'Нет прав');
        }
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Alert'])) {
            $model->attributes = $_POST['Alert'];
            if ($model->save())
               $this->redirect(array('/post/index'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (!Yii::app()->user->checkAccess('pagesManage')) {
            throw new CHttpException(403, 'Нет прав');
        }


        $this->loadModel($id)->delete();

        $this->redirect(array('/post/index'));
    }

    public function loadModel($id) {
        $model = Alert::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'alert-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
