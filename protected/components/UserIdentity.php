<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	
	private $_id;
	
	const ERROR_EMAIL_INVALID=3;
	const ERROR_STATUS_NOTACTIVATED=4;
	const ERROR_STATUS_BANNED=5;
	
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		/*$notActivatedId; // ID роли not_activated в таблице пользовательских статусов
		$bannedId;		 // ID роли user в таблице пользовательских статусов
		
		// Поиск в таблице пользовательских статусов
		$notActivatedId = UserStatus::model()->findByAttributes(array ('name' => Account::ROLE_NOTACTIVATED))->id;
		$bannedId = UserStatus::model()->findByAttributes(array ('name' => Account::ROLE_BANNED))->id;
		
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
		*/
				
		/*
		$record=User::model()->findByAttributes(array('username'=>$this->username));
		if($record===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($record->password!==md5($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$record->id;
			$this->setState('title', $record->title);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
		*/
		
		
		//$username = strtolower($this->username);
		
		//echo strtolower($this->username);
		//die();
		
		/*$users = array(
		// username => password
				'demo'=>'demo',
				'admin'=>'admin',
		);*/
	
		
		//$account = Account::model()->findByAttributes(array('mail'=>$username)); // #find('LOWER(email)=?',array($username));
		
		// Если пользователь заходит по e-mail, приводим к нижнему регистру
		if (strpos($this->username,'@')) $username = strtolower($this->username); else  $username = $this->username;
	
		$account = Account::model()->find('login=:username OR mail=:username', array(':username'=>$username));
		
		if ($account===null)
		{
			if (strpos($this->username,'@')) $this->errorCode=self::ERROR_EMAIL_INVALID; else $this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else 
		{
			//if (!$account->validatePassword(
			//		md5($account->password) . md5($account->mail . $account->register_date) . md5(Yii::app()->params['commonSalt'])
			//))
				
			if ( !$account->validatePassword ( $this->password , $account->password ))
			{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}
			else
			{
				if ($account->status_id == UserStatus::model()->findByAttributes(array ('name' => Account::ROLE_NOTACTIVATED))->id)
				{
					$this->errorCode=self::ERROR_STATUS_NOTACTIVATED;
				}
				else
				{
					if ($account->status_id == UserStatus::model()->findByAttributes(array ('name' => Account::ROLE_BANNED))->id)
					{
						$this->errorCode=self::ERROR_STATUS_BANNED;
					}
					else 
					{
						$this->_id=$account->id;
						$this->errorCode=self::ERROR_NONE;
						
						$account->last_login = date('Y-m-d H:i:s');
						$account->save();
					}
				}
			}	
		}
		return !$this->errorCode;
	}
	
	public function authenticateByActivationCode()
	{
		$account = Account::model()->findByAttributes(array('mail'=>$this->username));
		
		if ($account===null)
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else 
		{
			if ($account->activate_key !== $this->password)//(!$account->validatePassword($this->password))
			{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}
			else
			{
				$this->_id = $account->id;
				$this->errorCode=self::ERROR_NONE;
			}
		}
		return $this->errorCode==self::ERROR_NONE;
	}
	
	public function getId()
	{
		return $this->_id;
	}
}