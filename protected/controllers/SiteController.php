<?php

class SiteController extends Controller
{
	//public $authIdentity;
	//public $identity;
	
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
	public function actionLogin($linkService = null)
	{	
		// Если пользователь уже залогинин - выкидываем его
		if (!Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('account/view', array('id' => Yii::app()->user->getId()))); //(Yii::app()->baseUrl);
		
		// 1. В случае входа для привязки аккаунта, выводим сообщение
		$linking = Yii::app()->request->getQuery('linkService');	
		if (isset($linking)) Yii::app()->user->setFlash('warning', 'Уважаемый пользователь! Для того, чтобы привязать аккаунт к уже существующему, войдите в него');
		
		// 2. Осуществляем AJAX-валидацию
		$model=new LoginForm;
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && ($_POST['ajax']==='window-login-form' || $_POST['ajax']==='modal-login-form' ))
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		// 3. Осуществляем аутентификацию через сторонние сервисы
		$service = Yii::app()->request->getQuery('service');
		
		if (isset($service)) 
		{
			$authIdentity = Yii::app()->eauth->getIdentity($service);
			$authIdentity->redirectUrl = Yii::app()->user->returnUrl;
			$authIdentity->cancelUrl = Yii::app()->createAbsoluteUrl('site/login');
		
			if ($authIdentity->authenticate()) 
			{				
				$identity = new EAuthUserIdentity($authIdentity);
		
				// успешная авторизация
				if ($identity->authenticate()) 
				{
					// Осуществляем поиск пользователя
					switch($service)
					{
						/* ----------------------------------------------- */
						case Account::SCENARIO_VKONTAKTE:
							$account = Account::model()->findByAttributes(array ('vk_id' => $identity->getId()));
							
							break;
							/* ----------------------------------------------- */
						case Account::SCENARIO_FACEBOOK:
							$account = Account::model()->findByAttributes(array ('fb_id' => $identity->getId()));
							
							break;
							/* ----------------------------------------------- */
						case Account::SCENARIO_TWITTER:
							$account = Account::model()->findByAttributes(array ('tw_id' => $identity->getId()));
							
							break;
							/* ----------------------------------------------- */
						case Account::SCENARIO_ODNOKLASSNIKI:
							$account = Account::model()->findByAttributes(array ('ok_id' => $identity->getId()));
							
							break;
					}
					// Если такой аккаунт не найден - регистрируем нового пользователя в системе
					if (empty($account))
					{	
						// Выводим модальное окно с вопросом о существовании аккаунта
						$authIdentity->redirect(Yii::app()->createUrl('site/newaccount', array('service' => $service)));

						//$this->render('new_account', array('service' => $service));
						//return;
						//$this->render('new_account');
						//return;
					}
					// Логинимся
					Yii::app()->user->setId($account->id);
					Yii::app()->user->login($identity);
					Yii::app()->user->setId($account->id);
					Yii::app()->user->setState('name', $account->login);
					
					// специальное перенаправления для корректного закрытия всплывающего окна	
					if (isset($linking))
					{
						//echo $linkService; die();
						$authIdentity->redirect(Yii::app()->createUrl('account/linking', array('id' => $account->id, 'service' => $linkService)));
					}
					$authIdentity->redirect(Yii::app()->createUrl('account/view', array('id' => $account->id)));//$this->createAbsoluteUrl('site/registration', array('identity' => $authIdentity)));
				}
				else 
				{
					// закрытие всплывающего окна и перенаправление на cancelUrl
					$authIdentity->cancel();
				}
			}
			// авторизация не удалась, перенаправляем на страницу входа
			if (isset($linking)) $this->redirect(array('site/login', 'linkService' => $linkService)); 
			$this->redirect(array('site/login'));
		}

		
		// 4. Осуществляем стандартную аутентификацию
		// collect user input data
		if(isset($_POST['LoginForm']))
		{	
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				//echo $linkService; die();
				
				if (isset($linking)) $this->redirect(Yii::app()->createUrl('account/linking', array('id' => Yii::app()->user->getId(), 'service' => $linkService)));
				$this->redirect(Yii::app()->user->returnUrl);	
			}
			else
			{
				//Yii::app()->user->setFlash('login', 'Login error');
				if (isset($linking)) $this->redirect(array('site/login', 'linkService' => $linkService));
				$this->redirect(array('site/login'));
			}
		}
		// display the login form
		 $this->render('login', array('model'=>$model, 'linkService' => $linkService));
		//$this->renderPartial('modal_login', array('model'=>$model), false, true);
		//$('#dialogLogin').modal('show'); 
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	
	public function actionNewAccount($service)
	{
		$this->render('new_account', array('service' => $service));
	}
	
	public function actionRegistration($service) // $authIdentity, $identity ????????????????????
	{
		$authIdentity = Yii::app()->eauth->getIdentity($service);
		$authIdentity->authenticate();
		$identity = new EAuthUserIdentity($authIdentity);
		$identity->authenticate();
		
		
		// Регистрация
		$account = new Account($service);
		$account->mail = '';
		$account->password = '';
		$account->status_id = 4;
		$account->register_date = date('Y-m-d H:i:s');
		$account->last_login = date('Y-m-d H:i:s');
		
		switch($account->scenario)
		{
			/* ----------------------------------------------- */
			case Account::SCENARIO_VKONTAKTE:
				$account->setLogin($authIdentity->getAttribute('username'));				
				$account->last_name = $authIdentity->getAttribute('last_name');
				$account->first_name = $authIdentity->getAttribute('first_name');
				$account->birth_date = $authIdentity->getAttribute('birth_date');
				$account->sex = $authIdentity->getAttribute('gender');
				$account->vk_url = $authIdentity->getAttribute('url');
				$account->avatar_url = '200;200;0;0';
				$account->vk_id = $identity->getId();
				
				$account->save(); 	// Сохраняем пользователя
				
				// Создаем пользователю личную папку
				mkdir(Account::ACCOUNT_DIR . $account->id, 0777, true);
				// Загружаем и сохраняем аватарку
				Yii::app()->ih
					->load($authIdentity->getAttribute('photo_big'))
					->save(Account::ACCOUNT_DIR . $account->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME, IMG_JPEG, 100);
				// Загружаем и сохраняем юзерпик
				Yii::app()->ih
					->load($authIdentity->getAttribute('photo_rec'))
					->save(Account::ACCOUNT_DIR . $account->id . DIRECTORY_SEPARATOR  . Account::USERPIC_NAME, IMG_JPEG, 100);

				
				break;
				/* ----------------------------------------------- */
			case Account::SCENARIO_FACEBOOK:
				$account->setLogin($authIdentity->getAttribute('name'));
				$account->last_name = $authIdentity->getAttribute('last_name');
				$account->first_name = $authIdentity->getAttribute('first_name');
				$account->birth_date = $authIdentity->getAttribute('birth_date');
				$account->sex = $authIdentity->getAttribute('gender');
				$account->fb_url = $authIdentity->getAttribute('url');
				$account->avatar_url = '200;200;0;0';
				$account->fb_id = $identity->getId();
				
				$account->save(); 	// Сохраняем пользователя
				
				// Создаем пользователю личную папку
				mkdir(Account::ACCOUNT_DIR . $account->id, 0777, true);
				// Загружаем и сохраняем аватарку
				Yii::app()->ih
					->load($authIdentity->getAttribute('picture'))
					->save(Account::ACCOUNT_DIR . $account->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME, IMG_JPEG, 100);
				// Загружаем и сохраняем юзерпик
				Yii::app()->ih
					->load($authIdentity->getAttribute('userpic'))
					->save(Account::ACCOUNT_DIR . $account->id . DIRECTORY_SEPARATOR  . Account::USERPIC_NAME, IMG_JPEG, 100);

				break;
				/* ----------------------------------------------- */
			case Account::SCENARIO_TWITTER:
				$account->setLogin($authIdentity->getAttribute('username'));
				$account->last_name = $authIdentity->getAttribute('last_name');
				$account->first_name = $authIdentity->getAttribute('first_name');
				$account->tw_url = $authIdentity->getAttribute('url');
				$account->avatar_url = '200;200;0;0';
				$account->tw_id = $identity->getId();
				
				$account->save(); 	// Сохраняем пользователя
				
				// Создаем пользователю личную папку
				mkdir(Account::ACCOUNT_DIR . $account->id, 0777, true);
				// Загружаем и сохраняем аватарку
				Yii::app()->ih
					->load($authIdentity->getAttribute('picture'))
				//	->thumb(200,200)
					->save(Account::ACCOUNT_DIR . $account->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME, IMG_JPEG, 100);
				// Загружаем и сохраняем юзерпик
				Yii::app()->ih
					->load($authIdentity->getAttribute('userpic'))
					->save(Account::ACCOUNT_DIR . $account->id . DIRECTORY_SEPARATOR  . Account::USERPIC_NAME, IMG_JPEG, 100);

				break;
				/* ----------------------------------------------- */
			case Account::SCENARIO_ODNOKLASSNIKI:
			
				break;
		}
		$account->save();	

		// Логинимся
		Yii::app()->user->login($identity);
		Yii::app()->user->setId($account->id);
		Yii::app()->user->setState('name', $account->login);
		
		// Открываем профиль нового пользователя - Осуществляем подтверждение логина пользователя
		$authIdentity->redirect(Yii::app()->createUrl('account/selectlogin', array('id' => $account->id)));
	}
	
/*****************************************************************************/
/*					Работа с изображениями и тому подобным					 */
/*****************************************************************************/
	
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
        $sizeLimit = 7 * 1024 * 1024;// maximum file size in bytes
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
        ->thumb(500, 330 ,true)
        ->save(false,false,99);
        $size = getimagesize ($url.$end);

        Yii::app()->ih
        ->load($url.$end)
        ->adaptiveThumb(450, 290)
        ->save($url.$crop.$end,false,99);
       
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
                    ->resize(450, 290)
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