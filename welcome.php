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
	$fstnm= htmlspecialchars($_REQUEST["fn"], ENT_QUOTES);
	$lstnm= htmlspecialchars($_REQUEST["ln"], ENT_QUOTES);
	$standing=$_POST["year"];
	$phone= htmlspecialchars($_REQUEST["phn"], ENT_QUOTES);
	$desc= htmlspecialchars($_REQUEST["description"], ENT_QUOTES);
	if(mkdir("./userfolders/$onidid",0777,true)){
		echo("directory should be made");
	}
	
	$conn->query("insert into pinfo(uname,fname,lname,cstanding,phonenum)
	values('$onidid','$fstnm','$lstnm','$standing','$phone')");
	$conn->query("update pinfo
	set fname='$fstnm', lname='$lstnm', cstanding='$standing', phonenum='$phone'
	where uname='$onidid'");
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
		unlink($imagePath . "profilepic.png");
		unlink($imagePath . "profilepic.jpg");
		unlink($imagePath . "profilepic.gif");
		unlink($imagePath . "profilepic.jpeg");
		if(move_uploaded_file($imagetemp, $target_file)){
			echo("succesfully uploaded image");
			echo "<br>";
		} 
		
		$myfile=fopen("./userfolders/$onidid/description.txt","w");
		fwrite($myfile,$desc);
		fclose($myfile);
		
		$uploadOk = 0;
		
	include("connect.php");
	$onidid= $_SESSION["onidid"] ;
	$phil= $conn->query("SELECT * FROM pinfo WHERE uname='$onidid'");
	$result = mysqli_fetch_array($phil);
	if($result['fname'] && $result['lname'] && $result['cstanding']){
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
		<META http-equiv="refresh" content="3;URL=edit_profile.php">
	<?php } ?>

	</body>
</html>