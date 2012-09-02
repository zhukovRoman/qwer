<?php

class PostController extends Controller {


    public function loadModel($id) {
        $model = Post::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Post', array(
                    
                    'criteria' => array(
                        #'select'=>''
                        'condition' => 'status_id = 5',
                        'order' => 'time_moder DESC',
                        'limit' => 8,
                    )
                ));
        $this->pageTitle="Fresh-i - Главная";
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionView($id) {
        $model = $this->loadModel($id);
        Yii::app()->clientScript->registerMetaTag($model->category->name."|".$model->subtitle, 'description');
        $this->pageTitle=$model->title.'/'.$model->category->name;
        $this->render('view', array(
            'model' => $model,
        ));
    }
    
    

    public function actionCreate() {
        $this->pageTitle="Fresh-i - Создать статью";
        if (!Yii::app()->user->checkAccess('createNewPost'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');
        $model = new Post('create_text');
        
        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            //print_r($_POST['Post']);die();
            $model->attributes = $_POST['Post'];
            $model->author_id = Yii::app()->user->getId();
            $model->status_id = 1; // изначально статус "на модерации"
            if (isset($_POST['archive'])) {
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
        if (!Yii::app()->user->checkAccess('createNewPost'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');
        $model = new Post("create_video");
        $model->is_video = true;
        // Uncomment the following line if AJAX validation is needed


        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            $model->author_id = Yii::app()->user->getId();
            $model->status_id = 1;
            if (isset($_POST['archive'])) {
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

    public function actionCreatePhoto() {

        if (!Yii::app()->user->checkAccess('createNewPost'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');
        $model = new Post('create_photo');
        $model->is_photoset = true;
        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            //print_r($_POST['Post']);die();
            $model->attributes = $_POST['Post'];
            $model->author_id = Yii::app()->user->getId(); // изменить на текущего юзера
            $model->status_id = 1; // изначально статус "на модерации"
            if (isset($_POST['archive'])) {
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

    public function actionChangeSubCat() {
        if (!Yii::app()->user->checkAccess('createNewPost'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');

        $selectedCat = $_POST['Post']['category_id'];
        $data = Post::getSubCategories($selectedCat);
        foreach ($data as $value => $subcategory) {
            echo CHtml::tag
                    ('option', array('value' => $value), CHtml::encode($subcategory), true);
        }
    }

    public function actionPhotoItemUpload() {

               if (!Yii::app()->user->checkAccess('createNewPost'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');

        
        /* if(!empty($_FILES)) { */
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
          } */

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



        echo $return;
    }

    public function actionRaiting() {
        
            if (!Yii::app()->user->checkAccess('PostActions'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');

        
        if (!isset($_POST['id-post']) || !isset($_POST['delta']) ||
                Yii::app()->user->isGuest) {
            $return = array(
                'status' => "error",
                'description' => "Не все данные заданы!",
            );
            echo json_encode($return);
            return;
        } else {
            $id = intval($_POST['id-post']);
            $delta = intval($_POST['delta']);
            if ($delta == 0) {
                $return = array(
                    'status' => "error",
                    'description' => "Не все данные заданы!",
                );
                echo json_encode($return);
                return;
            }
            $delta = ($delta < 0) ? -1 : 1;
            $post = Post::model()->findByPk($id);
            if ($post == NULL) {
                $return = array(
                    'status' => "error",
                    'description' => "Такая статья не найдена!",
                );
                echo json_encode($return);
                return;
            } else {
                $user = Yii::app()->user->getId();
                $post_id = $id;

                if (PostRating::allreadyVote($user, $post_id)) {
                    $return = array(
                        'status' => "error",
                        'description' => "Вы уже голосовали",
                    );
                    echo json_encode($return);
                    return;
                } else {

                    if (PostRating::addNewItem($delta, $post)) {
                        if ($delta > 0)
                            $post->positive_vote_count++;
                        $post->all_vote_count++;
                        $return = array(
                            'status' => "success",
                            'description' => "Спасибо за Ваше голос!",
                            'code' => $post->getRaiting(),
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

    public function actionFavorite() {
        if (!Yii::app()->user->checkAccess('PostActions'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');

        
        if (!isset($_POST['id-post']) ||
                Yii::app()->user->isGuest) {
            $return = array(
                'status' => "error",
                'description' => "Не все данные заданы!",
            );
            echo json_encode($return);
            return;
        }

        $id = intval($_POST['id-post']);
        $post = Post::model()->findbyPk($id);
        $user = Yii::app()->getId();

        if ($post == NULL) {
            $return = array(
                'status' => "error",
                'description' => "Не все данные заданы корректно!",
            );
            echo json_encode($return);
            return;
        }

        // проверить есть ли в избранном.
        $fav = Post::inFavorite($id);
        if (!$fav) {
//        статьи нет в избранном
            $fav = new Favourites();
            $fav->post_id = $id;
            $fav->user_id = Yii::app()->user->getId();
            $fav->status = 1;
            $fav->time_add = date("Y-m-d H:i:s");

            //if (true)
            if ($fav->save()) {
                $return = array(
                    'status' => "success",
                    'description' => "Статья добавлена в избранное!",
                    'direction' => "in"
                );
                echo json_encode($return);
                return;
            } else {
                $return = array(
                    'status' => "error",
                    'description' => "Не все данные заданы корректно!",
                );
                echo json_encode($return);
                return;
            }
        } else {
//         статьи есть в избранном
            if ($fav->delete()) {
                $return = array(
                    'status' => "success",
                    'description' => "Статья удалена из избранного!",
                    'direction' => "out"
                );
                echo json_encode($return);
                return;
            } else {
                $return = array(
                    'status' => "error",
                    'description' => "Статья не была добавлена в избранное!",
                );
                echo json_encode($return);
                return;
            }
        }
    }
    
    
    
    public function actionArchive($id) {
        $model = $this->loadModel($id);
        if (!Yii::app()->user->checkAccess('manageOwnPost', array('Post' => $model)) && (!Yii::app()->user->checkAccess('moderatePost')))
        throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');
       
        $model->status_id = 10;
        $model->save(false);

        $this->render('view', array(
            'model' => $model,));
    }

    public function actionRestore($id) {
        $model = $this->loadModel($id);
        
        if ($model!=null && 
                !Yii::app()->user->checkAccess('manageOwnPost', array('Post' => $model))
                && (!Yii::app()->user->checkAccess('moderatePost')))
        throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');
       
        
        $model->status_id = 1;
        $model->save(false);

        $this->render('view', array(
            'model' => $model,));
    }

    
    public function actionUpdate($id) {

        $model = $this->loadModel($id);
        if (!Yii::app()->user->checkAccess('manageOwnPost', array('Post' => $model)) && (!Yii::app()->user->checkAccess('moderatePost')))
        throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');
       
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
            if (isset($_POST['archive'])) {
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
    
    public function actionApprove($id) {
        if (!Yii::app()->user->checkAccess('moderatePost'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');
 
        $model = $this->loadModel($id);
        $model->status_id = 5;

        if ($model->time_moder == NULL)
            $model->time_moder = date("Y-m-d H:i:s");
        $model->save(false);
        $this->render('view', array(
            'model' => $model,));
    }

    public function actionApproveTime($id) {
         if (!Yii::app()->user->checkAccess('moderatePost'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');
 
        $model = $this->loadModel($id);
        $model->status_id = 5;
        $model->time_moder = date("Y-m-d H:i:s");
        $model->save(false);

        $this->render('view', array(
            'model' => $model,));
    }
    
    public function actionManage($status = 1) {
         if (!Yii::app()->user->checkAccess('moderatePost'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');
 
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
    
    public function actionImportant($id)
    {
        if (!Yii::app()->user->checkAccess('moderatePost'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');
        $model = $this->loadModel($id);
        $old = Post::model()->find("important_flag=true");
        if ($old!=null)
        {
            $old->important_flag=false;
            $old->save(false);
        }
        $model->important_flag=true;
        $model->save(false);
        $this->render('view', array(
            'model' => $model,));
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

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'post-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
