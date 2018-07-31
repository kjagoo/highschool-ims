<?php
	//Start session
	session_start();
	//$_SESSION['SESS_MEMBER_ID_'] = 'Admin';
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID_']) || (trim($_SESSION['SESS_MEMBER_ID_']) == '')) {
		header("location: logout.php");
		exit();
	}
/*if ((time()-$_SESSION['lastactivity'])>=600){//logout user after 10 minutes of inactivity
	header("location: logout.php");
		exit();
	}else{
	$_SESSION['lastactivity'] = time();
	
	}*/

?>