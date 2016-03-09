
<?php include("sesh.php");?>
	<?php 
		if (checkAuth(true) != "") {
	?>

	<?php 	
			include("connect.php");
			$user= $_SESSION["onidid"] ;
			$fn= $conn->query("SELECT * FROM pinfo WHERE uname='$user'");
			$result_user = mysqli_fetch_array($fn);
	?>

	<?php
	 $user = $_GET['user'];
	 $phil= $conn->query("SELECT * FROM pinfo WHERE uname='$user'");
	 $result = mysqli_fetch_array($phil);
	?>



<?php
	$carrier = $result_user['carrier'];
	echo "$carrier";
	if($carrier == '0'){
		$carrier = "vtext.com"; } 
	if($carrier == '1'){
		$carrier = "txt.att.net"; }
	if($carrier == '2'){
		$carrier = "messaging.sprintpcs.com"; }
	if($carrier == '3'){
		$carrier = "tmomail.net"; }
	
	
if (isset($_POST['g-recaptcha-response'])) {
  $captcha = $_POST['g-recaptcha-response'];
  
  $custom_msg = htmlspecialchars($_REQUEST['smsMessage'], ENT_QUOTES);
  $message = "Hello, I would like to be tutored by you (contact info here)"; 
  $to = $result_user['phonenum'] . '@' . $carrier;
 
} 
		
if(isset($_REQUEST['cbox'])){
	if($captcha){ 
		$check = @mail( $to, '', $message . " " . $custom_msg );
	}
	else{
		print 'Please check the captcha';
	}
}
else{
	$check = @mail( $to, '', $message);	
}


 
 	




?>

<!DOCTYPE html>

<head>
   	<meta charset="UTF-8">
	<link rel="stylesheet" href="sms_function.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>









</head>
  <body>
	<script type="text/javascript">
		function ShowHide(cbox){
			var dvSMS = document.getElementById("dvSMS");
			
			dvSMS.style.display = cbox.checked ? "block" : "none";   
			
		}
	</script>

<div id="container">
    <h1>Contact your tutor</h1>
    <form action="" method="post">
     <ul>
      
	<li>
	<label for="cbox">
		<input type="checkbox" id="cbox" onclick="ShowHide(this)" name="cbox" />
		Attach custom message
	</label>
	</li>
	
	<div id = "dvSMS" style="display: none">
		
       <label for="smsMessage">Message</label>
       <textarea name="smsMessage" cols="40" rows="5" id="smsMessage"></textarea>
      
     
	<div class="g-recaptcha" data-sitekey="6LdHHBkTAAAAAOuXXf0IO-XCMjGDE2yLx8LuHPSO" style="padding:20px"></div>
	
	</div>
		
<li><input type="submit" name="sendMessage" id="sendMessage" value="Send Message" /></li>
</ul>
	</form>
  </div>
 </body>
<?php mysqli_close($mysqli); ?>
						
<?php }else{ ?>
	<META http-equiv="refresh" content="0;URL=tuter_list.php">
<?php } ?>


</html>
