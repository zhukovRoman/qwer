<?php

class CategoryController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';

    /**
     * @return array action filters
     */
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionSubcatView($id) {
        $dataProvider = new CActiveDataProvider('Post', array(
                    'pagination' => array(
                        'pageSize' => 12,
                    ),
                    'criteria' => array(
                        #'select'=>''
                        'condition' => 'status_id = 5 AND sub_cat_id=:cat',
                        'order' => 'time_moder DESC',
                        'params' => array(":cat" => $id),
                    )
                        )
        );
        $model = $this->loadModel($id);
        $tmp = $model->getNameParent($model->id) . "->" . $model->name;
        $this->pageTitle = "Fresh-i - $tmp";
        $this->render('view', array(
            'dataProvider' => $dataProvider,
            'category' => $model
        ));
    }

    public function actionView($id) {

        $dataProvider = new CActiveDataProvider('Post', array(
                    'pagination' => array(
                        'pageSize' => 12,
                    ),
                    'criteria' => array(
                        #'select'=>''
                        'condition' => 'status_id = 5 AND category_id=:cat',
                        'order' => 'time_moder DESC',
                        'params' => array(":cat" => $id),
                    )
                        )
        );
        $model = $this->loadModel($id);
        $this->pageTitle = "Fresh-i - $model->name";
        $this->render('view', array(
            'dataProvider' => $dataProvider,
            'category' => Category::model()->findByPk($id)
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {


        $model = new Category;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];
            if ($model->save())
                $this->redirect(array('/category/manage'));
        }

        $this->render('_form', array('model' => $model));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];
            if ($model->save())
                $this->redirect(array('/category/manage'));
        }

        $this->render('_form', array('model' => $model));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {

        $model = $this->loadModel($id);
        
        if ($model === null || $model->parent_id == 0)
            throw new CHttpException(500, 'Невозможно удалить категорию, так как она не пустая или первого уровня!');

        $criteria = new CDbCriteria();
        $criteria->addCondition("sub_cat_id=:cat");

        $criteria->params = array(
            ':cat' => $model->id,
        );
        

        $post = Post::model()->findAll($criteria);
        
        if (count($post) == 0) {
           if( $model->delete())
           {
               echo "Категория удалена!"; 
           }
        }
        else {
            throw new CHttpException(500, 'Невозможно удалить категорию, так как она не пустая !');
        }
    }

    /**
     * Lists all models.
     */
//	public function actionIndex()
//	{
//		$dataProvider=new CActiveDataProvider('Category');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
//	}

    /**
     * Manages all models.
     */
    public function actionManage() {
        if (!Yii::app()->user->checkAccess('categoryManage'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия');
        $model = new Category('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Category']))
            $model->attributes = $_GET['Category'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Category::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
