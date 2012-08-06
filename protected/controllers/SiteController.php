<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),		
				
			'upload'=>array(
					'class'=>'ext.xupload.actions.XUploadAction',
					'subfolderVar' => 'parent_id',
					'path' => realpath(Yii::app() -> getBasePath() . '/../' . Account::ACCOUNT_DIR),
			),
                       
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{	
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

   /**
     * @return void
     */
     public function actionCropAvatat()
     {           
		/* Yii::import('ext.cropzoom.JCropZoom');
        $saveToFilePath = Yii::getPathOfAlias('webroot.uploads').DIRECTORY_SEPARATOR .'cropZoomTest';
       	JCropZoom::getHandler()->process($saveToFilePath.'.jpeg');    */  
     	//в массиве $_POST['params'] 
     	// содержаться левый верхний угол выделения в реальном изображении
     	print_r($_POST['params']) ;
    }
    
     public function actionUploadPreview()
     {           
	 Yii::import("ext.EAjaxUpload.qqFileUploader");
             
        $folder = "topics/tmp/";         
        $allowedExtensions = array("jpg");//array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        
        
        //$fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
        //$fileName=$result['filename'];//GETTING FILE NAME
        $end = ".jpg";
        $crop = "_crop";
        $url = $result['filename']; // путь с расширением
        $url = substr($url, 0, strlen($url)-4);
        
        
       
        Yii::app()->ih
        ->load($url.$end)
        ->thumb(400, 400 ,true)
        ->save(false,false,99);
        
        $size = getimagesize ($url.$end);
        
        if ($size[0]>$size[1])
        {
            Yii::app()->ih
            ->load($url.$end)
            ->adaptiveThumb(280, 180)
            ->save($url.$crop.$end,false,99);
        }
        else 
        {
            Yii::app()->ih
            ->load($url.$end)
            ->adaptiveThumb(180, 280)
            ->save($url.$crop.$end,false,99);
        }
        echo $return;// it's array
    }
    
    public function actionDeletePreview()
     {        
            $end = ".jpg";
            $crop = "_crop";
            $url = $_POST['params'];
            $url = substr($url, 0, strlen($url)-4);
           
            if (file_exists($url.$end)&&file_exists($url.$crop.$end))
            {
                 //unlink($url.$end);
                //unlink($url.$crop.$end);
                    return;
              
                
                return;
            }
            
            
            else return false;
     }
     
     public function actionCropTopicPreview()
     {
            $end = ".jpg";
            $crop = "_crop";
            $url = $_POST['url'];
            $url = substr($url, 0, strlen($url)-4);
            
            if (file_exists($url.$end))
            {
                
                $coords = $_POST['coord'];
                $c = explode(" ", $coords);
                
                $x = intval($c[0]);
                $y = intval($c[1]);
                $w = intval($c[2]);
                $h = intval($c[3]);
                
                if($w>$h)
                {
                    Yii::app()->ih
                    ->load($url.$end)
                    ->crop($w, $h ,$x, $y)
                    ->resize(280, 180)
                    ->save($url.$crop.$end,false,99);
                    return;// it's array
                }
                else {
                     Yii::app()->ih
                    ->load($url.$end)
                    ->crop($w, $h ,$x, $y)
                    ->resize(180, 280)
                    ->save($url.$crop.$end,false,99);
                    return;// it's array
                }
                
            }
            else return false;
     }
     
     public function actionTipograph ()
        {
           
            $purifier = new CHtmlPurifier();
            $purifier->options = array('HTML.SafeIframe'=>true, 'URI.SafeIframeRegexp'=>'%^http://(www.youtube.com/embed/|player.vimeo.com/video/)%');
            // $purifier->options = array();
            echo $purifier->purify($_POST['text']);
            
        }
        
      public function actionRedactorUploadImage()
      {
            // This is a simplified example, which doesn't cover security of uploaded images. 
            // This example just demonstrate the logic behind the process. 


//           $folder="topics/".date('Y_m_d')."/";// folder for uploaded files
//        
//            if (!is_dir ( $folder))
//                        {
//                            //если папки нет
//                            if (!mkdir($folder)) 
//                                    throw new CHttpException(404,'can not create directory for topic.');
//                            #Изменить мод   
//                            chmod($folder, 0777); 
//                        }

            $folder = "topics/tmp/";            
            
            
            $_FILES['file']['type'] = strtolower($_FILES['file']['type']);
            
            if ($_FILES['file']['type'] == 'image/png' 
            || $_FILES['file']['type'] == 'image/jpg' 
            || $_FILES['file']['type'] == 'image/gif' 
            || $_FILES['file']['type'] == 'image/jpeg'
            || $_FILES['file']['type'] == 'image/pjpeg')
            {	
                // setting file's mysterious name
                $filename = md5(date('YmdHis')).'.jpg';
                $file = $folder.$filename;

                // copying
                //copy($_FILES['file']['tmp_name'], $file);
                 Yii::app()->ih
                ->load($_FILES['file']['tmp_name'])
                ->thumb(630, 800 ,true)
                ->save($file,false,99);
                 
                 // displaying file    
                    $array = array(
                            'filelink' => $file,
                    );

                    echo stripslashes(json_encode($array));   

            }
      }
}