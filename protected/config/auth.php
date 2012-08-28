<?php return array(
/***************************************************************************/
/*                      	 1. Описание операций                      */
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
                // 2 ПОСТЫ
                //2.1 создание нового материла
                'createNewPost' => array(
                            'type' => CAuthItem::TYPE_OPERATION,
                            'description' => 'создание нового материла',
                            'bizRule' => null,
                            'data' => null
		),
    
                //2.2 модерация материалов
                'moderatePost' => array(
                            'type' => CAuthItem::TYPE_OPERATION,
                            'description' => 'модерация материалов',
                            'bizRule' => null,
                            'data' => null
		),
                'PostActions' => array(
                            'type' => CAuthItem::TYPE_OPERATION,
                            'description' => 'добавление в избранное и рейтинг',
                            'bizRule' => null,
                            'data' => null
		),
    
                //3. комментарии
                // 3.1 добавление комментария
                'addComment' => array(
                            'type' => CAuthItem::TYPE_OPERATION,
                            'description' => 'добавление комментария',
                            'bizRule' => null,
                            'data' => null
		),
                'commentVote' => array(
                            'type' => CAuthItem::TYPE_OPERATION,
                            'description' => 'голосование за комментарии и спам.',
                            'bizRule' => null,
                            'data' => null
		),
                'commentModeration' => array(
                            'type' => CAuthItem::TYPE_OPERATION,
                            'description' => 'Модерация комментов',
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
    
                'manageOwnPost' => array(
                                    'type' => CAuthItem::TYPE_TASK,
                                    'description' => 'управление своими постами',
                                    'children' => null,
                                    'bizRule' => 'return Yii::app()->user->id==$params["Post"]->author_id;',
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
                                                'createNewPost',
                                                'manageOwnPost',
                                                'PostActions',
                                                'addComment',
                                                'commentVote',
                                                
				),
				'bizRule' => null,
				'data' => null
		),
		
		'moderator' => array(
				'type' => CAuthItem::TYPE_ROLE,
				'description' => 'Moderator',
				'children' => array(
						'user',          // позволим модератору всё, что позволено пользователю
						'moderatePost',
						'indexAccount',
                                                'commentModeration',
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
