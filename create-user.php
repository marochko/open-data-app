/* 
         *small description: This is the create-user page.
         *
         *This page distinguishes who can access the admin pages of the application. 
         *Links to the database.
		 *@package 
		 *@copyright 2012 Amanda Marochko
		 *@author Amanda Marochko <amanda.marochko@gmail.com>
		 *@link http://github.com/amandamarochko/open-data-app
		 *@license New BSD Licence 
		 *@version 1.0.0
*/
*/ 
<?php

require_once 'includes/db.php';
require_once 'includes/users.php';

$email = 'bradlet@algonquincollege.com';
$password = 'password';

user_create($db, $email, $password);

?>