<?php

class PostController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'test'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update',
                    'ChangeSubCat',
                    'uploadPicture',
                    'upload',
                    'CreateVideo',
                    'CreatePhoto',
                    'photoItemUpload',
                    'admin', 'delete',
                    'archive', 'restore',
                    'approve', 'Moderation',
                    'Manage', 'approveTime'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Post('create_text');

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            //print_r($_POST['Post']);die();
            $model->attributes = $_POST['Post'];
            $model->author_id = Yii::app()->user->getId();
            $model->status_id = 1; // изначально статус "на модерации"
            if (isset($_POST['archive'])){
                $model->status_id = 3; 
            }
            //$model->time_add= time(); // время добавления стат
            $model->time_add = date('Y-m-d H:i:s');
            $model->is_video = FALSE;
            $model->is_photoset = FALSE;
            $model->is_playlist = FALSE;
            $model->important_flag = FALSE;
            $model->code = "";
            $model->order = 0;

            $tags = Post::stripTags($model->tag);
            $model->tag = $tags[0];

            if ($model->save()) {
                $model->modifyTag();
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('form', array(
            'model' => $model,
        ));
    }

    public function actionCreateVideo() {
        $model = new Post("create_video");
        $model->is_video = true;
        // Uncomment the following line if AJAX validation is needed


        if (isset($_POST['Post'])) {
            print_r($_POST);die();
            $model->attributes = $_POST['Post'];
            $model->author_id = Yii::app()->user->getId(); // изменить на текущего юзера
            $model->status_id = 1; // изначально статус "на модерации"
            if (isset($_POST['archive'])){
                $model->status_id = 3; 
            }
            
            $model->time_add = date('Y-m-d H:i:s');
            $model->is_video = true;
            $model->is_photoset = FALSE;
            $model->is_playlist = FALSE;
            $model->important_flag = FALSE;
            $model->order = 0;



            $tags = Post::stripTags($model->tag);
            $model->tag = $tags[0];
            


            if ($model->save()) {
                $model->modifyTag();
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('form', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionCreatePhoto() {
        $model = new Post('create_photo');
        $model->is_photoset = true;
        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            //print_r($_POST['Post']);die();
            $model->attributes = $_POST['Post'];
            $model->author_id = Yii::app()->user->getId(); // изменить на текущего юзера
            $model->status_id = 1; // изначально статус "на модерации"
            if (isset($_POST['archive'])){
                $model->status_id = 3; 
            }
            //$model->time_add= time(); // время добавления стат
            $model->time_add = date('Y-m-d H:i:s');
            $model->is_video = false;
            $model->is_photoset = true;
            $model->is_playlist = FALSE;
            $model->important_flag = FALSE;
            $model->order = 0;

            $tags = Post::stripTags($model->tag);
            $model->tag = $tags[0];

            if ($model->save()) {
                $model->modifyTag();
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('form', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if ($model->is_photoset) {
            $model->convertCode();
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {

            $model->old_tags = $model->tag;
            $model->sub_cat_id = NULL;
            $model->attributes = $_POST['Post'];
            $model->status_id = 1;
             if (isset($_POST['archive'])){
                $model->status_id = 3; 
            }
            if ($model->save()) {
                $model->modifyTag();
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('form', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Post', array(
                    'pagination' => array(
                        'pageSize' => 12,
                    ),
                    'criteria' => array(
                        #'select'=>''
                        'condition'=>'status_id = 5',
                        'order' => 'time_moder DESC',
                    )
                ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Post('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Post']))
            $model->attributes = $_GET['Post'];

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
        $model = Post::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'post-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionChangeSubCat() {

        $selectedCat = $_POST['Post']['category_id'];

        $data = Post::getSubCategories($selectedCat);
        foreach ($data as $value => $subcategory) {
            echo CHtml::tag
                    ('option', array('value' => $value), CHtml::encode($subcategory), true);
        }
    }

    protected static function photosetItemRet($url) {
        $id = substr($url, -44, -9);
        $res = '<li id="' . $id . '">';
        $res .= '<div><img src="' . $url . '" >';
        $res .= CHtml::button("Удалить", array('class' => 'btn-danger btn-mini', 'style' => 'margin: 5px 2px 3px 23px',
                    'onclick' => 'js:del_photo_from_set("' . $id . '")',
                ));
        $res .= '</div></li>';

        return $res;
    }

    public function actionphotoItemUpload() {

        Yii::import("ext.EAjaxUpload.qqFileUploader");
        $folder = "topics/tmp/";


        $allowedExtensions = array("jpg", "jpeg"); //array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 10 * 1024 * 1024; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);

        //echo $result['code'];

        $end = ".jpg";
        $crop = "_crop";
        $url = $result['filename']; // путь с расширением
        $url = substr($url, 0, strlen($url) - 4);

        $result['code'] = PostController::photosetItemRet($url . $crop . $end);
        $return = json_encode($result);

        Yii::app()->ih
                ->load($url . $end)
                ->thumb(1200, 1200, true)
                ->save();

        $size = getimagesize($url . $end);

        Yii::app()->ih
                ->load($url . $end)
                ->adaptiveThumb(100, 100)
                ->save($url . $crop . $end);



        echo $return; // it's array
    }

    public function actionArchive($id) {
        $model = $this->loadModel($id);
        $model->status_id = 10;
        $model->save(false);

        $this->render('view', array(
            'model' => $model,));
    }

    public function actionapprove($id) {
        $model = $this->loadModel($id);
        $model->status_id = 5;

        if ($model->time_moder == NULL)
            $model->time_moder = date("Y-m-d H:i:s");
        $model->save(false);
        $this->render('view', array(
            'model' => $model,));
    }

    public function actionapproveTime($id) {
        $model = $this->loadModel($id);
        $model->status_id = 5;
        $model->time_moder = date("Y-m-d H:i:s");
        $model->save(false);

        $this->render('view', array(
            'model' => $model,));
    }

    public function actionrestore($id) {
        $model = $this->loadModel($id);
        $model->status_id = 1;
        $model->save(false);

        $this->render('view', array(
            'model' => $model,));
    }

    public function actionManage($status = 1) {
        $model = new Post('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Post'])) {
            $model->attributes = $_GET['Post'];
        }
        
        $this->render('manage', array(
            'model' => $model,
            'status' => $status,
        ));
    }

}
