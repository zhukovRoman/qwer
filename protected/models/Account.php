<?php

/**
 * This is the model class for table "account".
 *
 * The followings are the available columns in table 'account':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $mail
 * @property string $avatar_url
 * @property string $first_name
 * @property string $last_name
 * @property string $sex
 * @property integer $country_id
 * @property integer $region_id
 * @property integer $city_id
 * @property string $birth_date
 * @property string $phone
 * @property string $about
 * @property integer $status_id
 * @property integer $rating
 * @property integer $balance
 * @property string $register_date
 * @property string $last_login
 * @property string $user_ip
 * @property string $activate_key
 * @property string $newpass_key
 * @property string $referral
 * @property integer $badge
 * @property string $vk_url
 * @property string $tw_url
 * @property integer $post_count
 * @property integer $comment_count
 * @property integer $friend_count
 * @property integer $subscribe_count
 * @property integer $all_vote_count
 * @property integer $positive_vote_count
 * @property integer $new_msg_count
 * @property integer $new_friend_count
 *
 * The followings are the available model relations:
 * @property CommentRating[] $commentRatings
 * @property CommentRating[] $commentRatings1
 * @property PostRating[] $postRatings
 * @property PostRating[] $postRatings1
 * @property Comment[] $comments
 * @property UserStatus $status
 * @property City $city
 * @property Country $country
 * @property Region $region
 * @property Badge $badge0
 * @property Favourites[] $favourites
 * @property Image[] $images
 * @property Audio[] $audios
 * @property Video[] $videos
 * @property Coupon[] $coupons
 * @property Files[] $files
 * @property Folder[] $folders
 * @property Friend[] $friends
 * @property Friend[] $friends1
 * @property Message[] $messages
 * @property Message[] $messages1
 * @property Post[] $posts
 * @property Subscribe[] $subscribes
 * @property Subscribe[] $subscribes1
 * @property Channel[] $channels
 * @property Album[] $albums
 * @property Playlist[] $playlists
 */

class Account extends CActiveRecord
{
	/***************************************************************************/
	/*                       1. Описание констант ролей                        */
	/***************************************************************************/
	const ROLE_ADMIN = 'administrator';
	const ROLE_MODER = 'moderator';
	const ROLE_USER = 'user';
	const ROLE_NOTACTIVATED   = 'not_activated';
	const ROLE_BANNED = 'banned';

	/***************************************************************************/
	/*                       2. Описание констант путей                        */
	/***************************************************************************/
	// Папка для сохранения пользовательских файлов (аватар, юзерпик)
	const ACCOUNT_DIR = 'uploads/';
	// Папка, содержащай аватрар и юзерпик по умолчанию
	const DEFAULT_DIR = 'defaults/';
	// Стандартное имя для аватара
	const AVATAR_NAME = 'avatar.jpg';
	// Стандартное имя для юзерпика
	const USERPIC_NAME = '25x25.jpg';
	// Стандартное имя для нового аватара
	const NEW_AVATAR_NAME = 'new_avatar.jpg';
	
