<?php
/**
 * An example of extending the provider class.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://code.google.com/p/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
 
require_once dirname(dirname(__FILE__)).'/services/VKontakteOAuthService.php';

class CustomVKontakteService extends VKontakteOAuthService {	
	
	// protected $scope = 'friends';
	
	protected function fetchAttributes() {
		$info = (array)$this->makeSignedRequest('https://api.vkontakte.ru/method/getProfiles', array(
			'query' => array(
				'uids' => $this->uid,
				//'fields' => '', // uid, first_name and last_name is always available
				'fields' => 'nickname, screen_name, sex, bdate, city, country, timezone, photo, photo_medium, photo_big, photo_rec',
			),
		));

		$info = $info['response'][0];

		$this->attributes['id'] = $info->uid;
		$this->attributes['name'] = $info->first_name.' '.$info->last_name;
		if (!empty($info->screen_name)) $this->attributes['url'] = 'http://vk.com/'.$info->screen_name;
			else $this->attributes['url'] = 'http://vk.com/id'.$info->uid;
		$this->attributes['first_name'] = $info->first_name;
		$this->attributes['last_name'] = $info->last_name;
		
		if (!empty($info->screen_name))
			$this->attributes['username'] = $info->screen_name;
		//else
			//$this->attributes['username'] = 'id'.$info->uid;
		//	$this->attributes['username'] = $this->attributes['name'];
		
		if (isset($info->bdate)) $this->attributes['birth_date'] = date('Y-m-d', strtotime($info->bdate));
			
		if (isset($info->sex)) $this->attributes['gender'] = $info->sex == 1 ? 0 : 1;
		
		if (isset($info->city)) $this->attributes['city'] = $info->city;
		if (isset($info->country)) $this->attributes['country'] = $info->country;
		
		//$this->attributes['timezone'] = timezone_name_from_abbr('', $info->timezone*3600, date('I'));;
		
		//$this->attributes['photo'] = $info->photo;
		//$this->attributes['photo_medium'] = $info->photo_medium;
		if (isset($info->photo_big)) $this->attributes['photo_big'] = $info->photo_big;
		if (isset($info->photo_rec)) $this->attributes['photo_rec'] = $info->photo_rec;
	}
}
