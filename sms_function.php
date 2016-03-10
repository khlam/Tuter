<!DOCTYPE html>
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
	 $current = $_GET['user'];
	 $phil= $conn->query("SELECT * FROM pinfo WHERE uname='$current'");
	 $result = mysqli_fetch_array($phil);


	?>



<?php
	error_reporting(0);
	$carrier = $result['carrier'];
	
	
	if($carrier == '0'){
		$carrier = "vtext.com"; } 
	if($carrier == '1'){
		$carrier = "txt.att.net"; }
	if($carrier == '2'){
		$carrier = "messaging.sprintpcs.com"; }
	if($carrier == '3'){
		$carrier = "tmomail.net"; }
	
	

  $captcha = $_POST['g-recaptcha-response'];
  $to = $result['phonenum'] . '@' . $carrier;
  $custom_msg = htmlspecialchars($_REQUEST['smsMessage'], ENT_QUOTES);
  $message = "Hello, I would like to be tutored by you (contact info here)"; 
  
 
 
		
if(isset($_REQUEST['cbox'])){
	if($captcha){ 
		
		$check = @mail( $to, '', $message . " " . $custom_msg);
		
	}
	else{
		print 'Please check the captcha';
	}
}
else if($_REQUEST['sendMessage'])
{
	
	$check = @mail( $to, '', $message);	
}


 
 	




?>



<head xmlns="http://www.w3.org/1999/xhtml">
   	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<script src='https://www.google.com/recaptcha/api.js'></script>


	<link rel="stylesheet" type="text/css" href="source/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="source/sidebar.css">
	<link rel="stylesheet" type="text/css" href="source/tb.css" >
	<link rel="stylesheet" type="text/css" href="source/buttons.css">
	<link rel="stylesheet" type="text/css" href="sms_function2.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>








</head>
  <body class="desktop">
	<div id="wrapper">
		<?php include 'menu.php';?>
		<?php 
		menu($result_user['fname'], $result_user['lname']);
		?>
				<div id="index-wrap">
						<section id = "landing-header">
							
						</section>					
				</div>
			<script src="source/menu_class.js"></script>
			<script src="source/main_menu.js"></script>
			<script src="source/bootstrap.js"></script>
	






	</div>



	<script type="text/javascript">
		function ShowHide(cbox){
			var dvSMS = document.getElementById("dvSMS");
			
			dvSMS.style.display = cbox.checked ? "block" : "none";   
			
		}
	</script>

<div id="container" align = "center">
    <h1>Contact your tutor</h1>
    <p>A default message will be sent upon hitting send containing your email, if you provided it. Add additional info by including a custom message.</p>    

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
