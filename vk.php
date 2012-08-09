<!doctype html>
<meta charset=utf-8 />

<?php
/**
 * Работа с API Вконтакте, на примере получения профиля пользователся
 * by Ilya Shalyapin, www.coderiver.ru
 */
 
  
/**
 * Поддержка OAuth 2.0 платформой ВКонтакте:
 * http://habrahabr.ru/blogs/social_networks/117211/?utm_source=twitterfeed&utm_medium=twitter
 * 
 * Диалог авторизации OAuth
 * http://vkontakte.ru/developers.php?o=-1&p=%C0%E2%F2%EE%F0%E8%E7%E0%F6%E8%FF%20%F1%E0%E9%F2%EE%E2
 * http://vkontakte.ru/developers.php?o=-1&p=%C4%E8%E0%EB%EE%E3%20%E0%E2%F2%EE%F0%E8%E7%E0%F6%E8%E8%20OAuth
 * 
 * Описание метода getProfiles:
 * http://vkontakte.ru/developers.php?o=-1&p=getProfiles
 * 
 * Выполнение запросов к API:
 * http://vkontakte.ru/developers.php?o=-1&p=%C2%FB%EF%EE%EB%ED%E5%ED%E8%E5%20%E7%E0%EF%F0%EE%F1%EE%E2%20%EA%20API
 * 
 * Open API:
 * http://vkontakte.ru/pages.php?o=-1&p=Open+API
 * 
 * Добавление приложения ВКонтакте
 * http://vkontakte.ru/apps.php?act=add
 */ 



/**
 * $APP_ID - идентификатор вашего приложения ВКонтакте
 * $SECRET - секретный код приложения
 * $REDIRECT_URI - урл к данному файлу, домен должен быть прописан в настроках приложения ВКонтакте
 */  

$APP_ID = '3067979';  
$SECRET = 'AspgZxsCuVow7ewTkljp';
$REDIRECT_URI = 'http://zhukov.klimgo.com/cube/www/vk.php';
?>


<script>
function vkauth(){
    /** Перенаправляем на страницу авторизации ВКонтакте */
    //http://oauth.vk.com/authorize?client_id=3067979&scope=friends&redirect_uri=http://zhukov.klimgo.com/cube/www/vk.php&response_type=code
    //location.href = 'http://api.vk.com/oauth/authorize?client_id=<?php echo $APP_ID;?>&redirect_uri=<?php echo $REDIRECT_URI;?>&display=page';
    location.href = 'http://oauth.vk.com/authorize?client_id=3067979&scope=friends&redirect_uri=http://zhukov.klimgo.com/cube/www/vk.php&response_type=code';
}
</script>
<a href="#" onclick="vkauth();" >Вход через ВКонтакте</a>

<?php

if ($code = $_GET['code']){
    /** Получаем access_token для работы с API */
    //http://api.vk.com/api.php?
    //  v=3.0&
    //  api_id=1901988
    //  &method=getProfiles
    //  &format=json&rnd=343
    //  &uids=100172
    //  &fields=photo%2Csex
    //  &sid=10180116c4fd93480439bca47d636d6dd75fac30b851d4312e82ec3523
    //  &sig=5be698cf7fa09d30f58b941a4aea0e9b
   
    $acc_tock = file_get_contents('https://oauth.vk.com/access_token?client_id='.$APP_ID."&client_secret=".$SECRET."&code=".$code); 
    $data3 = json_decode($acc_tock);
    //print_r ($acc_tock);
    $uid = $data3->user_id;
    //echo $uid;
    $sig = md5("api_id=".$APP_ID."format=jsonmethod=getProfilesuids=".$uid."v=3.0".$SECRET);

    /** Получаем профиль пользователя */
    $resp2 = file_get_contents(
            'http://api.vk.com/api.php?v=3.0&api_id='.$APP_ID.'&method=getProfiles&format=json&uids='.$uid.'&sig='.$sig); 
    //echo $resp2;
    $data2 = json_decode($resp2);
    $name = $data2->response[0]->first_name.' '.$data2->response[0]->last_name;
   echo $name;    
}