<?php
//include 'db.php';
if(isset($_POST["Import"])){

		$host_ip='127.0.0.1';
	$database = $host_ip.":d:/billing/billdata.fdb";
    $username = "SYSDBA";
    $password = "masterkey";
	$conn = ibase_connect($database, $username, $password);

		echo $filename=$_FILES["file"]["tmp_name"];
		

		 if($_FILES["file"]["size"] > 0)
		 {

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
	    
	          //It wiil insert a row to our subject table from our csv file`
	           $sql = "INSERT into TRANSACTIONS (ACCT_NO,MONTHOFREAD,YEAROFREAD,MTR_READ_DATE,CURR_MTR_READ)  
	            	values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]')";
	         //we are using mysql_query function. it returns a resource on true else False on error
	         // $result = mysql_query( $sql, $conn );
			 $result=ibase_query($conn,$sql);
				if(! $result )
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						</script>";
				
				}

	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
	        
			 

			 //close of connection
			//mysql_close($conn); 
				
		 	
			
		 }
	}	 
?>		 