/**
		 *small description: links with the kml file in order to retrieve data from the dataset.
		 *
		 *@package 
		 *@copyright 2012 Amanda Marochko
		 *@author Amanda Marochko <amanda.marochko@gmail.com>
		 *@link http://github.com/amandamarochko/open-data-app
		 *@license New BSD Licence 
		 *@version 1.0.0
*/

<?php

require_once '../includes/db.php';

$places_xml = simplexml_load_file('dataset.kml');

$sql = $db->prepare('
	INSERT INTO locations (name, longitude, latitude)
	VALUES (:name, :longitude, :latitude)
');

foreach ($places_xml->Document->Folder[0]->Placemark as $place) {
	$coords = explode(',', trim($place->Point->coordinates));
	$sql->bindValue(':name', $place->name, PDO::PARAM_STR);
	$sql->bindValue(':longitude', $coords[0], PDO::PARAM_STR);
	$sql->bindValue(':latitude', $coords[1], PDO::PARAM_STR);
	$sql->execute();
}

//var_dump($sql->errorInfo());


?>