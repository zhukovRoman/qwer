<?php
/**
 * An example of extending the provider class.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://code.google.com/p/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
 
require_once dirname(dirname(__FILE__)).'/services/TwitterOAuthService.php';

class CustomTwitterService extends TwitterOAuthService {	
	
	protected function fetchAttributes() {
		$info = $this->makeSignedRequest('https://api.twitter.com/1/account/verify_credentials.json', array('size' => 'original'));
	
		$this->attributes['id'] = $info->id;
		$this->attributes['name'] = $info->name;
		$this->attributes['url'] = //'http://twitter.com/account/redirect_by_id?id='.$info->id_str;
									 'http://twitter.com/'.$info->screen_name;
		
		// Получаем фамилию и имя
		$this->attributes['first_name'] = $info->name;
		//$name = explode(' ', $info->name);
		//$this->attributes['first_name'] = $name[0];
		//$this->attributes['last_name'] = $name[1];
		
		$this->attributes['username'] = $info->screen_name;
		$this->attributes['language'] = $info->lang;
		$this->attributes['timezone'] = timezone_name_from_abbr('', $info->utc_offset, date('I'));
		
		// Получаем аватар и юзерпик
		$this->attributes['picture'] = "http://api.twitter.com/1/users/profile_image/{$info->screen_name}.json?size=original";
		$this->attributes['userpic'] = $info->profile_image_url;
	}
}