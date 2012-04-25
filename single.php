<?php

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
	header('Location: index.php');
	exit;
}

require_once 'includes/db.php';
require_once 'includes/functions.php';

$sql = $db->prepare('
	SELECT id, name, address, longitude, latitude, rate_count, rate_total
	FROM locations
	WHERE id = :id
');

$sql->bindValue(':id', $id, PDO::PARAM_INT);

$sql->execute();

$results = $sql->fetch();

if (empty($results)) {
	header('Location: index.php');
	exit;
}
$title = $results['name'];

if ($results['rate_count'] > 0) {
	$rating = round($results['rate_total'] / $results['rate_count']);
} else {
	$rating = 0;
}

$cookie = get_rate_cookie();


?>

<!DOCTYPE HTML>
<html lang=en-ca>
<head>
	<meta charset=utf-8>
	<title><?php echo $results['name']; ?> &middot; Ottawa's ODR App</title>
	<link href="css/public.css" rel="stylesheet">
	<script src="js/modernizr.js"></script>
</head>
<body>

	<header>	
		<h1><img src="images/title.png" height="150" width="300"></h1>
		<nav>
			<h2>Navigation</h2>
			<ul>
				<li><a href="index.php"><img src="images/home.png" height="60" width="300"></a></li>
				<li><a href="admin/index.php"><img src="images/admin.png" height="60" width="300"></a></li>
				<li><a href="http://imm.edumedia.ca/maro0030/open-data-app"><img src="images/brief.png" height="60" width="300"></a>
			</ul>
		</nav>
	</header>
	
	<article>
		<h1><?php echo $results['name']; ?></h1>
		 <ul>
         	<li>Average Rating <meter value="<?php echo $rating; ?>" min="0" max="5"><?php echo $rating; ?> out of 5</meter></li>
			<li><b>Street Address:</b> <?php echo $results['address']; ?></p></li>
			<li><b>Longitude:</b> <?php echo $results['longitude']; ?></p></li>
			<li><b>Latitude:</b> <?php echo $results['latitude']; ?></p></li>
		</ul>
        <?php if (isset($cookie[$id])) : ?>

<h2>Your rating</h2>
<ol class="rater rater-usable">
	<?php for ($i = 1; $i <= 5; $i++) : ?>
		<?php $class = ($i <= $cookie[$id]) ? 'is-rated' : ''; ?>
		<li class="rater-level <?php echo $class; ?>">★</li>
	<?php endfor; ?>
</ol>

<?php else : ?>

<h2>Rate</h2>
<ol class="rater rater-usable">
	<?php for ($i = 1; $i <= 5; $i++) : ?>
	<li class="rater-level"><a href="rate.php?id=<?php echo $results['id']; ?>&rate=<?php echo $i; ?>">★</a></li>
	<?php endfor; ?>
</ol>

<?php endif; ?>
	 </article>
	 
    <div class="back"> <a href="index.php">Back</a> </div>
	
</body>
</html>