<?php include("sesh.php");?>
<html>
<link rel="stylesheet" type="text/css" href="style.css" />
<body>
	<?php 	if (checkAuth(true) != "") { ?>
	<link rel="stylesheet" href="source/tb.css">
	<?php include 'menu.php';?>
	<?php
	include("connect.php");
	
	$onidid= $_SESSION["onidid"] ;
	echo ("<br>");
	$fstnm= htmlspecialchars($_POST["fn"], ENT_QUOTES);
	$lstnm= htmlspecialchars($_POST["ln"], ENT_QUOTES);
	$standing=$_POST["year"];
	$phone= htmlspecialchars($_POST["phn"], ENT_QUOTES);
	$desc= htmlspecialchars($_POST["description"], ENT_QUOTES);
	$acc = $_POST["type"];
	if(mkdir("./userfolders/$onidid",0777,true)){
		echo("directory should be made");
	}
	echo "Here is what is in request: <br>";
	$temp = serialize($_POST);
	echo "$temp <br>";
	if (!$conn->query("insert into pinfo(uname,fname,lname,cstanding,phonenum,acctyp)
	values('$onidid','$fstnm','$lstnm','$standing','$phone','$acc')"))
	{
			echo 'test1 <BR>';
			echo $fstnm;
			echo "<BR>";
			echo $lstnm;
			echo "<BR>";
			echo $standing;
			echo "<BR>";
			echo $phone;
			echo "<BR>";
			$conn->query("update pinfo
			set fname='$fstnm', lname='$lstnm', cstanding='$standing', phonenum='$phone', acctyp='$acc'
			where uname='$onidid'");
	}
	
	mysqli_close($conn);
	
	$uploadOk = 1;
		//Stores the filename as it was on the client computer.
		$imagename = $_FILES["pic"]["name"];
		//Stores the filetype
		$imagetype = $_FILES["pic"]["type"];
		//Stores the tempname as it is given by the host when uploaded.
		$imagetemp = $_FILES["pic"]["tmp_name"];
		//The path you wish to upload the image to
		$imagePath = "userfolders/$onidid/";
		$target_file = $imagePath . "profilepic." . basename("$imagetype");
		if ($_FILES["fileToUpload"]["size"] <= 500000) {
			unlink($imagePath . "profilepic.png");
			unlink($imagePath . "profilepic.jpg");
			unlink($imagePath . "profilepic.gif");
			unlink($imagePath . "profilepic.jpeg");
			if(move_uploaded_file($imagetemp, $target_file)){
				chmod ($target_file, 0644);
				echo("succesfully uploaded image");
				echo "<br>";
			}
		}
		else{
			echo "Sorry, your file is too large.";
		}
		
		$myfile=fopen("./userfolders/$onidid/description.txt","w");
		fwrite($myfile,$desc);
		fclose($myfile);
		
		$uploadOk = 0;
		
	include("connect.php");
	$onidid= $_SESSION["onidid"] ;
	$phil= $conn->query("SELECT * FROM pinfo WHERE uname='$onidid'");
	$result = mysqli_fetch_array($phil);
	if($result['fname'] != "" && $result['lname'] != "" && $result['cstanding'] != ""){
		echo $result['fname'];
		echo (", your info was succesfully uploaded to our Database!");
		echo ("<br>Redirecting you now...");
		?>
	<?php }
		else{
			echo ("There was an error updating your info. Please resubmit your form.");
		}	
		
	mysqli_close($conn);
	?>
		<META http-equiv="refresh" content="10;URL=edit_profile.php">
	<?php } ?>

	</body>
</html>