<?php return array(
/***************************************************************************/
/*                      	 1. Описание операций                          */
/***************************************************************************/
		
		// 1.1. Просмотр профиля пользователя
		'viewAccount' => array(
				'type' => CAuthItem::TYPE_OPERATION,
				'description' => 'Просмотр профиля пользователя',
				'bizRule' => null,
				'data' => null
		),
		
		// 1.2. Изменение данных профиля
		'updateAccount' => array(
				'type' => CAuthItem::TYPE_OPERATION,
				'description' => 'Изменение данных профиля',
				'bizRule' => null,
				'data' => null
		),
		
		// 1.3. Просмотр всех пользователей
		'indexAccount' => array(
				'type' => CAuthItem::TYPE_OPERATION,
				'description' => 'Просмотр всех пользователей',
				'bizRule' => null,
				'data' => null
		),

		// 1.4. Создание пользователя
		'createAccount' => array(
				'type' => CAuthItem::TYPE_OPERATION,
				'description' => 'Создание пользователя',
				'bizRule' => null,
				'data' => null
		),
		
		// 1.5. Удаление пользователя
		'deleteAccount' => array(
				'type' => CAuthItem::TYPE_OPERATION,
				'description' => 'Удаление пользователя',
				'bizRule' => null,
				'data' => null
		),
		
		// 1.6. Администрирование пользователей
		'adminAccount' => array(
				'type' => CAuthItem::TYPE_OPERATION,
				'description' => 'Администрирование пользователей',
				'bizRule' => null,
				'data' => null
		),
		
		// 1.7. Подтверждение логина
		'selectLoginAccount' => array(
				'type' => CAuthItem::TYPE_OPERATION,
				'description' => 'Подтверждение логина',
				'bizRule' => null,
				'data' => null
		),
		
		// 1.8. Подтверждение пароля
		'selectPassAccount' => array(
				'type' => CAuthItem::TYPE_OPERATION,
				'description' => 'Подтверждение пароля',
				'bizRule' => null,
				'data' => null
		),
/***************************************************************************/
/*                      	   2. Описание задач                           */
/***************************************************************************/
		// 2.1. Изменение данных своего профиля
		'updateOwnAccount' => array(
				'type' => CAuthItem::TYPE_TASK,
				'description' => 'Изменение данных своего профиля',
				'children' => array(
						'updateAccount',
				),
				'bizRule' => 'return Yii::app()->user->id==$params["Account"]->id;',
				'data' => null
		),
		
		// 2.2. Изменение логина своего аккаунта
		'selectOwnLogin' => array(
				'type' => CAuthItem::TYPE_TASK,
				'description' => 'Изменение логина своего аккаунта',
				'children' => array(
						'selectLoginAccount',
				),
				'bizRule' => 'return Yii::app()->user->id==$params["Account"]->id;',
				'data' => null
		),
/***************************************************************************/
/*                      	   3. Описание ролей                           */
/***************************************************************************/		
		'guest' => array(
				'type' => CAuthItem::TYPE_ROLE,
				'description' => 'Guest',
				'bizRule' => null,
				'data' => null
		),
		
		'not_activated' => array(
				'type' => CAuthItem::TYPE_ROLE,
				'description' => 'Not Activated',
				'children' => array(
						'guest', // унаследуемся от гостя
		
						//'viewAccount',
						//'updateOwnAccount',
						'selectOwnLogin',
				),
				'bizRule' => null,
				'data' => null
		),
		
		'user' => array(
				'type' => CAuthItem::TYPE_ROLE,
				'description' => 'User',
				'children' => array(
						'guest', // унаследуемся от гостя
						
						'viewAccount',
						'updateOwnAccount',
				),
				'bizRule' => null,
				'data' => null
		),
		
		'moderator' => array(
				'type' => CAuthItem::TYPE_ROLE,
				'description' => 'Moderator',
				'children' => array(
						'user',          // позволим модератору всё, что позволено пользователю
						
						'indexAccount',
					//	'createAccount',
				),
				'bizRule' => null,
				'data' => null
		),
		
		'administrator' => array(
				'type' => CAuthItem::TYPE_ROLE,
				'description' => 'Administrator',
				'children' => array(
						'moderator',         // позволим админу всё, что позволено модератору
						
						'adminAccount',
					//	'delete',
				),
				'bizRule' => null,
				'data' => null
		),
); ?>
