<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="gathanji";
$date = date("Y-m-d__H-i-s");
$time=date("H:i:s a");
$directory="E:/DATABASE/";
$backupFile=$directory.$dbname.'_'.$date.'.sql';
$command = "mysqldump -u root gathanji >".$backupFile;
system($command);

?>
