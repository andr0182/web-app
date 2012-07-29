<?php
//PDO is php data object
require_once 'includes/db.php';

$sql = $db->query('
	SELECT id, title, description, image_link
	FROM phfinder
	ORDER BY title ASC
');

$results = $sql->fetchAll();
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>Location Content</title>
	<link href=>
</head>

<body>
<!--I don't thnk I need an index.php file because I am loading info into the index page with php in the subjec , location and gallery php files?-->

</body>
</html>
