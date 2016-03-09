<!DOCTYPE html>
<html>
<head>
	<title>Sending your information.</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="source/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="source/sidebar.css">
	<link rel="stylesheet" type="text/css" href="source/tb.css" />
	<link rel="stylesheet" type="text/css" href="source/buttons.css">
</head>
<body class="desktop">
	<?php 	
	//check to see if you manually go to welcome.php you can alter things
			include("connect.php");
			$onidid= $_SESSION["onidid"] ;
			$tuterID= $_POST["tutor"];
			$userInfo= $conn->query("SELECT * FROM pinfo WHERE uname='$onidid'");
			$result = mysqli_fetch_array($userInfo);
			$tuterInfo= $conn->query("SELECT * FROM tuters WHERE uname='$tuterID'");
			$tuterresult = mysqli_fetch_array($tuterInfo);
			/*
			* Here goes the code for determining if the user has already rated this user
			* This user should only be a tutor
			* Make sure we correctly handle if they have rated
			*/


			//Assuming they haven't rated before
			$numraters = $tuterresult["numraters"];
			$rate = $tuterresult["rating"];
			$rating = $_POST["rate"];
			if ($numraters == 0)
			{
				//just send that rate
				if (!$conn->query("UPDATE tuters SET rating='$rating', numraters='1' WHERE uname='$tuterID'"))
				{
					printf("Welp that didn't work.");
				}
			}
			else
			{
				$newnum = $numraters+1;
				$newRate = (($rate*$numraters)+$rating)/$newnum;
				echo "The new rate should be $newRate";
				if (!$conn->query("UPDATE tuters SET rating='$newRate', numraters='$newnum' WHERE uname='$tuterID'"))
				{
					printf("Welp that didn't work.");
				}
			}
			
	?>

<?php


echo "You gave user: ".$_POST["tutor"]." a ".$_POST["rate"]."!";

?>
</body>
</html>