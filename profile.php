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
			$user= $_SESSION["onidid"] ;
			$fn= $conn->query("SELECT * FROM pinfo WHERE uname='$user'");
			$result_user = mysqli_fetch_array($fn);

	?>

	<?php
	 $user = $_GET['user'];
	 $phil= $conn->query("SELECT * FROM pinfo WHERE uname='$user'");
	 $result = mysqli_fetch_array($phil);
	?>

<body class="desktop">
	<div id="wrapper">
		<?php include 'menu.php';?>
		<?php 
		menu($result_user['fname'], $result_user['lname']);
		?>
		<div id="page-content-wrapper">
	    	<div class="container-fluid">
				<div id="index-wrap">
				<?php if ($result['fname'] != "")
						{   ?>
						<div class="col-md-12">
							<section id = "profile-edit-header">
								<div class = "container">
									<h1>
									<?php
									$temp = imageCheck($user);
									if($temp != "false"){
									?>
									<img src="userfolders/<?php echo $user;?>/profilepic<?php echo $temp;?>" height = "150" width = "150" class="img-circle"/>  </a>
									<?php }else{ ?>
									<img src="images/profile_default.gif" height = "150" width = "150" class="img-circle"/>  </a>
									<?php
									}?>
									<div class= "boxed--emph"> <?php echo $result['fname'] ?>'s</div> profile</h1>
								</div>
							</section>
						</div>

					<div class=".col-xs-4 .col-md-2">
						<div class = "panel panel-default">
							<div class = "panel-body">
							<section id = "profile-edit-header">
								<h1>I'm a 
								<?php 
									if($result['acctyp'] == 2){		
										echo 'tutor </h1>';
									}else
									{
										echo'student</h1>';
									}
								?>
								
							</section>
							</div>
						</div>
					</div>

					<?php 
					if($result['acctyp'] == 2){
					?>
					<div class=".col-xs-4 .col-md-2">
						<div class = "panel panel-default">
							<div class = "panel-body">
							<section id = "page">
										<?php
										echo '<p>Would you like my help? Send me a <a href="#"><button class="button button--ujarak button--size-s button--border-medium button--text-thick">message</button></a></p>';?>
							</section>
							</div>
						</div>
					</div>
					<?php }?>
					<div class=".col-xs-6 .col-md-4">
						<div class = "panel panel-default">
							<div class = "panel-body">
									<?php 
									if(file_exists("userfolders/$user/description.txt")){
									$myfile = fopen("./userfolders/$user/description.txt","r"); 
									$text = fgets($myfile);
									}
									else{
									$text = "";
									}
									?>
									<?php echo $text; ?>
									<?php fclose($myfile); ?>
							</div>
						</div>
					</div>	
					<?php
					}else{
						?>
						<div class="col-md-12">
							<section id = "profile-edit-header">
								<div class = "container">
									<h1>
									 No such user <div class= "boxed--emph"><?php echo $_GET['user'] ?></div> found</h1>
								</div>
							</section>
						</div>
					<?php } ?>					
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
