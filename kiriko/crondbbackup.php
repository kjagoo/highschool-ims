<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="highschool";
$date = date("Y-m-d__H-i-s");
$time=date("H:i:s a");
$directory="D:/DATABASE/";
$backupFile=$directory.$dbname.'_'.$date.'.sql';
$command = "mysqldump -u root highschool >".$backupFile;
system($command);

?>
