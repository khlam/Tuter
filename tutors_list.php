<title>List of Tüters</title>
<?php include("sesh.php");?>
<?php if (checkAuth(true) != "") { ?>
<link rel="stylesheet" href="source/tb.css">
<?php include 'menu.php';?>
<?php
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","sprousem-db","5VQxWlk9SsEPMqP0","sprousem-db");
echo "<table>";
if ($result = $mysqli->query("select uname,fname,lname,cstanding,acctyp from pinfo")) {
	echo "<tr>";
	
	echo "<td> First name </td>";
	echo "<td> Last name </td>";
    echo "<td> Class Standing </td>";
    echo "<td> </td>";
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
             
            echo "<td>".htmlspecialchars($obj->fname)."</td>"; 
            echo "<td>".htmlspecialchars($obj->lname)."</td>";
            echo "<td>".htmlspecialchars($class)."</td>"; 
	    
            echo "<td><form action=\"profile.php\" method=\"GET\"><input type=\"hidden\" name=\"user\" value=\"$obj->uname\" /><input type=\"submit\" value=\"View Profile\" /></form></td>";
            echo "</tr>";
        }
    } 
    $result->close();
}
echo "</table>"; 
echo "</td>";


mysqli_close($mysqli);
?>
<?php }?>





























