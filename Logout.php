<?php include("sesh.php");?>
<?php
	function logout(){
		//Check if onidid exists
		if(isset($_SESSION["onidid"])){
			//Clear onidid
			$_SESSION["onidid"] = "";
			//Clear ticket
			$ticket = "";
		}
		//Delete the session
		session_destroy();
	}
?>
<html>
	<body>
		<?php logout();	?>
		<META http-equiv="refresh" content="0;URL=tuter.php">
	</body>
</html>