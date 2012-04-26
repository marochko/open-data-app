
<?php
/* 
         *small description: This is the functions page.
         * The primary functions targeted are the geolocation function and the rating function
         * 
		 *@package 
		 *@copyright 2012 Amanda Marochko
		 *@author Amanda Marochko <amanda.marochko@gmail.com>
		 *@link http://github.com/amandamarochko/open-data-app
		 *@license New BSD Licence 
		 *@version 1.0.0
*/
function save_rate_cookie ($id, $rate) {
$cookie = get_rate_cookie();

$rated = array();

foreach ($cookie as $key=>$value) {
$rated[] = $key . ':' . $value;
}

$rated[] = $id . ':' . $rate;
$cookie_content = implode(';', $rated);

// http://php.net/setcookie
// setcookie($name, $content, $expiry_time, $path);
// Cookie expirations are in seconds
setcookie('locations_rated', $cookie_content, time() + 60 * 60 * 24 * 365, '/');
}

/**
* Gets the cookie and splits it apart into its component pieces
*
* Takes:
* id:rate;id:rate;id:rate
* And translates to:
* array(
* id => rate
* , id => rate
* , id => rate
* )
*/
function get_rate_cookie () {
$cookie_content = filter_input(INPUT_COOKIE, 'locations_rated', FILTER_SANITIZE_STRING);

if (empty($cookie_content)) {
return array();
}

$rated = explode(';', $cookie_content);

$ratings = array();

foreach ($rated as $item) {
$pieces = explode(':', $item);
$ratings[$pieces[0]] = $pieces[1];
}

return $ratings;
}
?>