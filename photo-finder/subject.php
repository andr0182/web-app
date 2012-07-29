<?php
require_once 'includes/db.php';
// Add subject heading in database somewhere and then here.
$sql = $db->query('
	SELECT id, title, description, image_link
	FROM phfinder
	ORDER BY title ASC
');

$results = $sql->fetchAll();
?>

<article class="subject">
		<nav2>
			<div>
				<ul class="subject-nav">
					<li><a href="#">Architecture</a></li>
					<li><a href="#">Landmarks</a></li>
					<li><a href="#">Landscape</a></li>
					<li><a href="#">Animals</a></li>
					<li><a href="#">Birds</a></li>
					<li><a href="#">Flowers</a></li>
					<li><a href="#">Waterfalls</a></li>
				</ul>
			</div>
		</nav2>
</article>
