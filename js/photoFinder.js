// JavaScript Document
$(document).ready(function(){ 
	$('.location').on('click', function(){ //'.location' is getting the <li> with the class location in the html, (this is the same way we target the li in css).  .on is... that reads "on click execute this function...
		$('article').load('location.html') 	// $('article') get the <article> (div) in the html, (this is the same way we target the article in css).  '.load' loads the contents of location.html to the article.
	});
	
	$('.subject').on('click', function(){		//.on and .load are jQuery functions?
		$('article').load('subject.html')
	});
	
	$('.galleries').on('click', function(){
		$('article').load('galleries.html')
	});
	
	$('.top-rated').on('click', function(){
		$('article').load('top-rated.html')
	});
	
});