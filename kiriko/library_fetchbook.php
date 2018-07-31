<?php
	include("includes/dbconnector.php");
	$keyword = $_POST['data'];
	$sql = "select * from books_invemtory where title like '%".$keyword."%'";
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
			$final = '<span class="bold">'.$row['bookid']." ".$row['title'].'</span>';
		
			echo '<li><a href=\'javascript:void(0);\'>'.$final.'</a></li>';
		}
		echo "</ul>";
	}
	else
		echo 0;
?>	   
