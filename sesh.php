<?php
	//Create the session: THIS IS THE FIRST THING THAT SHOULD HAPPEN!!!
	session_start();
	//The creation of the function that will be called.
	function checkAuth($doRedirect){
		//Check if the onidid is saved in the session.
		if(isset($_SESSION["onidid"]) && $_SESSION["onidid"] != ""){
			//Valid input, allow person to enter the site.
			return $_SESSION["onidid"];
		}
		//Start creating the url of the page that was accessed.
		$pageURL = 'http';
		//If https instead of http
		if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on"){
			$pageURL .= "s";
		}
		//Continue the construction of the url
		$pageURL .= "://";
		//Get the remainder of the url information either with a different port, or without.
		if($_SERVER["SERVER_PORT"] != "80"){
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"];
		}
		else{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
		}
		//Create a ticket to send to CAS.
		$ticket = isset($_REQUEST["ticket"]) ? $_REQUEST["ticket"] : "";;
		
		if($ticket != ""){
			//Get the user id from the CAS server and parse it.
			$url = "https://login.oregonstate.edu/cas/serviceValidate?ticket=".$ticket."&service=".$pageURL;
			$html = file_get_contents($url);
			//Get the pattern to parse
			$pattern = '/\\<cas\\:user\\>([a-zA-z0-9]+)\\<\\/cas\\:user\\>/';
			preg_match($pattern, $html, $matches);
			//Compare the parsed results.
			if($matches && count($matches) > 1){
				//Save the info in the ticket and return to user's session.
				$onidid = $matches[1];
				$_SESSION["onidid"] = $onidid;
				return $onidid;
			}
		}
		else if($doRedirect){
			$url = "https://login.oregonstate.edu/cas/login?service=".$pageURL;
			echo "<script>location.replace('" . $url . "');</script>";
		}
		return "";
	}
?>