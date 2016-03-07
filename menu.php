<?php
	function imageCheck($onid){
		if(file_exists("userfolders/$onid/profilepic.gif")){
			return ".gif";
		}
		if(file_exists("userfolders/$onid/profilepic.jpeg")){
			return ".jpeg";
		}
		if(file_exists("userfolders/$onid/profilepic.jpg")){
			return ".jpg";
		}
		if(file_exists("userfolders/$onid/profilepic.png")){
			return ".png";
		}
		return "false";
	}


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
							<?php $type = imageCheck($onidid);?>
                			<?php if ($type == "false"){ ?>
							<img src="images/profile_default.gif" height = "150" width = "150" class="img-circle"/>  </a>
							<?php } ?>
							<?php if($type != "false"){ ?>
							<img src="userfolders/<?php echo $onidid;?>/profilepic<?php echo $type;?>" height = "150" width = "150" class="img-circle"/>  </a>
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
                	<a href="tutors_list.php">Tuters</a>
                </li>

                <li>
                    <a href="Logout.php">LOGOUT</a>
                </li>
            </ul>
</div>

  <?php } ?>

