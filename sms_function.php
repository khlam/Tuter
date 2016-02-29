
<?php
 
	
	if ( isset( $_REQUEST ) && !empty( $_REQUEST ) ) {
		 if (
 		isset( $_REQUEST['phoneNumber'], $_REQUEST['carrier']) &&
  		!empty( $_REQUEST['phoneNumber'] ) &&
  		!empty( $_REQUEST['carrier'] ) &&
	 	isset($_POST['g-recaptcha-response'])
		) {
  $captcha = $_POST['g-recaptcha-response'];
  
  $custom_msg = htmlspecialchars($_REQUEST['smsMessage'], ENT_QUOTES);
  $message = "Hello, I would like to be tutored by you (contact info here)"; 
  $to = $_REQUEST['phoneNumber'] . '@' . $_REQUEST['carrier'];
 
} else {
  		print 'Please fill in all fields. ';
   }
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
	$check = @mail( $to, '', $message . " " . $custom_msg );	
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
       <label for="phoneNumber">Phone Number</label>
       <input type="text" name="phoneNumber" id="phoneNumber" /></li>
      <li>
      <label for="carrier">Carrier (i.e. "vtext.com")</label>
       <input type="text" name="carrier" id="carrier" />
      </li>
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
</html>
