<?php
################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
## --------------------------------------------------------------------------- #
##  Store Inventory System                                                     #
##  Developed by:  Chrimoska Systems    			                           #
##  Site:          http://www.chrimoska.co.ke                                  #
##  Copyright:     2014. All rights reserved.                                  #
##                                                                             #
################################################################################
   
   
   // Initialize the session.
 require_once('auth.php');
 $username=$_SESSION['SESS_MEMBER_ID_'];
    include 'includes/functions.php';
$func = new Functions();
$activity = "Successful Logout";
$func->addAuditTrail($activity,$username);

   // Unset all of the session variables.
    $_SESSION = array();
    
    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (isset($_COOKIE[session_name()])) {
       setcookie(session_name(), '', time()-42000, '/');
    }
  
	
    // Finally, destroy the session.
    session_destroy();

    //header("Location: index.php?log=out");
  
	echo "<script>top.location.href='index.php'</script>";
    exit;
 
?> 