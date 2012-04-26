
<?php
/**
		 *small description: sign out function
		 *
		 *@package 
		 *@copyright 2012 Amanda Marochko
		 *@author Amanda Marochko <amanda.marochko@gmail.com>
		 *@link http://github.com/amandamarochko/open-data-app
		 *@license New BSD Licence 
		 *@version 1.0.0
*/

require_once '../includes/users.php';

user_sign_out();

header('Location: index.php');
?>