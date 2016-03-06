<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>tüter</title>	
	<link rel="stylesheet" type="text/css" href="source/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="source/sidebar.css">
	<link rel="stylesheet" type="text/css" href="source/tb.css" />
	<link rel="stylesheet" type="text/css" href="source/buttons.css">
</head>

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

<body class="desktop">
	<div id="wrapper">
		<?php include 'menu.php';?>
		<?php 
		menu($result['fname'], $result['lname']);
		?>
		<div id="page-content-wrapper">
	    	<div class="container-fluid">
				<div id="index-wrap">
					<div class="col-md-12">
						<section id = "profile-edit-header">
							<div class = "container">
								<h1>
								<img src="images/profile_default.gif" height = "130" width="130" class="img-circle">
								<div class= "boxed--emph">     <?php echo $_GET['user']?>'s</div> profile</h1>
							</div>
						</section>
					</div>
						<form action="welcome.php" method="post" enctype="multipart/form-data">
							<div class=".col-xs-6 .col-md-4">
								<div class = "panel panel-default">
									<div class = "panel-body">
										
									</div>
								</div>
							</div>	
				</div>
	    	</div>
	   	</div>
	</div>
			<script src="source/menu_class.js"></script>
			<script src="source/main_menu.js"></script>
		<?php }
		mysqli_close($conn); ?>
</body>
</html>
