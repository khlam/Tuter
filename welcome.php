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
	//echo("Connected to the DB. Updating info...");
	echo ("<br>");
	$fstnm= htmlspecialchars($_REQUEST["fn"], ENT_QUOTES);
	$lstnm= htmlspecialchars($_REQUEST["ln"], ENT_QUOTES);
	$standing=$_POST["year"];
	$phone= htmlspecialchars($_REQUEST["phn"], ENT_QUOTES);
	$conn->query("insert into pinfo(uname,fname,lname,cstanding,phonenum)
	values('$onidid','$fstnm','$lstnm','$standing','$phone')");
	$conn->query("update pinfo
	set fname='$fstnm', lname='$lstnm', cstanding='$standing', phonenum='$phone'
	where uname='$onidid'");
	mysqli_close($conn);
	/*
	$image = $_POST['pic'];
    //Stores the filename as it was on the client computer.
    $imagename = $_FILES['pic']['name'];
    //Stores the filetype e.g image/jpeg
    $imagetype = $_FILES['pic']['type'];
    //Stores any error codes from the upload.
    $imageerror = $_FILES['pic']['error'];
    //Stores the tempname as it is given by the host when uploaded.
    $imagetemp = $_FILES['pic']['tmp_name'];

    //The path you wish to upload the image to
    $imagePath = 'profpics/';
	
    if(is_uploaded_file($_FILES['pic']['tmp_name'])) {
        if(move_uploaded_file($imagetemp, $imagePath . $imagename)) {
            echo "Sussecfully uploaded your image.";
        }
        else {
            echo "Failed to move your image.";
        }
    }
    else {
        echo "Failed to upload your image.";
    }
	*/
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
	
		<META http-equiv="refresh" content="2;URL=test_login.php">
	<?php } ?>

	</body>
</html>