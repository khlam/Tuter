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
	//have some alerts and things like "Are you sure that you want to do this" before they say they aren't a tutor anymore and whatnot
	include("sesh.php");
		if (checkAuth(true) != "") {
			include("connect.php");
			$onidid= $_SESSION["onidid"] ;
			$tuterID= $_POST["tutor"];
			$userInfo= $conn->query("SELECT * FROM pinfo WHERE uname='$onidid'");
			$result = mysqli_fetch_array($userInfo);
			$tuterInfo= $conn->query("SELECT * FROM tuters WHERE uname='$tuterID'");
			$tuterresult = mysqli_fetch_array($tuterInfo);
			
			//Assuming they haven't rated before
			$numraters = $tuterresult["numraters"];
			$rate = $tuterresult["rating"];
			$rating = $_POST["rate"];
			if ($numraters == 0)
			{
				//just set that rate
				if (!$conn->query("UPDATE tuters SET rating='$rating', numraters='1' WHERE uname='$tuterID'"))
				{
					printf("There was an error updating that tutor's info.");
				}
				else
				{
					
					$myfile = fopen("userfolders/$onidid/ratings.csv", "a") or die("Could not open file!");
					$array = array
					(
					"$tuterID,$rating"
						);
					if(!fputcsv($myfile,explode(',',$array[0])))
						echo "The CSV write failed.";//might want to validate this somewhere
				
					fclose($myfile);
				}
			}
			else
			{
				
				if (!$myfile = fopen("userfolders/$onidid/ratings.csv", "x+"))
				{
					$myfile = fopen("userfolders/$onidid/ratings.csv", "r+") or die("Could not open file!");
				}
				$alreadyExisted = 0;
				$newCSV = array();		
				//checks to see if the user has already rated the tutor or not, resolves correctly	
				while (!feof($myfile))
				{
					$currentRow = fgetcsv($myfile);
					if($currentRow[0] == $tuterID)//if the user has already rated this user, then they already have them inside the file
					{
						$alreadyExisted = 1;
						$oldrating = $currentRow[1];
						
						array_push($newCSV, "$tuterID,$rating");
						//we are now altering the average
						$newRate = (($rate*$numraters)+$rating-$oldrating)/$numraters;
						if (!$conn->query("UPDATE tuters SET rating='$newRate', numraters='$numraters' WHERE uname='$tuterID'"))
						{
							printf("There was an error updating that tutor's info.");
						}
					
					}
					else
						array_push($newCSV, "$currentRow[0],$currentRow[1]");
				}
				if (!$alreadyExisted)
				{
					//if the user hadn't already rated them
					$array = array
					(
					"$tuterID,$rating"
						);
					if(!fputcsv($myfile,explode(',',$array[0])))
						echo "The CSV write failed.";//might want to validate this somewhere
					else
					{
						$newnum = $numraters+1;
						$newRate = (($rate*$numraters)+$rating)/$newnum;
						if (!$conn->query("UPDATE tuters SET rating='$newRate', numraters='$newnum' WHERE uname='$tuterID'"))
						{
							printf("There was an error updating that tutor's info.");
						}
					}
				}
				else
				{
					//if the usaer HAD already rated them.
					//now rewrite the new file
					fclose($myfile);
					$myfile = fopen("userfolders/$onidid/ratings.csv", "w");
					$temp = array_pop($newCSV);
					foreach ($newCSV as $line) {
						if(!fputcsv($myfile, explode(',', $line)))
							echo "There was an error writing to the CSV file.";
					}
				}
				fclose($myfile);
			}
			
	?>
<META http-equiv="refresh" content="0; URL=profile.php?user=<?php echo $tuterID?>">

<?php }else{ ?>
		<META http-equiv="refresh" content="0; URL=profile.php?user= <?php echo $tuterID?>">
<?php } ?>
</body>
</html>
