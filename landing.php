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
			<script src="source/menu_class.js"></script>
			<script src="source/main_menu.js"></script>
			<script src="source/bootstrap.js"></script>
		<?php mysqli_close($conn); 
		}else{ ?>
		<META http-equiv="refresh" content="0;URL=profile.php">
		<?php } ?>
</body>
</html>
