<?php

if(isset($_POST['year'])){

$year  = $_POST['year'];
$term  = $_POST['term'];
$cashbook  = $_POST['cashbook'];

$tabletoselect = "";

if($cashbook == "parent"){
    $tabletoselect = "finance_voteheads";
}else if($cashbook == "operational"){
    $tabletoselect = "finance_operationalvoteheads";
} else if($cashbook == "tuition"){
    $tabletoselect = "finance_tuitionvoteheads";
}
require_once("includes/dbconnector.php");

 
$trm = substr($term, -1); 

$sqlq2 = mysql_query("SELECT votehead FROM $tabletoselect where term = '" . $trm . "' AND  YEAR =  '" . $year . "'")
            or die(mysql_error());
    if (mysql_num_rows($sqlq2)) {
        while ($row2 = mysql_fetch_array($sqlq2)) {
            $votehead .= $row2['votehead'] . ",";
        }
    }

    echo $votehead;
}
?>
