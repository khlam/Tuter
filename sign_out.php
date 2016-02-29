<?php
//back-end for logging out, further instruction below
	
if (isset($_GET['Logout'])){ //NOTE: 'Logout' in get request is yer button
	logout();
}

	
	function logout(){
		session_start();
		session_destroy();
		header('Logout success');
		exit;
	}



//NOTE: Within html, have a link within your button, i.e.
//<button><a href="?Logout"></a></button>
//When clicked, this executes php code above and logs user out
?>




