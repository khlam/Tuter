<?php
	
	$servername = "oniddb.cws.oregonstate.edu";
	$username = "sprousem-db";
	$password = "5VQxWlk9SsEPMqP0";
	$dbname = "sprousem-db";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	//checking connection
	if(!$conn){
		die("Failed to connect: " . $conn->connect_error);
	}
?>