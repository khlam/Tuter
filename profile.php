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

	<?php
	 $user = $_GET['user'];
	 $phil= $conn->query("SELECT * FROM pinfo WHERE uname='$user'");
	 $result = mysqli_fetch_array($phil);
	 $temp = $conn->query("SELECT * FROM tuters WHERE uname='$user'");
	 $rating = mysqli_fetch_array($temp);
	?>

<body class="desktop">
	<div id="wrapper">
		<?php include 'menu.php';?>
		<?php 
		menu($result_user['fname'], $result_user['lname']);
		?>
				<div id="index-wrap">
						<section id = <?php if($result['acctyp'] == 2){echo '"profile-tutor"';}else{echo'"profile-student"';}?>>
							<div class = "container-fluid">
								<p>
								<?php
								if ($rating['numraters'] > '0')
								{
									echo 'Rated ';
									echo round($rating['rating'],2)."/10 </br> By ";
									echo $rating['numraters'];
									if ( $rating['numraters'] == 1)
									{
										echo " student";
									}else
									{
										echo " students";
									}
								}
								else
								{
									echo '  ';
								}
								?>
								
								</p>
								<?php if ($result['fname'] != "")
								{   ?>
								<?php
								$temp = imageCheck($user);
								if($temp != "false"){
								?>
								<img src="userfolders/<?php echo $user;?>/profilepic<?php echo $temp;?>" height = "300" width = "300" class="img-circle"/>  </a>
								<?php }else{ ?>
								<img src="images/profile_default.gif" height = "300" width = "300" class="img-circle"/>  </a>
								<?php
								}?>
								<div class= "boxed--emph"> <?php echo $result['fname'] ?></div>
								
								<?php 
									if($result['acctyp'] == 2){		
										echo 'tutor';
									}else
									{
										echo'student';
								}?>
	
								</h1>
							</div>
						</section>
					</div>

					<div class = "row">
						<?php 
						if($result['acctyp'] == 2){
						?>
						<div class="col-md-8">
							<div class = "container-fluid">
								<div class = "panel panel-default">
									<div class = "panel-body">
									<form action="handlerate.php" method="POST" >
										Rate <?php echo $result['fname'] ?>'s performance. (1=Poor, 10 = Great!)
										<input type="number" name="rate" id="rate" max="10" min="1"></input>
										<input type="hidden" name="tutor" id="tutor" value="<?php echo "$user"; ?>"></input>
										<input type="submit"></input>
									</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class = "row">
						<div class="col-md-4">
							<div class = "container-fluid">
								<section id = "page">
									<h2><a href="#"><button class="button button--ujarak button--size-s button--border-medium button--text-thick" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Contact Me</button></a>
									</h2>
								</section>
							</div>
						</div>
						<?php }?>
					</div>
					<div class ="row">
						<div class="collapse" id="collapseExample">
							<div class="well">
							Code for cool feature goes here
							</div>
						</div>
					</div>

					<div class=".col-xs-6 .col-md-4">
						<div class = "panel panel-default">
							<div class = "panel-body">
									<?php 
									if(file_exists("userfolders/$user/description.txt")){
									$myfile = fopen("./userfolders/$user/description.txt","r"); 
									$text = fgets($myfile);
									}
									else{
									$text = "This user has not created a bio to display.";
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
							<section id = "profile-user">
								<div class = "container">
									<h1>
									 No such user <div class= "boxed--emph"><?php echo $_GET['user'] ?></div> found</h1>
								</div>
							</section>
						</div>
					<?php } ?>					
				</div>
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
