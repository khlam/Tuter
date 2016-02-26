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
<!--
<div class="menu-wrap">

	
	<div class="hover_img">
		<a href=""><span><img src="" alt="Edit Profile" height="50" /></span>
			<nav class="menu-top">
				<div class="profile"><img src="images/profile_default.gif" alt="profile img here" height = "75" width = "75"/><?php echo $result['fname']?> <?php echo $result['lname']?></div>
			</nav>
		</a>
	</div>
		<nav class="menu-side">
			<?php include 'menu.php';?>
		</nav>
</div>
-->
<button class="menu-button" id="open-button"></button>

<div class="content-wrap">
	<div class = "content">
	<div id="index-wrap">
		<section id = "profile-edit-header">
			<div class = "container">
				<h1>Generic <div class= "boxed--emph">page</div></h1>
			</div>
		</section>
		<section id="page">
			   <p>Generic Content</p>
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