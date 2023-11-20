<?php 

	// Stores the file name 
	$name = $_FILES["file"]["name"]; 

	// Store the file extension or type 
	$type = $_FILES["file"]["type"]; 

	// Store the file size 
	$size = $_FILES["file"]["size"]; 

	echo "File actual name is $name"."<br>"; 
	echo "File has .$type extension" . "<br>"; 
	echo "File has $size of size"."<br>"; 

?>
