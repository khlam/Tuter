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
					<h1><div class= "boxed--emph"><?php echo $result['fname']?>'s</div> profile</h1>
				</div>
			</section>
			<section id="page-profile">
				   <form action="welcome.php" method="post">
					<p>
				    	First Name* : <input type="text" name="fn" value=<?php echo $result['fname']?>>
						   Last Name* : <input type="text" name="ln" value=<?php echo $result['lname']?>>
						</br></br>
					</p>

					<p>
						I am a  <input type="checkbox" name="stb[]" value="student">Student  <input type="checkbox" name="stb[]" value="tutor">Tutor
						</br></br>
					</p>
					
					<p>
						This year I am a </br>
						<input type="radio" name="year" value="1" <?php if($result['cstanding']==1){echo 'checked';}?>>Freshman 
						<input type="radio" name="year" value="2" <?php if($result['cstanding']==2){echo 'checked';}?>>Sophomore 
						<input type="radio" name="year" value="3" <?php if($result['cstanding']==3){echo 'checked';}?>>Junior 
						<input type="radio" name="year" value="4" <?php if($result['cstanding']==4){echo 'checked';}?>>Senior 
						<input type="radio" name="year" value="5" <?php if($result['cstanding']==5){echo 'checked';}?>>Grad student 
						<input type="radio" name="year" value="6" <?php if($result['cstanding']==6){echo 'checked';}?>>Other
						</br></br>
					</p>

					<p>
						Upload Profile Picture <input type="file" name="picture" accept="image/*"><br><br>
					</p>

					<p>
						Send notifications to my cell phone 
						<input type="tel" maxlength="10"  name="phn" value=<?php echo $result['phonenum']?>><br><br>
					</p>
					<button type="submit" name="update" class="button button--ujarak button--size-m button--border-medium button--text-thick">submit</button>
				</form>
			</section>
			<section id="page-profile">
			<p>Your first name, academic year, and profile picture are publicly viewable.
			</br></br>
			Phone numbers and last names are confidential and will only be used to send alerts and notifications.
			</br></br>
			We will not share or sell your private information to third parties.
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