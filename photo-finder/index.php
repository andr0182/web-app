<?php 
//PDO is php data object
//add an if statement for each catagory and load all images from that catagory
//filter sanitize string

require_once 'includes/db.php';
session_start();

$cat = filter_input(INPUT_GET, 'cat', FILTER_SANITIZE_NUMBER_INT);//Get the variable $id from the query string. This is not what this does beacause we changed the cond? 

if( filter_input(INPUT_GET, 'cat', FILTER_SANITIZE_NUMBER_INT) !== NULL ) {
 
	$_SESSION['cat'] = $cat;
}

$sql = $db->prepare('
	SELECT id, name, parent
	FROM categories
	WHERE parent=:parent
	ORDER BY name ASC
');

$sql->bindValue(':parent',$_SESSION['cat'], PDO::PARAM_INT);  //PARAM standsds for parameter.  PDO is PHP data object and how we connect to the database.  This info is datatyping the $cat variable as an integer
$sql->execute();	//We bind ie. fill in the placeholder with a value
//var_dump($sql->errorInfo());
$child_categories = $sql->fetchAll();	
//var_dump($child_categories);
//if (isset($_POST['num1'])) {
//	$num1 = $_POST['num1'];
//}

$image_cat = filter_input(INPUT_GET, 'image_cat', FILTER_SANITIZE_NUMBER_INT);

$sql = $db->prepare('
	SELECT photograph_id
	FROM photographs_categories
	WHERE category_id=:category_id
');

$sql->bindValue(':category_id',$image_cat, PDO::PARAM_INT);
$sql->execute();
//var_dump($sql->errorInfo());
$image_ids = $sql->fetchAll();

		for($i = 0; $i < sizeof($image_ids); $i++) {
		
			$sql = $db->prepare('
				SELECT title, description, link
				FROM photographs
				WHERE id = :photograph_id
			');
			
			$sql->bindValue(':photograph_id' ,$image_ids[$i][0], PDO::PARAM_INT);
			$sql->execute();
			$cat_images[$i] = $sql->fetch();
		}
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
	
	<h1>PhotoFinder</h1>
	<!--<div id="title"><h2>Your guide to photographic opportunity</h2></div>-->
	
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
				</ul>
			</div>
		</nav>
</header>

<div id="categories">
	<nav2>
		<div>
			<ul id="category-nav">
			<?php foreach ($child_categories as $child):?>
			
				<li><a href="index.php?image_cat=<?php echo $child['id'];?>"><?php echo $child["name"]?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
	</nav2>
</div>
	
<?php if(isset($cat_images)) :?> 
<?php foreach ($cat_images as $entry):?>
		
<div id="image-pane">
	<img id="photo" src="<?php echo $entry["link"];?>" alt="">
	
	<dl id="image_data">
		<dt id"entry_title"></dt>
		<dd><?php echo $entry["title"];?></dd>
		
		<dt>Description:</dt>
		<dd><?php echo $entry["description"];?></dd>
	</dl>
</div>
<br>

<?php endforeach;?>
<?php endif;?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="js/photoFinder.js"></script>
</body>
</html>
