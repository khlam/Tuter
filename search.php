<?php
		include ("connect.php");
		$output = '';
		if(isset($_POST["searchVal"])){
			$searchdata=htmlspecialchars($_POST["searchVal"], ENT_QUOTES);
			$qy = $conn->query("SELECT * FROM pinfo WHERE fname LIKE '%$searchdata%' AND acctyp='2'");
			$fill = $qy->num_rows;
			if($fill == 0){
				$output =  "No results found";
			}
			else{
				while($row = $qy->fetch_assoc()){
				$output .= '<div>'.$row['fname'].' is a tuter! Scroll down to find them!'.'</div>';
			}
		}
	}
	echo $output;
?>
