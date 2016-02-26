<?php include("sesh.php");?>
<?php if (checkAuth(true) != "") { ?>
<?php include 'menu.php';?>
<?php
 

	if ( isset( $_REQUEST ) && !empty( $_REQUEST ) ) {
		 if (
 		isset( $_REQUEST['phoneNumber'], $_REQUEST['carrier']) &&
  		!empty( $_REQUEST['phoneNumber'] ) &&
  		!empty( $_REQUEST['carrier'] )
	 ) {
  $custom_msg = $_REQUEST['smsMessage'];
  $message = "Hello, I would like to be tutored by you (contact info here)"; 
  $to = $_REQUEST['phoneNumber'] . '@' . $_REQUEST['carrier'];
  $check = @mail( $to, '', $message . " " . $custom_msg );
  print 'Message was sent to ' . $to;
 } else {
  //print 'Please fill in all fields.';
 }
}	

?>

<!DOCTYPE html>

<head>
   <link rel="stylesheet" href="sms_function.css">
</head>
  <body>
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
	  </br>
      <li>
       <label for="smsMessage">Message</label>
       <textarea name="smsMessage" cols="40" rows="5" id="smsMessage"></textarea>
      </li>
     
	<li><input type="submit" name="sendMessage" id="sendMessage" value="Send Message" /></li>
</ul>
	</form>
  </div>
 </body>
</html>
<?php }?>