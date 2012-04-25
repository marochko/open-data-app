<?php

require_once '../includes/db.php';

$results = $db->query('
	SELECT id, name, address, longitude, latitude
	FROM locations
	ORDER BY address ASC
');

?>
<?php

require_once '../includes/users.php';

if (!user_signed_in()) {
header('Location: sign-in.php');
exit;
}

require_once '../includes/db.php';

$results = $db->query('
SELECT id, name, address, longitude, latitude, rate_count, rate_total
FROM locations
ORDER BY name ASC
');

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
</head>
<body>
	<header>	
		<h1><img src="../images/title.png" height="150" width="300"></h1>
		<nav>
			<h2>Navigation</h2>
			<ul>
				<li><a href="../index.php"><img src="../images/home.png" height="60" width="300"></a></li>
				<li><a href="admin/index.php"><img src="../images/admin.png" height="60" width="300"></a></li>
				<li><a href="http://imm.edumedia.ca/maro0030/open-data-app"><a href="http://imm.edumedia.ca/maro0030/mtm1526/open-data-app"><img src="../images/brief.png" height="60" width="300"></a>
			</ul>
		</nav>
	</header>
	
	<article>
		<h2>Add a New Data Entry</h2>
		<p>Add a new location (data entry) to your database.</p>
		<ul>
			<li><a href="add.php">Add a data entry</a></p></li>
		</ul>
		
		<h2>Edit/Delete Data Entries</h2>
		<p>Manage your app's data entries using the management system below.</p>
		
		<ul>
			<?php foreach ($results as $results) : ?>
				<li><a href="../single.php?id=<?php echo $results['id']; ?>"><?php echo $results['name']; ?></a></li>
				&middot; <a href="edit.php?id=<?php echo $results['id']; ?>">Edit</a>
				&middot; <a href="delete.php?id=<?php echo $results['id']; ?>">Delete</a>
			<?php endforeach; ?>
		</ul>
        <a href="sign-out.php">Sign Out</a>

<ol class="location">
<?php foreach ($results as $results) : ?>
<li><?php echo $results['name']; ?></li>
<?php endforeach; ?>
</ol>
	</article>
	
</body>
</html>