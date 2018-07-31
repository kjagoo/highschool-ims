<?php

if(isset($_POST['ponumber'])){
$username = $_POST['ponumber'];
  require_once("includes/dbconnector.php");

$sql_check = mysql_query("select po_number from purchase_orders where po_number='".$username."' and po_status='OPEN'") or die(mysql_error());

if(mysql_num_rows($sql_check)){
echo 'OK';
}
else{
echo '<font color="red">L.P.O. # <STRONG>'.$username.'</STRONG> NOT FOUND OR IT IS CLOSED.</font>';
}

}

?>