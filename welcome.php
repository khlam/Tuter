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
	$fstnm=$_POST["fn"];
	$lstnm=$_POST["ln"];
	$standing=$_POST["year"];
	$phone=$_POST["phn"];
	$conn->query("insert into pinfo(uname,fname,lname,cstanding,phonenum)
	values('$onidid','$fstnm','$lstnm','$standing','$phone')");
	$conn->query("update pinfo
	set fname='$fstnm', lname='$lstnm', cstanding='$standing', phonenum='$phone'
	where uname='$onidid'");
	mysqli_close($conn);
	
	include("connect.php");
	$onidid= $_SESSION["onidid"] ;
	$phil= $conn->query("SELECT * FROM pinfo WHERE uname='$onidid'");
	$result = mysqli_fetch_array($phil);
	if($result['fname'] && $result['lname'] && $result['cstanding']){
		echo $result['fname'];
		echo (", your info was succesfully uploaded to our Database!");
		echo ("<br>Redirecting you home now...");
		?>
		<META http-equiv="refresh" content="2;URL=http://web.engr.oregonstate.edu/~wingarlo/tuter.php">
	<?php }
		else{
			echo ("There was an error updating your info. Please resubmit your form.");
		}	
	mysqli_close($conn);
	?>
	<?php } ?>

	</body>
</html>