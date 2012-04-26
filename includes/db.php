
<?php
/* 
         *small description: This is the database page.
         *It is in place to link up the sql with the dataset. 
         * 
		 *@package 
		 *@copyright 2012 Amanda Marochko
		 *@author Amanda Marochko <amanda.marochko@gmail.com>
		 *@link http://github.com/amandamarochko/open-data-app
		 *@license New BSD Licence 
		 *@version 1.0.0
*/
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$dsn = stripslashes(getenv('DB_DSN'));

$db = new PDO($dsn, $user, $pass);
$db->exec('SET NAMES utf8');

?>