<?php
  function menu($firstname,$lastname){ //function parameters, two variables.
    echo '
<div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                	<a href = "edit_profile.php"<div class="profile"><img src="images/profile_default.gif" alt="profile img here" height = "75" width = "75"/>  </a>';
				echo $firstname;
				echo ' ';
				echo $lastname;
echo'
                </li>
                <li>
                    <a href="landing.php">Home</a>
                </li>
                <li>
                    <a href="reader.php">List of Tüters</a>
                </li>
                <li>
                    <a href="sms_function.php">Message a Tüter</a>
                </li>
                <li>
                    <a href="#">LOGOUT</a>
                </li>
            </ul>
</div>
';
  }
?>
