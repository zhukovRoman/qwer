<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	
	public $activationCode;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// username and password needs to be authenticated
			array('password', 'authenticate'),
			//array('username', 'authenticate'),
			//array('username, password', 'authenticate'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			
			// username должен соответствовать шаблону
			//array('username', 'match', 'pattern'=>'/^[A-z][\w]+$/'),
			// username должен быть корректным e-mail адресом
			//array('username', 'email'),
			// username должен существовать
			//array('username', 'exist', 'enableClientValidation' => true , 'allowEmpty' => true, 'attributeName' => 'mail', 'className' => 'Account', 'message' => 'Пользователь с таким e-mail не найден'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'Логин или e-mail',
			'password'=>'Пароль',
			'rememberMe'=>'Запомнить меня',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		//$model=new LoginForm;
		//$this->performAjaxValidation($model);
		
		if (true)//(!$this->hasErrors())//
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			
			/*
			switch($this->_identity->errorCode)
			{
				case UserIdentity::ERROR_NONE:
					//Yii::app()->user->login($identity);
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->addError('username','Email address is incorrect.');
					break;
				default: // UserIdentity::ERROR_PASSWORD_INVALID
					//$this->addError('password','Password is incorrect.');
					$this->addError('username','Email address is incorrect.');
				break;*/
			
			$this->_identity->authenticate();
			//$this->addError('password', 'Incorrect username or password.' . $this->_identity->errorCode);
			//return;
			
			switch($this->_identity->errorCode)
			{
				/*case UserIdentity::ERROR_NONE:
					$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
					Yii::app()->user->login($identity,$duration);
					break;
				*/case UserIdentity::ERROR_EMAIL_INVALID:
					//Yii::app()->user->setFlash('error', '<strong>Oh snap!</strong> Change a few things up and try submitting again.');
					$this->addError('username', 'Неверный e-mail');
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->addError('username', 'Неверный логин');
					break;
				case UserIdentity::ERROR_STATUS_NOTACTIVATED:
					$this->addError('username', 'Ваш аккаунт еще не активирован');
					break;
				case UserIdentity::ERROR_STATUS_BANNED:
					Yii::app()->user->setFlash('error', '<strong>Oh snap!</strong> Change a few things up and try submitting again.');
					$this->addError('username', 'Ваш аккаунт заблокирован');
					break;
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$this->addError('password', 'Неверный пароль');
					break;
			}
		}
		
		/*	if(!$this->_identity->authenticate())
			{
				$this->addError('password', 'Incorrect username or password.' . $this->_identity->errorCode);
			//	if ($this->_identity->errorCode === UserIdentity::ERROR_USERNAME_INVALID)
			//	$this->addError('username', 'Неверное333 имя пользователя или пароль.');
			//	else
			//	$this->addError('password', 'Неверное имя пользователя или пароль.');
				//$this->addError('username', 'Неверное имя пользователя или пароль.');
			}	
		}*/
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
	
	// Логин с помощью активационного кода
	public function loginByActivationCode()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->activationCode);
			$this->_identity->authenticateByActivationCode();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
