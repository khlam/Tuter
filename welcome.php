<?php include("sesh.php");?>
<html>
<link rel="stylesheet" type="text/css" href="style.css" />
<body>
	<?php 	if (checkAuth(true) != "") { ?>
	<link rel="stylesheet" href="source/tb.css">
	<?php include 'menu.php';?>
	<?php
	include("connect.php");
	
	$onidid= $_POST["phil"];
	echo ("<br>");
	$fstnm= htmlspecialchars($_POST["fn"], ENT_QUOTES);
	$lstnm= htmlspecialchars($_POST["ln"], ENT_QUOTES);
	$standing=$_POST["year"];
	$email=htmlspecialchars($_POST["email"], ENT_QUOTES);
	$carrier=$_POST["carrier"];
	if(is_numeric($_POST['phn'])){
		
		$phone= htmlspecialchars($_REQUEST["phn"], ENT_QUOTES);
	}
	else{
		echo '<script> alert("Enter valid phone number or leave blank!");</script>';
		
	}
	$desc= htmlspecialchars($_POST["description"], ENT_QUOTES);
	$acc = $_POST["type"];
	if(mkdir("./userfolders/$onidid",0777,true)){
		echo("directory should be made");
	}
	echo "Here is what is in request: <br>";
	$temp = serialize($_POST);
	echo "$temp <br>";
	if (!$conn->query("insert into pinfo(uname,fname,lname,cstanding,phonenum,acctyp,email,carrier)
	values('$onidid','$fstnm','$lstnm','$standing','$phone','$acc', '$email', '$carrier')"))
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
			set fname='$fstnm', lname='$lstnm', cstanding='$standing', phonenum='$phone', acctyp='$acc', email='$email', carrier='$carrier'
			where uname='$onidid'");

	}
	//if the person is a tutor, enter them into the tuter list
	if ($acc == 2)
	{
		echo "inside the else if <br>";
		$conn->query("insert into tuters(uname) values('$onidid')");
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
		if($imagename){
			if ($_FILES["pic"]["size"] <= 500000) {
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
		}
		$myfile=fopen("./userfolders/$onidid/description.txt","w");
		fwrite($myfile,$desc);
		fclose($myfile);
		$uploadOk = 0;
		
	include("connect.php");
	$userInfo= $conn->query("SELECT * FROM pinfo WHERE uname='$onidid'");
	$result = $userInfo->fetch_assoc();
	echo '<br>';
	echo $result['fname'];
	echo '<br>';
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
	<?php } else{ ?>
		<META http-equiv="refresh" content="0;URL=welcome.php">
		<?php } ?>

	</body>
</html>
