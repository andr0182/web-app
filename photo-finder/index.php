<?php 
//PDO is php data object
//add an if statement for each catagory and load all images from that catagory
//filter sanitize string

require_once 'includes/db.php';

$cat = filter_input(INPUT_GET, 'cat', FILTER_SANITIZE_NUMBER_INT); //Get the variable $id from the query string. This is not what this does beacause we changed the cond? 

$sql = $db->prepare('
	SELECT id, name, parent
	FROM categories
	WHERE parent=:parent
	ORDER BY name ASC
');

$sql->bindValue(':parent',$cat, PDO::PARAM_INT);  //PARAM standsds for parameter.  PDO is PHP data object and how we connect to the database.  This info is datatyping the $cat variable as an integer
$sql->execute();	//We bind ie. fill in the placeholder with a value
var_dump($sql->errorInfo());
$child_categories = $sql->fetchAll();	
//var_dump($child_categories);
//if (isset($_POST['num1'])) {
//	$num1 = $_POST['num1'];
//}

$image_cat = filter_input(INPUT_GET, 'image_cat', FILTER_SANITIZE_NUMBER_INT);


$sql = $db->prepare('
	SELECT photograph_id, category_id
	FROM photographs_categories
	WHERE category_id=:category_id
');


$sql->bindValue(':category_id',$image_cat, PDO::PARAM_INT);
$sql->execute();
var_dump($sql->errorInfo());
$image_ids = $sql->fetchAll();


$entries = filter_input(INPUT_GET, 'entries', FILTER_SANITIZE_NUMBER_INT);

$sql = $db->query('
	SELECT id, title, description, link
	FROM photographs
	ORDER BY title ASC
');

$images = $sql->fetchAll();

?>


<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>PhotoFinderApp</title>
	<link href="css/photoFinder.css" rel="stylesheet">
	<script src="js/modernizr-2.0.6.js"></script>
</head>

<body>

<header>
	
	<h1>PhotoFinder:</h1>
	<div id="title"><h2>Your guide to photographic opportunity</h2></div>
	
	<div id="slider">
	<img class="slider_image" src="images/image-1.jpg" alt=""/>
	<img class="slider_image" src="images/image-2.jpg" alt=""/>
	<img class="slider_image" src="images/image-3.jpg" alt=""/>
	<img class="slider_image" src="images/image-4.jpg" alt=""/>
	<img class="slider_image" src="images/image-5.jpg" alt=""/>
	</div>
		<nav>
			<div id="navbar">
				<ul class="main-nav">
					<li class="location"><a href="index.php?cat=1">Search By Location</a></li>	<!--This should GET and display category id 1 as a nav-->
					<li class="subject"><a href="index.php?cat=2">Search By Subject</a></li>	<!--This should GET and display category id 2 as a nav-->
					<!--<li class="galleries"><a href="#">Galleries</a></li>-->
					<!--<li class="top-rated"><a href="#">Top Rated</a></li>-->
					
					<!--<li class="location"><a href="index.php?image_cat=8">Search By Location</a></li>-->
				</ul>
			</div>
		</nav>
</header>

<div id="categories">
	<nav2>
		<div>
			<ul id="category-nav">
			<?php foreach ($child_categories as $child):?>
			
				<li><a href="index.php?image_cat=3"><?php echo $child["name"]?></a></li>	<!--I want to set this up to echo the links for each category of location or subject category?-->
				<?php endforeach;?>
			</ul>	<!--For the various catagories I want to change the query string to cat=x where x is the category id, or is there another way to do this using if statements like we did with asignment 6?-->
		</div>
	</nav2>
</div>

<?php foreach ($image_ids as $collection):?>
<?php echo $collection["photograph_id"]?>
<? endforeach;?>


	
	<?php foreach ($images as $entry):?> 	<!--Can I use $entry instead of $child?-->
	
<div id="image-pane">
	<img id="photo" src="<?php echo $entry["link"]?>" alt="">
	
	<dl id="image_data">
		<dt id"entry_title"></dt>
		<dd><?php echo $entry["title"]?></dd>
		
		<dt>Description:</dt>
		<dd><?php echo $entry["description"]?></dd>
	</dl>
</div>
	<?php endforeach;?>


<!--<article id="location">  This should be id=category?
		<nav2>
			<div>
				<ul class="location-nav">
					<li><a href="#">Downtown Ottawa</a></li>	I want to set this up to echo the links for each category of location or subject category?
					<li><a href="#">Rideau Canal</a></li>
					<li><a href="#">Experimental Farm</a></li>
					<li><a href="#">Mer Bleue Bog</a></li>
					<li><a href="#">Stony Swamp</a></li>
					<li><a href="#">Gatineau Park</a></li>
				</ul>
			</div>
		</nav2>
</article>-->

<!--<article class="subject">
		<nav>
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
		</nav>
</article>-->

<!--<article>This will contain a div that encloses the photos, and descriptions.</article>-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="js/photoFinder.js"></script>
</body>
</html>
