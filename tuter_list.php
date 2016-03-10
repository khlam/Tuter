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
			$result_user = $fn->fetch_assoc();
	?>


<body class="desktop">
	<div id="wrapper">
		<?php include 'menu.php';?>
		<?php 
		menu($result_user['fname'], $result_user['lname']);
		?>
				<div id="index-wrap">
					<section id = "find-header">
						<div class = "container-fluid">
							Find a <div class= "boxed--emph">Tüter</div>
						</div>
					</section>
					
					
					<div class = "col-md-6">
						<div class = "panel panel-default">
							<div class = "panel-body">
								<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
								<script type="text/javascript">
								function searchq(){
									var searchtext = $("input[name='search']").val();
									$.post("search.php",{searchVal: searchtext}, function(output) {
										$("#output").html(output);
									});
								}
								</script>
								<form action="tuter_list.php" method="post">
									<input type="text" class = "form-control" name="search" placeholder="Search..." onkeydown="searchq();">
								</form>
								<div id="output">
								</div>
							</div>
						</div>
					</div>


					<div class = ".col-xs-4 .col-md-2">
						<div class = "panel panel-default">
							<div class = "panel-body">
							<section id = "page">
								
								<table class="table table-condensed">
								<tr class="info">
									<td></td>
									<td>Firstname</td>
									<td>Year</td>
									<td></td>
								</tr>
									<?php
										$mysqli = new mysqli("oniddb.cws.oregonstate.edu","sprousem-db","5VQxWlk9SsEPMqP0","sprousem-db");
										if ($result = $mysqli->query("select uname,fname,lname,cstanding,acctyp from pinfo")) {
										    while($obj = $result->fetch_object()){ 
											$class = '';	
											$user = $obj->uname;
											if($obj->cstanding == '1')
												$class = "Freshman";
											if($obj->cstanding == '2')
												$class = "Sophomore";
											if($obj->cstanding == '3')
												$class = "Junior";
											if($obj->cstanding == '4')
												$class = "Senior";
											if($obj->cstanding == '5')
												$class = "Graduate Student";
											if($obj->cstanding == '6')
												$class = "Other";
											if($obj->acctyp == '2'){            
										      	    echo "<tr>";
										      	    echo "<td>";
										      	    $temp = imageCheck($obj->uname);
													if($temp != "false"){
														echo "<img height = '80' width = '80' class='img-circle' src = userfolders/";
														echo $obj->uname;
														echo "/profilepic";
														echo $temp;
														echo " />";
													}
													else
													{
														echo "<img src='images/profile_default.gif' height = '80' width = '80' class='img-circle'/>";
													}
										      	    echo "</td>";
										            echo "<td><h1>".htmlspecialchars($obj->fname)."</h1></td>"; 
										            echo "<td>".htmlspecialchars($class)."</td>"; 
										            echo "<td><form action=\"profile.php\" method=\"GET\"><input type=\"hidden\" name=\"user\" value=\"$user\" /><input type=\"submit\" value=\"View Profile\" /></form></td>";
										            echo "</tr>";
										        }
										    } 
										    $result->close();
										}
									echo "</td>";
									mysqli_close($mysqli);
									?>
									<?php }else{ ?>
										<META http-equiv="refresh" content="0;URL=tuter_list.php">
									<?php } ?>
								</table>
								
							</section>
							</div>
						</div>
					</div>

				</div>
	</div>
			<script src="source/menu_class.js"></script>
			<script src="source/main_menu.js"></script>
			<script src="source/bootstrap.js"></script>
</body>
</html>