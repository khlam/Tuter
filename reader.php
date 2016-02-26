<title>List of Tüters</title>
<?php include("sesh.php");?>
<?php if (checkAuth(true) != "") { ?>
<link rel="stylesheet" href="source/tb.css">
<?php include 'menu.php';?>
<?php

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","sprousem-db","5VQxWlk9SsEPMqP0","sprousem-db");

echo "<table>";
if ($result = $mysqli->query("select uname,fname,lname,cstanding,ppicaddress,phonenum from pinfo")) {
	echo "<tr>";
	echo "<td> Username </td>";
	echo "<td> First name </td>";
	echo "<td> Last name </td>";
    echo "<td> Class Standing </td>";
    echo "<td> Profile Pic Address </td>";
    echo "<td> Phone Number </td>";
    while($obj = $result->fetch_object()){ 
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->uname)."</td>"; 
            echo "<td>".htmlspecialchars($obj->fname)."</td>"; 
            echo "<td>".htmlspecialchars($obj->lname)."</td>";
            echo "<td>".htmlspecialchars($obj->cstanding)."</td>"; 
            echo "<td>".htmlspecialchars($obj->ppicaddress)."</td>"; 
            echo "<td>".htmlspecialchars($obj->phonenum)."</td>";  
            echo "</tr>";
    } 

    $result->close();
}
echo "</table>"; 
echo "</td>";
echo "<td>";
echo "<table>";
if ($result = $mysqli->query("select uname,rating from ratings")) {
echo "<tr>";
echo "<td> Username </td>";
echo "<td> Rating </td>";
	while($obj = $result->fetch_object()){ 
        echo "<tr>";
        echo "<td>".htmlspecialchars($obj->uname)."</td>"; 
        echo "<td>".htmlspecialchars($obj->rating)."</td>"; 
        echo "</tr>";
    }
 
    $result->close();
} 
	
echo "</table>"; 
mysqli_close($mysqli);
?>
<?php }?>