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
<?php
		include ("connect.php");
		$output = '';
		if(isset($_POST["searchVal"])){
			$searchdata=htmlspecialchars($_POST["searchVal"], ENT_QUOTES);
			$qy = $conn->query("SELECT * FROM pinfo WHERE fname LIKE '%$searchdata%' AND acctyp='2'");
			$fill = $qy->num_rows;
			if($fill == 0){
				$output =  "No Tutors found by that name.";
			}
			else{
				$temp1='<form action=profile.php method=GET><input type=hidden name=user value=';
				$temp2='><input type=submit value=Profile></form>';
				while($row = $qy->fetch_assoc()){
				$output .= 
				'<td>'.$row['fname'].'</td><td>'.$temp1.$row['uname'].$temp2.'</td></td>';
			}
		}
	}
	echo $output;
?>
</html>
