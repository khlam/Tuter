<?php
  function menu($firstname,$lastname){ //function parameters, two variables.
    echo '
<div class="menu-wrap">
	<div class="hover_img">
		<a href="edit_profile.php"><span><img src="" alt="Edit Profile" height="50" /></span>
			<nav class="menu-top">
				<div class="profile"><img src="images/profile_default.gif" alt="profile img here" height = "75" width = "75"/>';
				echo $firstname;
				echo ' ';
				echo $lastname;
echo'
				</div>
			</nav>
		</a>
	</div>
		<nav class="menu-side">
			<a href="landing.php">Home</a> 
			<a href="reader.php">List of Tüters</a> 
			<a href="sms_function.php">Message a Tüter</a>
			<a href="#">LOGOUT</a>
		</nav>
</div>

';
  }
?>
