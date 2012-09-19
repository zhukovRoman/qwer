<?php

class AccountController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
/*	public function filters()
	{
		return array(
			'accessControl',//'rights',// // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
/*	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(
						'index',			// 1. Просмотр всех пользователей
						
						'view',				// 2. Просмотр профиля пользователя
						'update',			// 3. Обновление информации о пользователи
						'create',			// 4. Создание пользователя
						
						'signup',			// 5. Регистрация
						'activation',		// 6. Активация аккаунта
						'selectlogin',		// 7. Выбор логина
						
						'passrecovery',		// 8. Восстановление пароля
						'selectpass',		// 9. Выбор пароля	
						 			
						'avatarload',		// 10. Загрузка аватара 
						'avatardelete', 	// 11. Удаление аватара
						'userpic',			// 12. Редактирование миниатюры

						'linking', 			// 13. Привязка аккаунта соц.сети
						'unlinking',		// 14. Отвязка аккаунта соц.сети
						
						'admin', 			// 15. Администрирование пользователя
						'delete'			// 16. Удаление пользователя 
				),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
                $this->pageTitle="Fresh-i - Личный кабинет";
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (!Yii::app()->user->checkAccess('createAccount'))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
		$model=new Account;
		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
                $this->pageTitle="Fresh-i - Регистрация";
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		//$model->scenario = '';//Account::SCENARIO_UPDATE; 
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (!Yii::app()->user->checkAccess('updateOwnAccount', array('Account' => $model)))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
			
		
		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
			ActiveDateSelect::sanitize($model, 'birth_date');
                        $purifier = new CHtmlPurifier();
                        
                        $model->about = $purifier->purify($_POST['Account']['about']);;

			//$model->first_name=$_POST['Account']['first_name'];
			
		/*	echo $model->scenario;
			
			echo $model->save();
			

			print_r($_POST['Account']);
			print_r($model->attributes); 
			
			print_r($model->safeAttributeNames);
			die();*/
			
			//print_r($model->birth_date);die();
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (!Yii::app()->user->checkAccess('deleteAccount'))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
		
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
//	public function actionIndex()
//	{
//            
//		if (!Yii::app()->user->checkAccess('indexAccount'))
//			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
//		
//		$dataProvider=new CActiveDataProvider('Account');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
//	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{	
		if (!Yii::app()->user->checkAccess('adminAccount'))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
				
		$model=new Account('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Account']))
			$model->attributes=$_GET['Account'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	// Действие регистрации
	public function actionSignup()
	{
		// Создать модель и указать ей, что используется сценарий регистрации
		$model = new Account(Account::SCENARIO_SIGNUP);
	
		//if (!Yii::app()->user->isGuest)
		//	throw new CHttpException(403, 'Недостаточно прав для указанного действия');
		
		// В случае запроса аякс-валидации
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		// Если пришли данные для сохранения
		if(isset($_POST['Account']))
		{
			// Безопасное присваивание значений атрибутам
			$model->attributes = $_POST['Account'];
	
			// Проверка данных
			if($model->validate())
			{
				// Сохранить полученные данные
				// false нужен для того, чтобы не производить повторную проверку
				$model->save(false);
				
				// Отправляем письмо с активационным кодом
				$this->sendActivationKey($model);
				
				// Вывести форму благодарности за регистрацию
				$this->render('signup2');
				return;
			}
		}
                $this->pageTitle="Fresh-i - Вход";
		// Вывести форму
		$this->render('signup', array('model'=>$model));
	}
	
	// Действие активации профиля
	public function actionActivation()
	{	
		$notActivatedId; // ID роли not_activated в таблице пользовательских статусов
		$userId;		 // ID роли user в таблице пользовательских статусов
		
		if (isset($_GET['key']))
		{
			$model = Account::model()->findByAttributes(array ('activate_key' => $_GET['key']));
		
			if (!empty($model))
			{				
				// Поиск в таблице пользовательских статусов
				$notActivatedId = UserStatus::model()->findByAttributes(array ('name' => Account::ROLE_NOTACTIVATED))->id;
				$userId = UserStatus::model()->findByAttributes(array ('name' => Account::ROLE_USER))->id;
				
				if ($model->status_id <> $notActivatedId)
				{
					$this->render('already_activated');
				}
				else
				{
					// Осуществляем авто-логин пользователя
					$account = new LoginForm;
					$account->username = $model->mail;
					$account->activationCode = $model->activate_key;
					
					if ($account->loginByActivationCode())	// Если пользователь аутентифицирован
					{
						//$model->status_id = $userId;		// Изменяем статус пользователя
						$model->activate_key = 'activated'; // Убираем ключ из базы
						$model->last_login = date('Y-m-d H:i:s');
						$model->save();						// Сохраняем изменения
					}
					else 
					{
						throw new CHttpException(403, 'Неверный код на активацию аккаунта.');
					}
					// Перенаправить на выбор логина					
					$this->redirect(array('selectlogin','id'=>$model->id));
				}
			}
			else
			{
				// Если нет такого ключа то выводим сообщение об ошибке
				throw new CHttpException(403, 'Неверный код на активацию аккаунта.');
			}
		}
		else
		{
			// Если не передан ключ активации, редиректим обратно
			$this->redirect(Yii::app()->user->returnUrl);
		}
	}
	
	// Действие выбора логина
	public function actionSelectlogin($id)
	{
		// Создать модель и указать ей, что используется сценарий регистрации
		$model = Account::model()->findByPk($id);
		$model->scenario = Account::SCENARIO_SELECTLOGIN;
		
		if (!Yii::app()->user->checkAccess('selectOwnLogin', array('Account' => $model)))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
		
		// В случае запроса аякс-валидации
		if(isset($_POST['ajax']) && $_POST['ajax']==='selectlogin-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		// Если пришли данные для сохранения
		if(isset($_POST['Account']))
		{
			// Безопасное присваивание значений атрибутам
			$model->attributes = $_POST['Account'];
			// Изменяем статус пользователя
			$model->status_id = UserStatus::model()->findByAttributes(array ('name' => Account::ROLE_USER))->id;		
			
			// Проверка данных
			if($model->validate())
			{
				// Сохранить полученные данные
				// false нужен для того, чтобы не производить повторную проверку
				$model->save(false);
				Yii::app()->user->setState('name', $model->login);
				
				// Перенаправить на редактирование личных данных
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		$this->pageTitle="Fresh-i - Выбор логина";
		// Вывести форму
		$this->render('signup3', array('model'=>$model));
	}
	
	// Действие восстановления пароля
	public function actionPassrecovery()
	{
		$model = new Account(Account::SCENARIO_PASSRECOVERY);
		
		// В случае запроса аякс-валидации
		if(isset($_POST['ajax']) && $_POST['ajax']==='passrecovery-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		if(isset($_POST['Account']))
		{
			$model->attributes = $_POST['Account'];
		
			if ($model->validate())
			{
				$query = new Account(Account::SCENARIO_PASSRECOVERY);
				$query = Account::model()->find('mail=?', array($model->mail));

				if ($query != NULL)
				{
					$query->newpass_key = md5($query->mail . time());
					$query->save();

					$this->sendPassrecoveryKey($query);
					
					$this->render('send_newpasskey');
					return;
					//Yii::app()->user->setFlash('success', "На указанный email было отправленно письмо для подтверждения регистрации!");
				}
				else
				{
					throw new CHttpException(403, 'Пользователь с таким адресом электронной почты не найден.');
				}
			}
		}
		$this->pageTitle="Fresh-i - Восстановление пароля";
		$this->render('passrecovery', array('model'=>$model));
	}
	
	// Действие смены пароля
	public function actionSelectpass()
	{
		$model = new Account(Account::SCENARIO_SELECTPASS);
		
		if (isset($_GET['key']))
		{
			$query = Account::model()->findByAttributes(array ('newpass_key' => $_GET['key']));
			
			if (empty($query))
			{
				// Если нет такого ключа, то выводим сообщение об ошибке
				throw new CHttpException(403, 'Неверный код на восстановление пароля.');
			}
			else
			{
				if (isset($_POST['Account']))
				{
					$model->attributes = $_POST['Account'];
					
					if ($model->validate())
					{
						//$query->password = $model->hashPassword($model->password);
						$query->password = crypt($model->password,  Randomness::blowfishSalt());
						$query->newpass_key = 'recovered'; // Убираем ключ из базы
						$query->save();
						$this->render('pass_selected');
						return;
					}
				}
			}
		}
		else
		{
			//throw new CHttpException(404,'The requested page does not exist.');
			// Если не передан ключ активации, редиректим обратно
			$this->redirect(Yii::app()->user->returnUrl);
		}
		$this->pageTitle="Fresh-i - смена пароля";
		$this->render('input_newpass', array('model' => $model));
	}
	
	// Действие загрузки аватара
	public function actionAvatarload($id)
	{
		$model = $this->loadModel($id);
		//$model->scenario = '';//Account::SCENARIO_UPDATE;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		
		//print_r($_POST['params']);
		//echo $model->avatar_url;	
		//die();
		
		if (!Yii::app()->user->checkAccess('updateOwnAccount', array('Account' => $model)))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
		
		if(isset($_POST['params']))
		{
			if ($_POST['params'] == 'submit')
			{
				Yii::app()->ih
					->load(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::NEW_AVATAR_NAME)
					->save(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME);
			}
			if (file_exists(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::NEW_AVATAR_NAME))
				unlink(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::NEW_AVATAR_NAME);
			//else return;
			//$model->avatar_url = $_POST['params'];
			//$model->save(false);
			
			//if($model->save())
			//	$this->redirect(array('view','id'=>$model->id));
		}
/*		
		$this->render('update',array(
				'model'=>$model,
		));*/
		// Перенаправить на редактирование личных данных
		//$this->redirect(array('update','id'=>$model->id));
	}
	
	// Действие редактирование юзерпика
	public function actionUserpic($id)
	{
		$model = $this->loadModel($id);
		
		if (!Yii::app()->user->checkAccess('updateOwnAccount', array('Account' => $model)))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
		
		if(isset($_POST['params']))
		{
			// Записываем координаты в базу данных
			$model->avatar_url = $_POST['params'];
			$model->save(false);
			// Парсим из 'params' координаты
			$mass = explode(";", $_POST['params']); 
			//print_r($mass);die();
			
			// 2 варианта 
			// a) Аватар уже существует - файла New_Avatar.jpg нет
			if (!file_exists(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::NEW_AVATAR_NAME))
				Yii::app()->ih
					->load(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME)
					->crop($mass[0],$mass[1],$mass[2],$mass[3])//crop(150, 150, 10, 10)
					->save(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::USERPIC_NAME);
			// b) Аватар еще не был загружен
			else
			{
				Yii::app()->ih
					->load(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::NEW_AVATAR_NAME)
					->save(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME);
				
				unlink(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::NEW_AVATAR_NAME);
				
				Yii::app()->ih
					->load(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME)
					->crop($mass[0],$mass[1],$mass[2],$mass[3])
					->save(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::USERPIC_NAME);
			}
		}

	}
	
	// Действие удаления аватара
	public function actionAvatardelete($id)
	{
		$model = $this->loadModel($id);
		$model->scenario = Account::SCENARIO_LINKING;
		
		if (!Yii::app()->user->checkAccess('updateOwnAccount', array('Account' => $model)))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
		
		if (file_exists(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME))
			unlink(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::AVATAR_NAME);
		if (file_exists(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::USERPIC_NAME))
			unlink(Account::ACCOUNT_DIR . $model->id . DIRECTORY_SEPARATOR  . Account::USERPIC_NAME);
	}
	
	// Действие привязки сайта к аккаунту
	public function actionLinking($id, $service)
	{
		$model = $this->loadModel($id); // !!! СЦЕНАРИЙ !!!  и валидация для него! (Уникальность)
		$model->scenario = Account::SCENARIO_LINKING;
		
		if (!Yii::app()->user->checkAccess('updateOwnAccount', array('Account' => $model)))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
		
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
					// Осуществляем привязку пользователя
					switch($service)
					{
						/* ----------------------------------------------- */
						case Account::SCENARIO_VKONTAKTE:
							$account = Account::model()->findByAttributes(array ('vk_id' => $identity->getId()));
							if (empty($account))
							{
								$model->vk_url = $authIdentity->getAttribute('url');
								$model->vk_id = $identity->getId();
							}
							break;
							/* ----------------------------------------------- */
						case Account::SCENARIO_FACEBOOK:
							$account = Account::model()->findByAttributes(array ('fb_id' => $identity->getId()));
							if (empty($account))
							{
								$model->fb_url = $authIdentity->getAttribute('url');
								$model->fb_id = $identity->getId();
							}
							break;
							/* ----------------------------------------------- */
						case Account::SCENARIO_TWITTER:
							$account = Account::model()->findByAttributes(array ('tw_id' => $identity->getId()));
							if (empty($account))
							{
								$model->tw_url = $authIdentity->getAttribute('url');
								$model->tw_id = $identity->getId();
							}
							break;
							/* ----------------------------------------------- */
						case Account::SCENARIO_ODNOKLASSNIKI:
							$account = Account::model()->findByAttributes(array ('ok_id' => $identity->getId()));
							if (empty($account))
							{
								$model->ok_url = $authIdentity->getAttribute('url');
								$model->ok_id = $identity->getId();
							}
							break;
					}
					// Выводим сообщение об ошибке
					if (!empty($account))					
						Yii::app()->user->setFlash('error', 'Ошибка! Аккаунт занят другим пользователем.');
					else 
					{
						// Проверка данных
						if($model->validate())
						{
							// Сохранить полученные данные
							// false нужен для того, чтобы не производить повторную проверку
							$model->save(false);
						
							// специальное перенаправления для корректного закрытия всплывающего окна
							$authIdentity->redirect(array('view','id'=>$model->id));
						}
					}
				}
				else
				{
					// закрытие всплывающего окна и перенаправление на cancelUrl
					$authIdentity->cancel();
				}
			}
			// авторизация не удалась, перенаправляем на страницу входа
			// $this->redirect(array('site/login'));
		} 
		// Вывести форму
		$this->redirect(array('view','id'=>$model->id));//render('view', array('model'=>$model));	
	}
	
	// Действие отвязки сайта от аккаунта
	public function actionUnlinking($id, $service)
	{
		$model = $this->loadModel($id); // !!! СЦЕНАРИЙ !!!  и валидация для него! (Уникальность)
		//$model->scenario = Account::SCENARIO_LINKING;
	
		if (!Yii::app()->user->checkAccess('updateOwnAccount', array('Account' => $model)))
			throw new CHttpException(403, 'Недостаточно прав для указанного действия');
		
		if (isset($service))
		{
			switch($service)
			{
				/* ----------------------------------------------- */
				case Account::SCENARIO_VKONTAKTE:
					$model->vk_url = null;
					$model->vk_id = null;
					break;
					/* ----------------------------------------------- */
				case Account::SCENARIO_FACEBOOK:
					$model->fb_url = null;
					$model->fb_id = null;
					break;
					/* ----------------------------------------------- */
				case Account::SCENARIO_TWITTER:	
					$model->tw_url = null;
					$model->tw_id = null;
					break;
					/* ----------------------------------------------- */
				case Account::SCENARIO_ODNOKLASSNIKI:
					$model->ok_url = null;
					$model->ok_id = null;
					break;
			}
			
			// Определяем возможность удаления аккаунта 
			//	* У пользователя нет стандартного аккаунта и все аккаунты стали пусты
			if ((empty($model->mail) || empty($model->password)) && (($model->vk_id || $model->fb_id || $model->tw_id) == null)) 
				Yii::app()->user->setFlash('error', 'Ошибка! Вы не можете удалить данный аккаунт.');
			else 
			{
				// Проверка данных
				if($model->validate())
				{
					// Сохранить полученные данные
					// false нужен для того, чтобы не производить повторную проверку
					$model->save(false);
	
					// Направляем в профиль
					$this->redirect(array('view','id'=>$model->id));
				}
			}
		}

		$this->redirect(array('view','id'=>$model->id));//$this->render('view', array('model'=>$model));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Account::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/*
	 * Отправление кода активации
	 *
	 */
	protected function sendActivationKey($model)
	{
		// Получатель
		$to = $model->mail;
		
		// Тема 
		$subject = 'Регистрация';
		
		// Ссылки
		$main = Yii::app()->createAbsoluteUrl('site/index');												// на главную страницу
		$link = Yii::app()->createAbsoluteUrl('account/activation', array('key' =>$model->activate_key));	// на страницу активации

		$message = "
			<html>
				<head><title>Регистрация</title></head>
				<body>
					Вы успешно зарегистрировались на портале <a href='$main' target='_blank'>".Yii::app()->name."</a>
					<br>Для завершения регистрации вам необходимо активировать аккаунт, пройдя по <a href=".$link." target='_blank'>ссылке</a>
					
					<br><br>
					<i>С уважением, администрация <a href='$main' target='_blank'>".Yii::app()->name."</a></i>
				</body>
			</html>
		";
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		
		// Additional headers
		$headers .= 'From: '.Yii::app()->name.' <'.Yii::app()->params['adminEmail'].'>' . "\r\n";
		
		// Отправляем письмо 
		mail($to, $subject, $message, $headers);
	}
	
	/*
	 * Отправление кода воостановления пароля
	*
	*/
	protected function sendPassrecoveryKey($model)
	{
		// Получатель
		$to = $model->mail;
	
		// Тема
		$subject = 'Восстановление пароля';
	
		// Ссылки
		$main = Yii::app()->createAbsoluteUrl('site/index');												// на главную страницу
		$link = Yii::app()->createAbsoluteUrl('account/selectpass', array('key' =>$model->newpass_key));	// на страницу восстановления
		
		$message = "
			<html>
				<head><title>Восстановление пароля</title></head>
				<body>
					Если Вы хотите сменить себе пароль на портале <a href='$main' target='_blank'>".Yii::app()->name."</a>,
					то перейдите по <a href=".$link." target='_blank'>данной ссылке</a>
				
					<br><br>
					<i>С уважением, администрация <a href='$main' target='_blank'>".Yii::app()->name."</a></i>
				</body>
			</html>
		";
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		
		// Additional headers
		$headers .= 'From: '.Yii::app()->name.' <'.Yii::app()->params['adminEmail'].'>' . "\r\n";
		
		// Отправляем письмо 
		mail($to, $subject, $message, $headers);
	}
        
        public function actionfav($id)
        {
            $model = $this->loadModel($id);
            
            $criteria=new CDbCriteria;
	    $criteria->condition = 'user_id=:user AND t.status_id=5';
	    $criteria->params = array(':user'=>$id);
	    $criteria->with = array('favourites'=>array('together'=>true));
	    $criteria -> order = 'favourites.time_add DESC';
	 
            $dataProvider = new CActiveDataProvider('Post', array (
                                'pagination' => array(
                            'pageSize' => 12,
                        ),
                'criteria'=>$criteria ));

            $this->pageTitle="Fresh-i - Избранное";
            $this->render('/account/posts', array(
                    'dataProvider' => $dataProvider,
                    'model'=>$model,
            ));
        }
        
        public function actionCreated($id)
        {
            $model = $this->loadModel($id);
            if ($id == Yii::app()->user->getId()){
                    $criteria = new CDbCriteria(array(
                    'condition'=>"author_id = $id",
                    'order' => 'time_add',
                ));    
            } else {
                $criteria = new CDbCriteria(array(
                    'condition'=>"status_id=5 AND author_id = $id",
                    'order' => 'time_add',
                ));    
            }

            $dataProvider = new CActiveDataProvider('Post', array(
                        'pagination' => array(
                            'pageSize' => 12,
                        ),
                        'criteria' => $criteria ));
            $this->pageTitle="Fresh-i - Созданное";
            $this->render('/account/posts', array(
                    'dataProvider' => $dataProvider,
                    'model'=>$model,
            ));
        }
        
        public function actionChRole($id)
        {
             if (!Yii::app()->user->checkAccess('adminAccount'))
            throw new CHttpException(403, 'Недостаточно прав для указанного действия. 
                            Авторизуйтесь под своей учетной записью для получения доступа к этой странице.');
            
            $model = $this->loadModel($id);
            
            if (isset($_POST['Account'])) {
                
                $model->status_id=$_POST['Account']['status_id'];
                if ($model->save(false))
                   $this->redirect (Yii::app()->createUrl('account/view', array ('id'=>$id))) ;
                    
            }
            
            
            
            $this->render('/account/_change_role_form', array(
                    'model'=>$model,
            ));
        }
}
