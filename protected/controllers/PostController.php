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
                    'Manage', 'approveTime', 'Raiting', 'Favorite'),
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
            $model->attributes = $_POST['Post'];
            $model->author_id = Yii::app()->user->getId(); 
            $model->status_id = 1; 
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
        $res .= '<div style="clear:both"></div>';
        $res .= CHtml::button("Удалить", array('class' => 'btn-danger btn-mini', 'style' => 'margin: 5px 2px 3px 23px',
                    'onclick' => 'js:del_photo_from_set("' . $id . '")',
                ));
        $res .= '</div></li>';

        return $res;
    }

    public function actionphotoItemUpload() {

        /*if(!empty($_FILES)) {*/
    // Файл передан через обычный массив $_FILES
    
 /*   $file = $_FILES['my-pic'];
    $name =  "topics/tmp/".substr(md5($file['tmp_name']. rand(12, 323). time()),0)."_".rand(0,100).".jpg";
    Yii::app()->ih
                ->load($file['tmp_name'])
                ->thumb(1200, 1200, true)
                ->save($name);
   echo $name;
} else {
    // Надо выцеплять файл из входного потока php
    // (такое встречается только в очень экзотических браузерах,
    //  поэтому можно не предусматривать этот способ вовсе)
    $headers = getallheaders();
    if(array_key_exists('Upload-Filename', $headers)) {
        $data = file_get_contents('php://input');
        echo 'File recieved: '.$headers['Upload-Filename'];
        echo '<br/>Size: '.$headers['Upload-Size'].' ('.strlen($data).' b)';
        echo '<br/>Type: '.$headers['Upload-Type'];
    }
}*/
    
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
/*}*/

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

    public function actionRaiting()
    {
       if ( !isset ($_POST['id-post']) || !isset ($_POST['delta']) || 
                Yii::app()->user->isGuest) 
       {
           $return = array(
                        'status' => "error",
                        'description' => "Не все данные заданы!",
                    );
                    echo json_encode($return);
                    return;
       }
       else{
           $id = intval($_POST['id-post']);
           $delta = intval($_POST['delta']);
           if ($delta==0)
           {
               $return = array(
                        'status' => "error",
                        'description' => "Не все данные заданы!",
                    );
                    echo json_encode($return);
                    return;
           }
           $delta = ($delta<0) ? -1 : 1;
           $post = Post::model()->findByPk($id);
           if ($post==NULL)
           {
               $return = array(
                        'status' => "error",
                        'description' => "Такая статья не найдена!",
                    );
                    echo json_encode($return);
                    return;
           }
           else
           {   
              $user = Yii::app()->user->getId();
              $post_id = $id;
              
              if (PostRating::allreadyVote($user, $post_id)){
                   $return = array(
                        'status' => "error",
                        'description' => "Вы уже голосовали",
                    );
                    echo json_encode($return);
                    return;
              }
              else {
                  
                  if (PostRating::addNewItem( $delta, $post))
                  {
                      if ($delta>0) $post->positive_vote_count++;
                      $post->all_vote_count++;
                      $return = array(
                        'status' => "success",
                        'description' => "Спасибо за Ваше голос!",
                        'code' =>  $post->getRaiting(),
                    );
                    echo json_encode($return);
                    return;
                  }
                  else {
                      $return = array(
                        'status' => "error",
                        'description' => "Техническая ошибка!",
                    );
                    echo json_encode($return);
                    return;
                  }
                  
              }
              
              
           }
       }
    }
    
    public function actionFavorite ()
    {
         if ( !isset ($_POST['id-post']) || 
                Yii::app()->user->isGuest) 
       {
           $return = array(
                        'status' => "error",
                        'description' => "Не все данные заданы!",
                    );
                    echo json_encode($return);
                    return;
       }
       
       $id = intval ($_POST['id-post']);
       $post = Post::model()->findbyPk($id);
       $user = Yii::app()->getId();
       
       if ($post==NULL)
       {
           $return = array(
                        'status' => "error",
                        'description' => "Не все данные заданы корректно!",
                    );
                    echo json_encode($return);
                    return;
       } 
       
       // проверить есть ли в избранном.
       $fav = Post::inFavorite($id);
       if (!$fav)
       {
//        статьи нет в избранном
            $fav = new Favourites();
            $fav->post_id = $id;
            $fav->user_id = Yii::app()->user->getId();
            $fav->status = 1;
            $fav->time_add = date ("Y-m-d H:i:s");
            
           //if (true)
            if ($fav->save())
            {
                $return = array(
                        'status' => "success",
                        'description' => "Статья добавлена в избранное!",
                        'direction' => "in"
                    );
                    echo json_encode($return);
                    return;
            }
            else 
            {
                $return = array(
                        'status' => "error",
                        'description' => "Не все данные заданы корректно!",
                    );
                    echo json_encode($return);
                    return;
            }
       }
       else {
//         статьи есть в избранном
           if ($fav->delete())
           {
               $return = array(
                        'status' => "success",
                        'description' => "Статья удалена из избранного!",
                        'direction' => "out"
                    );
                    echo json_encode($return);
                    return;
           }
           else {
               $return = array(
                        'status' => "error",
                        'description' => "Статья не была добавлена в избранное!",
                    );
                    echo json_encode($return);
                    return;
           }
               
           
       }
       
    }
}
