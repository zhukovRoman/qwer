<?php

class CommentController extends Controller {

//    /**
//     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
//     * using two-column layout. See 'protected/views/layouts/column2.php'.
//     */
//    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
//    public function filters() {
//        return array(
//            'accessControl', // perform access control for CRUD operations
//        );
//    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
//    public function accessRules() {
//        return array(
//            array('allow', // allow all users to perform 'index' and 'view' actions
//                'actions' => array('index', 'view'),
//                'users' => array('*'),
//            ),
//            array('allow', // allow authenticated user to perform 'create' and 'update' actions
//                'actions' => array(
//                    'AddComment', 
//                    'Raiting', 
//                    'Spam',
//                    'Delete', 
//                    'manage',
//                    'itisspam',
//                    'itisnospam',
//                    'toarchive'),
//                'users' => array('*'),
//            ),
//            array('allow', // allow admin user to perform 'admin' and 'delete' actions
//                'actions' => array('admin', 'delete', 'manage'),
//                'users' => array('*'),
//            ),
//            array('deny', // deny all users
//                'users' => array('*'),
//                
//            ),
//        );
//    }

    public function actionManage ($status=0) {
        
        if (!Yii::app()->user->checkAccess('commentModeration'))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
        $model = new Comment('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Comment']))
            $model->attributes = $_GET['Comment'];

        $this->render('manage', array(
            'model' => $model,
            'status' => $status,
        ));
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Comment::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment1-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAddComment() {
        
         if (!Yii::app()->user->checkAccess('addComment'))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
        $post_id;
        $parent_id;
        $text;

        if (isset($_POST['post']) && isset($_POST['comment_parent']) &&
                isset($_POST['text'])) {
            $post_id = intval($_POST['post']);
            $parent_id = intval($_POST['comment_parent']);
            $post = Post::model()->find("id=:id", array(":id" => $post_id));
            if ($post == NULL) {
                $return = array(
                    'status' => "error",
                    'description' => "Неверная статья для комментирования"
                );
                echo json_encode($return);
            }

            if ($parent_id != 0) {
                $parent = Comment::model()->find("id=:id", array(":id" => $parent_id));
                if ($parent == NULL || $post == NULL) {
                    $return = array(
                        'status' => "error",
                        'description' => "Неверная статья для комментирования или комментарий"
                    );
                    echo json_encode($return);
                    return;
                } else {
                    $this->saveComment($parent_id, $post, $_POST['text']);
                    return;
                }
            } else {

                $this->saveComment($parent_id, $post, $_POST['text']);
                return;
            }
        } else {
            $return = array(
                'status' => "error",
                'description' => 'Not all parameters are set',
            );
            echo json_encode($return);
        }
    }

    private function saveComment($parent_id, $post, $text) {
        // провреряем текст
        $purifier = new CHtmlPurifier();
        $tmp = $purifier->purify($text);

        if (mb_strlen($text, 'utf-8') > 1) {
            $text = CHtml::encode($text);
            if ($parent_id == 0)
                $parent_id = NULL;
            if ($comment = Comment::createNewComment($text, $parent_id, $post)) {
                $return = array(
                    'status' => "success",
                    'code' => $this->renderPartial("tree_item", array('model' => $comment,), true),
                    'parentid' => $comment->parent_id,
                    'selfId' => $comment->id,
                );
                echo json_encode($return);
                return;
            } else {
                $return = array(
                    'status' => "error",
                    'description' => 'Приносим свои извинения, но в данный момент серевер перегружен =(' . $text . strlen($text, 'utf-8'),
                );
                echo json_encode($return);
                return;
            }
        } else {
            $return = array(
                'status' => "error",
                'description' => 'Сообщение не может быть пустым! Минимальная длинна 2 символа!',
            );
            echo json_encode($return);
            return;
        }
    }

    public function actionRaiting() {
        
         if (!Yii::app()->user->checkAccess('commentModeration'))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
        if (isset($_POST['delta']) && isset($_POST['id-comment'])) {
            //все параметры заданы
            $d = intval($_POST['delta']);
            if ($d==0)
            {
                $return = array(
                        'status' => "error",
                        'description' => "Ошибка!",
                        'id' => $comment_id,
                    );
                    echo json_encode($return);
                    return;
            }
            $d = ($d < 0 )? -1 : 1;
             
            $comment_id = intval($_POST['id-comment']);
            $comment = Comment::model()->findByPk($comment_id);
            if (($comment != NULL) &&
                    !(Comment::alreadyVote(Yii::app()->user->getId(), $comment_id))) {
                $ret = CommentRating::addItem($comment, $d);

                if ($ret) {

                    $return = array(
                        'status' => "success",
                        'code' => $comment->positive_vote_count + $d,
                        'id' => $comment_id,
                    );
                    echo json_encode($return);
                    return;
                } else {
                    $return = array(
                        'status' => "error",
                        'description' => "Ошбика!",
                        'id' => $comment_id,
                    );
                    echo json_encode($return);
                    return;
                }
            } else {
                $return = array(
                    'status' => "error",
                    'description' => "Такой комментарий не найден!",
                    'id' => $comment_id,
                );
                echo json_encode($return);
                return;
            }
        } else {
            $return = array(
                'status' => "error",
                'description' => "Ошибка!"
            );
            echo json_encode($return);
            return;
        }
    }

    public function actionDelete() {
         if (!Yii::app()->user->checkAccess('commentModeration'))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
        if (isset($_POST['id-comment'])) {
            $comment_id = intval($_POST['id-comment']);
            $comment = Comment::model()->findByPk($comment_id);

            $allInTree = $comment->recurseCalc ();
            if ($allInTree > 0)
            {
                $post = $comment->post;
                $post->comment_count = $post->comment_count - $allInTree;
                $post->save(false);
            }
            $comment->status_id = 2;
            $comment->save(false); 
            echo $comment_id;
        }
    }
    
    public function actionRestore() {
         if (!Yii::app()->user->checkAccess('commentModeration'))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
        if (isset($_POST['id-comment'])) {
            $comment_id = intval($_POST['id-comment']);
            $comment = Comment::model()->findByPk($comment_id);
            $comment->status_id = 1;
            $comment->save(false); 
            $allInTree = $comment->recurseCalc (true);
            if ($allInTree > 0)
            {
                $post = $comment->post;
                $post->comment_count = $post->comment_count + $allInTree;
                $post->save(false);
            }
            
           
        }
    }

    public function actionSpam() {
         if (!Yii::app()->user->checkAccess('commentVote'))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
        if (isset($_POST['id-comment'])) {
            $comment_id = intval($_POST['id-comment']);
            $comment = Comment::model()->findByPk($comment_id);
            if ($comment->status_id == 1) {
                $comment->saveCounters(array('rating' => -1));
            }
            echo "Спасибо! Мы обязательно проверим данный комменарий.";
        }
    }
    
    public function actionitisspam($id)
    {
         if (!Yii::app()->user->checkAccess('commentModeration'))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
            $comment = Comment::model()->findByPk($id);
            if($comment!=null)
            {
                $comment->status_id = 3;
                $comment->save(false);
            }
            
    }
    public function actionitisnospam($id)
    {
         if (!Yii::app()->user->checkAccess('commentModeration'))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
            $comment = Comment::model()->findByPk($id);
            if($comment!=null)
            {
                $comment->status_id = 4;
                $comment->save(false); 
            }
            
    }
    public function actiontoarchive($id)
    {
         if (!Yii::app()->user->checkAccess('commentModeration'))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
            $comment = Comment::model()->findByPk($id);
            if($comment!=null)
            {
                $comment->status_id = 2;
                $comment->save(false); 
            }
            
    }
    
    

}
