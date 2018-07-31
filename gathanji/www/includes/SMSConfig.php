<?php
include('dbconnector.php');
class SMSConfig{

function SMSConfig() {
}

    /**
 *
 *Get SMS config
 */
 function getSMSDetails(){
 	$details=array();
$result_curr = mysql_query("SELECT * FROM messages_settings");
	while ($row_curr = mysql_fetch_array($result_curr)) {
 		$details[]=$row_curr;
	 }
	 return $details;
} 
   
   
   
   
   
}// end of class DAO

?>
