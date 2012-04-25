<?php

require_once 'includes/db.php';
require_once 'includes/users.php';

$email = 'bradlet@algonquincollege.com';
$password = 'password';

user_create($db, $email, $password);

?>