	/***************************************************************************/
	/*                    3. Описание констант сценариев                       */
	/***************************************************************************/
	// Сценарий регистрации
	const SCENARIO_SIGNUP = 'signup';
	// Сценарий установки логина
	const SCENARIO_SELECTLOGIN = 'selectlogin';
	// Сценарий восстановления пароля
	const SCENARIO_PASSRECOVERY = 'passrecovery';
	// Сценарий установки пароля
	const SCENARIO_SELECTPASS = 'selectpass';
	// Сценарий обновления профиля
	const SCENARIO_UPDATE = 'update';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Account the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	
	public function rules()
	{
		return array(
				/***************************************************************************/
				/*                         Адрес электорнной почты                         */
				/***************************************************************************/
				// Почта - обязательное поле
				array('mail', 'required', 'on'=>array(self::SCENARIO_SIGNUP, self::SCENARIO_PASSRECOVERY)),
				//array('mail', 'required', 'on'=>self::SCENARIO_SIGNUP),
				// Почта проверяется на соответствие типу
				array('mail', 'email', 'on'=>array(self::SCENARIO_SIGNUP, self::SCENARIO_PASSRECOVERY)),
				// Почта должна быть в пределах от 6 до 50 символов
				array('mail', 'length', 'min'=>6, 'max'=>50, 'on'=>array(self::SCENARIO_SIGNUP, self::SCENARIO_PASSRECOVERY)),
				// Почта должна быть уникальной - для сценария регистрации пользователя
				array('mail', 'unique', 'on'=>self::SCENARIO_SIGNUP),
				// Почта должна существовать - для сценария восстановления пароля
				array('mail', 'exist', 'allowEmpty' => true, 'attributeName' => 'mail', 'className' => 'Account', 'message' => 'Введенный Вами адрес не найден', 'on'=>self::SCENARIO_PASSRECOVERY),
				// username должен существовать
				//array('username', 'exist', 'allowEmpty' => true, 'attributeName' => 'mail', 'className' => 'Account'),
				// Почта должна быть написана в нижнем регистре
				//	array('mail', 'filter', 'filter'=>'mb_strtolower'),
				
				
				/***************************************************************************/
				/*                                    Пароль                               */
				/***************************************************************************/
				// Пароль - обязательное поле
				array('password', 'required', 'on'=>array(self::SCENARIO_SIGNUP, self::SCENARIO_SELECTPASS)),
				// Длина пароля не менее 6 символов
				array('password', 'length', 'min'=>6, 'max'=>30, 'on'=>array(self::SCENARIO_SIGNUP, self::SCENARIO_SELECTPASS)),
				
				
				/***************************************************************************/
				/*                          Сценарий выбора логина                         */
				/***************************************************************************/
				// Логин обязателен для сценария выбора логина
				array('login', 'required', 'on'=>self::SCENARIO_SELECTLOGIN),
				// Логин должен быть уникальным для сценария выбора логина
				array('login', 'unique', 'on'=>self::SCENARIO_SELECTLOGIN),
				// Длина логина должна быть в пределах от 5 до 30 символов для сценария выбора логина
				array('login', 'length', 'min'=>5, 'max'=>30, 'on'=>self::SCENARIO_SELECTLOGIN),
				// Логин должен соответствовать шаблону
				array('login', 'match', 'pattern'=>'/^[A-z][\w]+$/', 'on'=>self::SCENARIO_SELECTLOGIN),
				
				
				/***************************************************************************/
				/*                       Сценарий обновления данных                        */
				/***************************************************************************/
				// Длина имени должна быть в пределах от 2 до 30 символов для сценария обновления данных
				array('first_name', 'length', 'min'=>2, 'max'=>30, 'on'=>self::SCENARIO_UPDATE),
				// Длина фамилии должна быть в пределах от 2 до 30 символов для сценария обновления данных
				array('last_name', 'length', 'min'=>2, 'max'=>30, 'on'=>self::SCENARIO_UPDATE),
				// Пол должен быть логическим значением для сценария обновления данных
				array('sex', 'boolean', 'on'=>self::SCENARIO_UPDATE),
				//array('sex', 'in', 'range'=>array(1,2),'on'=>self::SCENARIO_UPDATE),
				// Номер страны должен быть числовым значением для сценария обновления данных
				array('country_id', 'numerical', 'on'=>self::SCENARIO_UPDATE),
				// Номер региона должен быть числовым значением для сценария обновления данных
				array('region_id', 'numerical', 'on'=>self::SCENARIO_UPDATE),
				// Номер города должен быть числовым значением для сценария обновления данных
				array('city_id', 'numerical', 'on'=>self::SCENARIO_UPDATE),
				// Дата рождения должна быть датой для сценария обновления данных
				array('city_id', 'date', 'on'=>self::SCENARIO_UPDATE),
				// Длина номера телефона должна быть 15-16 символов ( +__(xxx)yyy-zzzz ) для сценария обновления данных
				array('phone', 'length', 'min'=>15, 'max'=>17, 'on'=>self::SCENARIO_UPDATE),
				// Длина поля "Обо мне" должна быть в пределах от 2 до 255 символов для сценария обновления данных
				array('first_name', 'length', 'min'=>2, 'max'=>255, 'on'=>self::SCENARIO_UPDATE),
				// Ссылка на аккаунт vk.com должна быть корректной ссылкой для сценария обновления данных
				array('vk_url', 'url', 'on'=>self::SCENARIO_UPDATE),
				// Ссылка на аккаунт twitter.com должна быть корректной ссылкой для сценария обновления данных
				array('tw_url', 'url', 'on'=>self::SCENARIO_UPDATE),
				
				// Ссылка на аватар должна быть корректной ссылкой для сценария обновления данных
				//array('avatar_url', 'url', 'on'=>self::SCENARIO_UPDATE),
				
				
				
				array('id, login, password, mail, avatar_url, first_name, last_name, 
					   sex, country_id, region_id, city_id, birth_date, phone, about, 
					   status_id, rating, balance, register_date, last_login, user_ip, 
					   activate_key, newpass_key, referral, badge, vk_url, tw_url, post_count, 
					   comment_count, friend_count, subscribe_count, all_vote_count, 
					   positive_vote_count, new_msg_count, new_friend_count', 'safe', 
					  'on'=>'search'),
				
				
		);
	}
	
/*	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, password, mail, status_id', 'required'),
			array('country_id, region_id, city_id, status_id, rating, balance, badge, post_count, comment_count, friend_count, subscribe_count, all_vote_count, positive_vote_count, new_msg_count, new_friend_count', 'numerical', 'integerOnly'=>true),
			array('login, mail', 'length', 'max'=>45),
			array('password, activate_key, newpass_key', 'length', 'max'=>32),
			array('avatar_url', 'length', 'max'=>120),
			array('first_name, last_name, phone, vk_url, tw_url', 'length', 'max'=>100),
			array('sex', 'length', 'max'=>1),
			array('about', 'length', 'max'=>500),
			array('birth_date, register_date, last_login, user_ip, referral', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, login, password, mail, avatar_url, first_name, last_name, sex, country_id, region_id, city_id, birth_date, phone, about, status_id, rating, balance, register_date, last_login, user_ip, activate_key, newpass_key, referral, badge, vk_url, tw_url, post_count, comment_count, friend_count, subscribe_count, all_vote_count, positive_vote_count, new_msg_count, new_friend_count', 'safe', 'on'=>'search'),
		);
	}
*/
		
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'commentRatings' => array(self::HAS_MANY, 'CommentRating', 'user_id'),
			'commentRatings1' => array(self::HAS_MANY, 'CommentRating', 'author_id'),
			'postRatings' => array(self::HAS_MANY, 'PostRating', 'user_id'),
			'postRatings1' => array(self::HAS_MANY, 'PostRating', 'author_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'author_id'),
			'status' => array(self::BELONGS_TO, 'UserStatus', 'status_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
			'badge0' => array(self::BELONGS_TO, 'Badge', 'badge'),
			'favourites' => array(self::HAS_MANY, 'Favourites', 'user_id'),
			'images' => array(self::HAS_MANY, 'Image', 'user_id'),
			'audios' => array(self::HAS_MANY, 'Audio', 'user_id'),
			'videos' => array(self::HAS_MANY, 'Video', 'user_id'),
			'coupons' => array(self::HAS_MANY, 'Coupon', 'user_id'),
			'files' => array(self::HAS_MANY, 'Files', 'user_id'),
			'folders' => array(self::HAS_MANY, 'Folder', 'user_id'),
			'friends' => array(self::HAS_MANY, 'Friend', 'source_id'),
			'friends1' => array(self::HAS_MANY, 'Friend', 'target_id'),
			'messages' => array(self::HAS_MANY, 'Message', 'sender_id'),
			'messages1' => array(self::HAS_MANY, 'Message', 'reciever_id'),
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
			'subscribes' => array(self::HAS_MANY, 'Subscribe', 'user_id'),
			'subscribes1' => array(self::HAS_MANY, 'Subscribe', 'author_id'),
			'channels' => array(self::HAS_MANY, 'Channel', 'user_id'),
			'albums' => array(self::HAS_MANY, 'Album', 'user_id'),
			'playlists' => array(self::HAS_MANY, 'Playlist', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Логин',
			'password' => 'Пароль',
			'mail' => 'e-mail',
			'avatar_url' => 'Avatar Url',
			
			'first_name' => 'Имя',//,'First Name',
			'last_name' => 'Фамилия',//,'Last Name',
			'sex' => 'Пол',//,'Sex',
			
			'country_id' => 'Country',
			'region_id' => 'Region',
			'city_id' => 'City',
				
			'birth_date' => 'Дата рождения',//'Birth Date',
			'phone' => 'Телефон',//Phone',
			'about' => 'Обо мне', //About',
			
			'status_id' => 'Status',
			
			'rating' => 'Рейтинг',//'Rating',
			'balance' => 'Balance',
			
			'register_date' => 'Дата регистрации',//'Register Date',
			'last_login' => 'Последний визит',//'Last Login',
			
			'user_ip' => 'User Ip',
			'activate_key' => 'Activate Key',
			'newpass_key' => 'Newpass Key',
			'referral' => 'Referral',
			'badge' => 'Badge',
			
			'vk_url' => 'ВКонтакте',//'Vk Url',
			'tw_url' => 'Twitter',//'Tw Url',
			
			'post_count' => 'Post Count',
			'comment_count' => 'Comment Count',
			'friend_count' => 'Friend Count',
			'subscribe_count' => 'Subscribe Count',
			'all_vote_count' => 'All Vote Count',
			'positive_vote_count' => 'Positive Vote Count',
			'new_msg_count' => 'New Msg Count',
			'new_friend_count' => 'New Friend Count',
		);
	}

	/**
	 * Список атрибутов которые могут быть массово присвоены
	 * в любом из наших сценариев
	 *
	 * @return unknown
	 */
	public function safeAttributes()
	{		
		return array('avatar_url', 'first_name', 'last_name', 'sex', 
				     'country_id', 'region_id', 'city_id', 'birth_date', 
				     'phone', 'about', 'vk_url', 'tw_url');
				    // 'on'=>self::SCENARIO_UPDATE);
			    
		return array('mail', 'password', 'on'=>self::SCENARIO_SIGNUP);
		return array('login', 'on'=>self::SCENARIO_SELECTLOGIN);
		return array('mail', 'on'=>self::SCENARIO_PASSRECOVERY);
		return array('password', 'on'=>self::SCENARIO_SELECTPASS);

	}
	
	// Метод, который будет вызываться до сохранения данных в БД
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				/*
				 // 1. Личная информация
				* @property string $avatar_url
				* @property string $first_name
				* @property string $last_name
				* @property string $sex
				* @property integer $country_id
				* @property integer $region_id
				* @property integer $city_id
				* @property string $birth_date
				* @property string $phone
				* @property string $about
				
				* @property string $vk_url
				* @property string $tw_url
				*/
				
				
				/*
				 // 2. Занулили
				* @property integer $rating
				* @property integer $balance
				
				* @property integer $post_count
				* @property integer $comment_count
				* @property integer $friend_count
				* @property integer $subscribe_count
				* @property integer $all_vote_count
				* @property integer $positive_vote_count
				* @property integer $new_msg_count
				* @property integer $new_friend_count
				*/
				

			/*		?????????????????		
			 * 
				* @property string $last_login
				* @property string $user_ip
				* @property string $activate_key
				* @property string $newpass_key
				* @property string $referral
				* @property integer $badge

			*/

				// Логин			
				$this->login = $this->setLogin($this->mail);				
			
				// Пароль - хэшируем
				$this->password = $this->hashPassword($this->password);
				
				// Время регистрации
				$this->register_date = date('Y-m-d H:i:s');

				// Статус - присваиваем статус пользователя - не активированный
				$this->status_id = UserStatus::model()->findByAttributes(array ('name' => Account::ROLE_NOTACTIVATED))->id;;
				
				// Активационный код
				$this->activate_key = md5(time().$this->mail);
				
				// Аватарка 
			}
	
