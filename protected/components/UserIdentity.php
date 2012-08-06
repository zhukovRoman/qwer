<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	
	private $_id;
	
	
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
		/*
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
		
		
		$username = strtolower($this->username);
		$users = array(
		// username => password
				'demo'=>'demo',
				'admin'=>'admin',
		);
	
		
		$account = Account::model()->findByAttributes(array('mail'=>$this->username));#find('LOWER(email)=?',array($username));
		
		if ($account===null)
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else 
		{
			if (!$account->validatePassword($this->password))
			{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}
			else
			{
				$this->_id=$account->id;
		//		$this->setState('email', $user->email);
		//		$this->setState('login', $user->nickname);
			
		//		$this->setState('balls', $user->bals);
		//		$this->setState('status', $user->status_id);
			
		//		$this->_userStatus = $user->status_id;
		//		$this->username=$user->email;
				$this->errorCode=self::ERROR_NONE;
				
		//		$this->name->$user->status_id;
			
				#$this->setState('last_login', $user->last_login);
				$account->last_login = date('Y-m-d H:i:s');
				
				$account->save();
			}	
		}
		return $this->errorCode==self::ERROR_NONE;
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
				
				$account->last_login = date('Y-m-d H:i:s');
				
			//	echo $account->scenario;
			//	echo $account->save();
			//	die();
				
				$account->save(false);
			}
		}
		return $this->errorCode==self::ERROR_NONE;
	}
	
	public function getId()
	{
		return $this->_id;
	}
}