<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>tüter</title>	

	<link rel="stylesheet" type="text/css" href="source/menu_topside.css" />
	<link rel="stylesheet" type="text/css" href="source/tb.css" />
	<link rel="stylesheet" type="text/css" href="source/buttons.css">
	<link rel="stylesheet" type="text/css" href="source/bootstrap.css">
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

	<?php include 'menu.php';?>
	<?php 
		menu($result['fname'], $result['lname']);
	?>
	<button class="menu-button" id="open-button"></button>

	<div class="content-wrap">
		<div class = "content">
			<div id="index-wrap">
				<div class="col-md-12">
					<section id = "profile-edit-header">
						<div class = "container">
							<h1>
							<img src="images/profile_default.gif" height = "130" width="130" class="img-circle">
							<div class= "boxed--emph">     <?php echo $result['fname']?>'s</div> profile</h1>
						</div>
					</section>
				</div>
				
				<form action="welcome.php" method="post">
					<div class="col-md-4 ">
						<div class = "panel panel-default">
							<div class = "panel-body">
								<p>
							    	First Name* : <input type="text" name="fn" value=<?php echo $result['fname']?>>
									</br	>Last Name* : <input type="text" name="ln" value=<?php echo $result['lname']?>>
									</br></br>
								</p>
								<p>
									Upload Profile Picture  </p> 
    								<input type="file" id="exampleInputFile">
								
							</div>
						</div>
					</div>

					<div class="col-md-4 ">
						<div class = "panel panel-default">
							<div class = "panel-body">
							<p>
								I am a
								<input type="radio" name="year" value="1" <?php if($result['cstanding']==1){echo 'checked';}?>>Freshman 
								<input type="radio" name="year" value="2" <?php if($result['cstanding']==2){echo 'checked';}?>>Sophomore 
								<input type="radio" name="year" value="3" <?php if($result['cstanding']==3){echo 'checked';}?>>Junior 
								<input type="radio" name="year" value="4" <?php if($result['cstanding']==4){echo 'checked';}?>>Senior 
								<input type="radio" name="year" value="5" <?php if($result['cstanding']==5){echo 'checked';}?>>Grad student 
								<input type="radio" name="year" value="6" <?php if($result['cstanding']==6){echo 'checked';}?>>Other
							</p>

							<p>
								I am a
								<div class="checkbox">
									<label>
										<input type="checkbox" name="stb[]" value="student">Student

										<input type="checkbox" name="stb[]" value="tutor">Tutor
									</label>
								</div>
							</p>
							</div>
						</div>
					</div>	  

					<div class="col-md-4 ">
						<div class = "panel panel-default">
							<div class = "panel-body">
								<p>
								Send notifications to my cell phone 
								<input type="text" class="form-control" name="phn" value=<?php echo $result['phonenum']?> placeholder="### #### ###">
								<!-- <input type="tel" maxlength="10"  name="phn" value=<?php echo $result['phonenum']?>><br><br>-->
								</p>
							</div>
						</div>
					</div>	  
					
					<div class="col-md-10">
						<p>
						Profile Description
							<textarea class="form-control" rows="10"> </textarea>
						</p>
					</div>		

					<div class="col-md-8">
						<button type="submit" name="update" class="button button--ujarak button--size-m button--border-medium button--text-thick">submit</button>
					</div>						
				</form>

				<div class = "col-md-8">
					<p>Your first name, academic year, and profile picture are publicly viewable.
					</br></br>
					Phone numbers and last names are confidential and will only be used to send alerts and notifications.
					</br></br>
					We will not share or sell your private information to third parties.
					</p>
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