<?php
  function menu($firstname,$lastname){ //function parameters, two variables.
    $onidid = $_SESSION["onidid"];
	$phil = 0;
	?>
<div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                	<a href = "edit_profile.php"<div class="profile">
					<?php if (file_exists("userfolders/$onidid/profilepic.gif")){ ?>
					<img src="userfolders/<?php echo $onidid;?>/profilepic.gif" alt="profile img here" height = "75" width = "75"/>  </a>
					<?php $phil = 1;
					} ?>
					<?php if (file_exists("userfolders/$onidid/profilepic.jpeg")){ ?>
					<img src="userfolders/<?php echo $onidid;?>/profilepic.jpeg" alt="profile img here" height = "75" width = "75"/>  </a>
					<?php $phil = 1;
					} ?>
					<?php if (file_exists("userfolders/$onidid/profilepic.jpg")){ ?>
					<img src="userfolders/<?php echo $onidid;?>/profilepic.jpg" alt="profile img here" height = "75" width = "75"/>  </a>
					<?php $phil = 1;
					} ?>
					<?php if (file_exists("userfolders/$onidid/profilepic.png")){ ?>
					<img src="userfolders/<?php echo $onidid;?>/profilepic.png" alt="profile img here" height = "75" width = "75"/>  </a>
					<?php $phil = 1;
					} 
					if ($phil==0){ ?>
					<img src="images/profile_default.gif" alt="profile img here" height = "75" width = "75"/>  </a>
					<?php } ?>
				<?php
				echo $firstname;
				echo ' ';
				echo $lastname;
				?>
                </li>
                <li>
                    <a href="landing.php">Home</a>
                </li>

                <li>
                    <a href="#">LOGOUT</a>
                </li>
            </ul>
</div>

  <?php } ?>

