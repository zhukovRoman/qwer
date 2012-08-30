<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Fresh-i.ru',
	'defaultController' => 'post', 
	// preloading 'log' component
	'preload'=>array('log', 
					 'bootstrap'
			),
		
            'sourceLanguage'=>'en_US',
            'language'=>'ru',
            'charset'=>'utf-8',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.xupload.models.XUploadForm',
		'ext.giix.giix-components.*', // giix components
		'ext.ActiveDateSelect',
//		'application.modules.rights.*',
//		'application.modules.rights.components.*',

		'ext.eoauth.*',
		'ext.eoauth.lib.*',
		'ext.lightopenid.*',
		'ext.eauth.*',
		'ext.eauth.services.*',
	),

	'aliases' => array(
	//assuming you extracted the files to the extensions folder
		'xupload' => 'ext.xupload'
	),
		
	'modules'=>array(
		// uncomment the following to enable the Gii tool	
/*		'rights'=>array(
				'debug'=>true,
				//'install'=>true,
				'enableBizRuleData'=>true,
				'userClass' => 'Account',
				'userNameColumn' => 'login',
				//'superuserName' => 'Francesco',
		),
*/
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
				'generatorPaths' => array(
						'ext.giix.giix-core', // giix generators
				),
			'password'=>'123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('192.168.10.31','::1'),
				
			'generatorPaths'=>array(
					'bootstrap.gii', // since 0.9.1
			),
		),
	
	),

	// application components
	'components'=>array(
		'clientScript' => array(
			'scriptMap' => array(
			'jquery.js' => '//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js',
			'jquery.yiiactiveform.js' => 'js/vendor/jquery.yiiactiveform.js',
			'jquery-ui.min.js' => 'js/vendor/jquery-ui.min.js',
			'jquery.ba-bbq.js' => 'js/vendor/jquery.ba-bbq.js',
			'jquery.yiigridview.js' => 'js/vendor/jquery.yiigridview.js',
			'jquery.yiilistview.js'=>'js/vendor/jquery.yiilistview.js ' 
			)
		),

		'loid' => array(
			//alias to dir, where you unpacked extension
			'class' => 'ext.lightopenid.loid',
		),
			
		'eauth' => array(
				'class' => 'ext.eauth.EAuth',
				'popup' => true, // Использовать всплывающее окно вместо перенаправления на сайт провайдера
				'services' => array( // Вы можете настроить список провайдеров и переопределить их классы
						'vkontakte' => array(
						// регистрация приложения: http://vkontakte.ru/editapp?act=create&site=1
								'class' => 'CustomVKontakteService', //'VKontakteOAuthService',
								'client_id' => '3076550',
								'client_secret' => 'EwViUPDBpI62c3nRXimQ',
								'title' => 'ВКонтакте',
						),
						'facebook' => array(
						// регистрация приложения: https://developers.facebook.com/apps/
								'class' => 'FacebookOAuthService',
								'client_id' => '228614950595389',
								'client_secret' => 'ed79bb2b6bf3a4368b763ef5bb267691',
						),
						'twitter' => array(
						// регистрация приложения: https://dev.twitter.com/apps/new
								'class' => 'CustomTwitterService',
								'key' => 'iWjqxxHmxdLmtjZyJDxsA',
								'secret' => '5W9cjIlBn2vnDD4J19q88XuysX36qBqxdKGemSbyU',
						),
						'odnoklassniki' => array(
						// регистрация приложения: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
								'class' => 'OdnoklassnikiOAuthService',
								'client_id' => '...',
								'client_public' => '...',
								'client_secret' => '...',
								'title' => 'Однокл.',
						),		
				/*		'google' => array(
								'class' => 'GoogleOpenIDService',
					),
						'yandex' => array(
								'class' => 'YandexOpenIDService',
						),

				/*		'google_oauth' => array(
						// регистрация приложения: https://code.google.com/apis/console/
								'class' => 'GoogleOAuthService',
								'client_id' => '...',
								'client_secret' => '...',
								'title' => 'Google (OAuth)',
						),
				/*		'yandex_oauth' => array(
						// регистрация приложения: https://oauth.yandex.ru/client/my
								'class' => 'YandexOAuthService',
								'client_id' => '...',
								'client_secret' => '...',
								'title' => 'Yandex (OAuth)',
						),*/
					/*	'linkedin' => array(
						// регистрация приложения: https://www.linkedin.com/secure/developer
								'class' => 'LinkedinOAuthService',
								'key' => '...',
								'secret' => '...',
						),
						'github' => array(
						// регистрация приложения: https://github.com/settings/applications
								'class' => 'GitHubOAuthService',
								'client_id' => '...',
								'client_secret' => '...',
						),
					/*	'live' => array(
						// регистрация приложения: https://manage.dev.live.com/Applications/Index
								'class' => 'LiveOAuthService',
								'client_id' => '...',
								'client_secret' => '...',
						),*/

					/*	'mailru' => array(
						// регистрация приложения: http://api.mail.ru/sites/my/add
								'class' => 'MailruOAuthService',
								'client_id' => '...',
								'client_secret' => '...',
						),
						'moikrug' => array(
						// регистрация приложения: https://oauth.yandex.ru/client/my
								'class' => 'MoikrugOAuthService',
								'client_id' => '...',
								'client_secret' => '...',
						),*/
				),
		),
			
			
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
		),
			
		'user'=>array(
			'class' => 'WebUser',
				
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			
			// Allows super users access implicitly.
		//	'class'=>'RWebUser', 
			
			'loginUrl'=>array('site/login'),
		),
			
/*		'authManager'=>array( 
			'class'=>'RDbAuthManager', // Provides support authorization item sorting.
			'defaultRoles' => array('Guest') // дефолтная роль
		),
*/
			
		'authManager' => array(
		// Будем использовать свой менеджер авторизации
				'class' => 'PhpAuthManager',
				// Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
				'defaultRoles' => array('guest'),
		),
			
		'ih'=>array(
			'class'=>'CImageHandler',
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'pgsql:host=localhost;port=5432;dbname=klimgo_dev',
			'emulatePrepare' => true,
			'username' => 'klimgo_dev_database',
			'password' => '45^RdA$%Ws',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CWebLogRoute',
                                        //'levels'=>'trace, info, profile',
                                        'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);