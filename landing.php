<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>tüter</title>	
	<link rel="stylesheet" type="text/css" href="source/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="source/sidebar.css">
	<link rel="stylesheet" type="text/css" href="source/tb.css" />
	<link rel="stylesheet" type="text/css" href="source/buttons.css">

	 
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>



<?php include("sesh.php");?>
	<?php 
		if (checkAuth(true) != "") {
	?>

	<?php 	
			include("connect.php");
			$user= $_SESSION["onidid"] ;
			$fn= $conn->query("SELECT * FROM pinfo WHERE uname='$user'");
			$result_user = mysqli_fetch_array($fn);

	?>

<body class="desktop">
	<div id="wrapper">
		<?php include 'menu.php';?>
		<?php 
		menu($result_user['fname'], $result_user['lname']);
		?>
				<div id="index-wrap">
						<section id = "landing-header">
							<div class = "container-fluid">
								Welcome back <div class= "boxed--emph"> <?php echo $result_user['fname'] ?></div>
							</div>
						</section>					
				</div>

				<div class=".col-xs-6 .col-md-4">
					<h1>
					First time here?
					</h1>
					<p>
					If this is your first time here, you should edit your profile. You can do this by clocking edit profile on the menu to the left.
					After setting up your profile, you can view other tuters' profiles and message them freely.
					</p>
					<h1>
					How can we help you?
					</h1>
					<p>
					If you are a student, you can freely browse a list of tutors and message ones you would like to study with. If you are a tutor, you can upload your
					information so that students can find and message you.
					</p>
				</div>
		<script src="source/menu_class.js"></script>
		<script src="source/main_menu.js"></script>
		<script src="source/bootstrap.js"></script>
		<?php mysqli_close($conn); 
		}else{ ?>
		<META http-equiv="refresh" content="0;URL=profile.php">
		<?php } ?>
	</div>
</body>
</html>
