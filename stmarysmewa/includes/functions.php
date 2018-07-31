<?php

include_once('mssql.class.php');
class Functions {

    var $myDB;
    var $db;
    var $status;

// constructor
    function Functions() {
	//date_default_timezone_set('Africa/Nairobi');
	$date = new DateTime();
	$date->setTimezone(new DateTimeZone('Africa/Nairobi'));

	
	   $this->myDB = new db_mssql("localhost", "root", "", "kiangunu");
        $this->today =  $date->format('Y-m-d');
        $this->saahii =  $date->format("Y-m-d h:i:s");
    }

    /* ------------------------------------------------------------------------------------------------------------------------------- */
// save audit trail.
    function addAuditTrail($activity,$username) {
// audit trail
        $colsAudit = array();
        $colsAudit['uname'] = $username;
        $colsAudit['auditDate'] = $this->now();
        $colsAudit['ipaddress'] = $_SERVER['REMOTE_ADDR'];
        $activity = trim($activity);

        $colsAudit['activity'] = addslashes($activity);

        $record = "insert into tblAudittrail(" . implode(",", array_keys($colsAudit)) . ") values('" . implode("','", $colsAudit) . "')";

        $this->myDB->query($record) or $this->myDB->raise_error();

// echo "saved";
    }// end fn addAuditTrail
	
function now() {
$date = new DateTime();
	$date->setTimezone(new DateTimeZone('Africa/Nairobi'));
        return $date->format('Y-m-d H:i:s');
    }

// end fn now()
	
}
// end class Functions
?>
