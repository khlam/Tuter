<?php include("sesh.php");
?>
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
	
	?>
onid-id: <?php echo $onidid; ?> <br>
Welcome <?php echo $_POST["fn"]; ?><br>
Your Last name is: <?php echo $_POST["ln"]; ?><br>
Your Birthdate: <?php echo $_POST["birthday"]; ?><br>
<?php
if(empty($_POST['stb'])){
	echo("You did not select Student or Tutor");
}
else{
	echo "You are a ";
	$phil=0;
   foreach($_POST['stb'] as $check) {
            if($phil){
				echo(" and a ");
			}
			echo $check;
			$phil++;
	 }
}
?>
<br>Year: <?php echo $_POST["year"]; ?><br>
	<?php } ?>

	</body>
</html>