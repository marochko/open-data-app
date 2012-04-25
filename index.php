<?php

require_once 'includes/db.php';

$results = $db->query('
	SELECT id, name, address, longitude, latitude, rate, ratetotal
	FROM locations
	ORDER BY address DESC
');

?><!DOCTYPE HTML>
<html lang=en-ca>
<head>
	<meta charset=utf-8>
	<title>Ottawa's ODR App</title>
	<link href="css/public.css" rel="stylesheet">
	<script src="js/modernizr.dev.js"></script>
</head>
<body>
	<header>	
		<h1>Ottawa's ODR App</h1>
		<nav>
			<h2>Navigation</h2>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="admin/index.php">Administration</a></li>
				<li><a href="http://imm.edumedia.ca/maro0030/open-data-app">Project Brief</a>
			</ul>
		</nav>
	</header>
	<article>
	
		<h2>Locations</h2>

<button id="geo">Find Me</button>
<form id="geo-form">
    <label for="adr">Address</label>
    <input id="adr">
</form>

<ol class="locations">
<?php foreach ($results as $odr) : ?>

	<?php
		if ($odr['rate'] > 0) {
			$rating = round($odr['ratetotal'] / $odr['rate']);
		} else {
			$rating = 0;
		}
	?>

	<li itemscope itemtype="http://schema.org/TouristAttraction" data-id="<?php echo $odr['id']; ?>">
		<strong class="distance"></strong>
		<a href="single.php?id=<?php echo $odr['id']; ?>" itemprop="name"><?php echo $odr['name']; ?></a>
		<span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
			<meta itemprop="latitude" content="<?php echo $odr['latitude']; ?>">
			<meta itemprop="longitude" content="<?php echo $odr['longitude']; ?>">
		</span>
		<meter value="<?php echo $rating; ?>" min="0" max="5"><?php echo $rating; ?> out of 5</meter>
		<ol class="rater">
		<?php for ($i = 1; $i <= 5; $i++) : ?>
			<?php $class = ($i <= $rating) ? 'is-rated' : ''; ?>
			<li class="rater-level <?php echo $class; ?>">★</li>
		<?php endfor; ?>
		</ol>
	</li>
<?php endforeach; ?>
</ol>

		<div id="map"></div>
		
	</article>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCOSF6EUJHi28FLeCSkKsQsG1gtn4vRkN4&sensor=false"></script>
<script src="js/latlng.min.js"></script>
<script src="js/odr.js"></script>
</body>
</html>
