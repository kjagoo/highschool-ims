<?php

if(isset($_POST['admno'])){
$username = $_POST['admno'];
  require_once("includes/dbconnector.php");

$sql_check = mysql_query("select admno from studentdetails where admno='".$username."'") or die(mysql_error());

if(mysql_num_rows($sql_check)){
echo 'OK';
}
else{
echo '<font color="red">ADMNO <STRONG>'.$username.'</STRONG> DOES NOT EXIST.</font>';
}

}

?>