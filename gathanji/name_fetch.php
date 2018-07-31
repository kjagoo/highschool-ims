<?php
	include("includes/dbconnector.php");
	$keyword = $_POST['data'];
	$sql = "select * from studentdetails where admno like '%".$keyword."%' or fname like '%".$keyword."%' or sname like '".$keyword."%' or lname like '%".$keyword."%'";
	//$sql = "select name from ".$db_table."";
	$result = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($result))
	{
		echo '<ul class="list">';
		while($row = mysql_fetch_array($result))
		{
			/*$str = strtolower($row['fname']);
			$start = strpos($str,$keyword); 
			$end   = similar_text($str,$keyword); 
			$last = substr($str,$end,strlen($str));
			$first = substr($str,$start,$end);
			*/
			$admno=$row['admno'];
			$final = '<span class="bold">'.ucfirst(strtolower($row['sname']))." ".ucfirst(strtolower($row['fname']))." ".ucfirst(strtolower($row['lname'])).'</span>';
		$imageref='<img src=Image/'.$admno.".jpg".' height="30" width="30" align="absmiddle" />';
		echo '<li><a href=\'javascript:void(0);\'>'.$imageref."<font color='#FFFFFF' style='display:none;'>".$admno."</font> ".$final.'</a></li>';
		
		}
		echo "</ul>";
	}
	else
		echo 0;
?>	   