			return true;
		}
	
		return false;
	}
	
	public function setLogin($email)
	{		
		$mass = split("@", $email);
		$i = 0; // Счетчик
		$newLogin = $mass[0]; 
		
		while (Account::model()->findByAttributes(array ('login' => $newLogin)))
		{
			$i++;
			$newLogin = $mass[0] . $i;  	
		}
		return $newLogin;
	}
	
	public function validatePassword($password)
	{
		return $this->hashPassword($password)===$this->password;
	}
	
	public function hashPassword($password)
	{
		return md5($password);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('avatar_url',$this->avatar_url,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('birth_date',$this->birth_date,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('balance',$this->balance);
		$criteria->compare('register_date',$this->register_date,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('user_ip',$this->user_ip,true);
		$criteria->compare('activate_key',$this->activate_key,true);
		$criteria->compare('newpass_key',$this->newpass_key,true);
		$criteria->compare('referral',$this->referral,true);
		$criteria->compare('badge',$this->badge);
		$criteria->compare('vk_url',$this->vk_url,true);
		$criteria->compare('tw_url',$this->tw_url,true);
		$criteria->compare('post_count',$this->post_count);
		$criteria->compare('comment_count',$this->comment_count);
		$criteria->compare('friend_count',$this->friend_count);
		$criteria->compare('subscribe_count',$this->subscribe_count);
		$criteria->compare('all_vote_count',$this->all_vote_count);
		$criteria->compare('positive_vote_count',$this->positive_vote_count);
		$criteria->compare('new_msg_count',$this->new_msg_count);
		$criteria->compare('new_friend_count',$this->new_friend_count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}