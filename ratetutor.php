<!DOCTYPE html>
<html>
<head>
	<title>Rate your tutor</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="source/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="source/sidebar.css">
	<link rel="stylesheet" type="text/css" href="source/tb.css" />
	<link rel="stylesheet" type="text/css" href="source/buttons.css">
</head>

	<?php 	
			include("connect.php");
			$onidid= $_SESSION["onidid"] ;
			$userInfo= $conn->query("SELECT * FROM pinfo WHERE uname='$onidid'");
			$result = mysqli_fetch_array($userInfo);

	?>

<body class="desktop">
			<h1>Hello World!</h1>
			<?php
			$user = $_GET["user"];
			$tuterinfo = $conn->query("SELECT uname FROM tuters WHERE uname= '$user'");
			if ($tuterresult = mysqli_fetch_array($tuterinfo)) {
				?>

					<form action="handlerate.php" method="POST" >
					Please rate 
					<input type="number" name="rate" id="rate" max="10" min="1"></input>
					<input type="hidden" name="tutor" id="tutor" value="<?php echo "$user"; ?>"></input>
					<input type="submit"></input>
					</form>

				<?php
			}
			else
			{
				echo "That is not a valid tutor.";
			}
			?>
				

		<?php mysqli_close($conn); ?>
</body>
</html>
