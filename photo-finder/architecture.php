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


<div id="architecture">

<h1>Architecture</h1>

<?php foreach ($results as $phfinder) : ?>	<!--//foreach is a php construct that iterates over an array.  Returns each item from movies database.-->
	
	<!--How do I identify this entry as architecture in the database?
	Or better yet, how do I structure the database?-->
	<h2>
	<a href="single.php?id=<?php echo $phfinder['id']; ?>">
	<?php echo $phfinder['title']; ?>
	</a>
	</h2>
	<image src="<?php echo $phfinder['image_link']; ?>" alt=""/>
	<dl>
		<dt>Dsecription: </dt>
		<dd><?php echo $phfinder['description']; ?></dd>
		
	</dl>
	<?php endforeach; ?>
</div>
