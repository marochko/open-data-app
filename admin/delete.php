/**
		 *small description: allows you to delete the dataset
		 *
		 *@package 
		 *@copyright 2012 Amanda Marochko
		 *@author Amanda Marochko <amanda.marochko@gmail.com>
		 *@link http://github.com/amandamarochko/open-data-app
		 *@license New BSD Licence 
		 *@version 1.0.0
*/

<?php

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
	header('Location: index.php');
	exit;
}

require_once '../includes/db.php';

$sql = $db->prepare('
	DELETE FROM locations
	WHERE id = :id
	LIMIT 1
');

$sql->bindValue(':id', $id, PDO::PARAM_INT);

$sql->execute();

header('Location: index.php');
exit;