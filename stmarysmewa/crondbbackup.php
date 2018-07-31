<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="kiangunu";
$date = date("Y-m-d__H-i-s");
$time=date("H:i:s a");
$directory="E:/DATABASE/";
$backupFile=$directory.$dbname.'_'.$date.'.sql';
$command = "mysqldump -u root kiangunu >".$backupFile;
system($command);

?>
