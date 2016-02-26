<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>tüter</title>	

	<link rel="stylesheet" type="text/css" href="source/menu_topside.css" />
	<link rel="stylesheet" type="text/css" href="source/tb.css" />
	<link rel="stylesheet" type="text/css" href="source/buttons.css">
</head>

<body>

	<?php include("sesh.php");?>
		<?php 
			if (checkAuth(true) != "") {
		?>

		<?php 	
				include("connect.php");
				$onidid= $_SESSION["onidid"] ;
				$fn= $conn->query("SELECT * FROM pinfo WHERE uname='$onidid'");
				$result = mysqli_fetch_array($fn);

		?>

<?php include 'menu.php';?>
<?php 
	menu($result['fname'], $result['lname']);
?>
<button class="menu-button" id="open-button"></button>

<div class="content-wrap">
	<div class = "content">
	<div id="index-wrap">
		<section id = "profile-edit-header">
			<div class = "container">
				<h1>Welcome back <div class= "boxed--emph"><?php echo $result['fname']?></div></h1>
			</div>
		</section>
		<section id="page">
		<p>There are __ alerts awaiting your attention.</p>

			<p>
			Your current tutor rating is __.
			</p>

			<p>
			Currently you are tutoring __ students.
			</p>

			<p>
			There are __ students requesting your help.
			</p>

			<p>
			Your next appointment for "CLASS" with "TUTOR/STUDENT NAME" is in "D:M:H:S".</br>APPOINTMENT TIME & DATE
			</br>
			TUTOR/STUDENT PROFILE LINK
			</p>
		</section>

		</div>
	</div>
</div>
		<script src="source/menu_class.js"></script>
		<script src="source/main_menu.js"></script>
		<?php }else{echo("please log in again");}
		?>
		<?php mysqli_close($conn); ?>
</body>
</html>