<?php
require_once 'includes/db.php';
//Add location heading here somewhere
$sql = $db->query('
	SELECT id, title, description, image_link
	FROM phfinder
	ORDER BY title ASC
');

$results = $sql->fetchAll();
?>

<!--<article id="location">-->
		<nav2>
			<div>
				<ul class="location-nav">
					<li><a href="#">Downtown Ottawa</a></li>
					<li><a href="#">Rideau Canal</a></li>
					<li><a href="#">Experimental Farm</a></li>
					<li><a href="#">Mer Bleue Bog</a></li>
					<li><a href="#">Stony Swamp</a></li>
					<li><a href="#">Gatineau Park</a></li>
				</ul>
			</div>
		</nav2>
<!--</article>-->
