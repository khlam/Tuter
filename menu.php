<?php
  function menu($firstname,$lastname){ //function parameters, two variables.
    $onidid = $_SESSION["onidid"];
	$phil = 0;
	?>
<div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                	<a href = "edit_profile.php">
                	<div class="profile">
                		<div class = "card">
                			<?php if (file_exists("userfolders/$onidid/profilepic.gif")){ ?>
							<img src="userfolders/<?php echo $onidid;?>/profilepic.gif" height = "150" width = "150" class="img-circle"/>  </a>
							<?php $phil = 1;
							} ?>
							<?php if (file_exists("userfolders/$onidid/profilepic.jpeg")){ ?>
							<img src="userfolders/<?php echo $onidid;?>/profilepic.jpeg" height = "150" width = "150" class="img-circle"/>  </a>
							<?php $phil = 1;
							} ?>
							<?php if (file_exists("userfolders/$onidid/profilepic.jpg")){ ?>
							<img src="userfolders/<?php echo $onidid;?>/profilepic.jpg" height = "150" width = "150" class="img-circle"/>  </a>
							<?php $phil = 1;
							} ?>
							<?php if (file_exists("userfolders/$onidid/profilepic.png")){ ?>
							<img src="userfolders/<?php echo $onidid;?>/profilepic.png" height = "150" width = "150" class="img-circle"/>  </a>
							<?php $phil = 1;
							} 
							if ($phil==0){ ?>
							<img src="images/profile_default.gif" height = "150" width = "150" class="img-circle"/>  </a>
							<?php } ?> 
	                	<div class ="card_content"> 
	                		<p><a href = "edit_profile.php">Edit Profile</a></p>
	                	</div>
	                	</div>
                	</a>
                	
           


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

