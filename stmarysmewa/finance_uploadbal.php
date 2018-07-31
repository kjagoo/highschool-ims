<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	$('#example').dataTable( {
		"columnDefs": [ 
			{
				// The `data` parameter refers to the data for the cell (defined by the
				// `data` option, which defaults to the column being worked with, in
				// this case `data: 0`.
				//"render": function ( data, type, row ) {
				//	return data +' ('+ row[3]+')';
				//},
				//"targets": 0
			},
			//{ "visible": false,  "targets": [ 3 ] }
		]
	} );
} );

</script>
</head>
<body>
<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a  href="finance_recordbal.php">Record Balances</a></li>
    <li><a class="active"  href="finance_uploadbal.php">Upload Balances</a></li>
  </ul>
</div>
<?php
 require_once("includes/dbconnector.php"); 
include 'includes/Finance.php';
$finance = new Financials(); 

?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="upload_excel" enctype="multipart/form-data">
  <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
    <tr style='height:30px;'>
      <td class='dataListHeader' colspan="3">Import Balances AS CSV/Excel file</td>
    </tr>
    <tr>
      <td class="alterCell" width="20%">CSV/Excel File:</td>
      <td class="alterCell2"><div style="float:left;">
          <input type="file" name="file" id="file">
        </div></td>
		<td><a href="Excel/Sample.csv">Download Sample CSV </a></td>
    </tr>
    <tr>
      <td class="alterCell"></td>
      <td class="alterCell2"><div style="float:left;">
          <input type="submit" name="Import" value="Upload Balances" class="btn btn-primary"/>
        </div></td>
    </tr>
    </td>
    
  </table>
</form>
<?php 
 if(isset($_POST["Import"])){
require_once("includes/dbconnector.php");
	
	$month="";
	$ERROR=0;
		$filename=$_FILES["file"]["tmp_name"];
		

		 if($_FILES["file"]["size"] > 0){

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE){
			 
	      $sql = "INSERT into finance_balances (admno,balance)  
	            	values('$emapData[0]','$emapData[1]') on duplicate key update balance='$emapData[1]'";
					
			 $result=mysql_query($sql);
				if(! $result ){
				echo mysql_error()."<br/>";
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"finance_uploadbal.php\"
						</script>";
				
				}
			
	      }//end of while looop
		  ?>
<?php echo $ERROR?> row(s) was not Successfully Imported:<br/>
The following rows were successfully Imported
<table id="example" class="table table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>ADMNO</th>
      <th>Student Name</th>
      <th align="center">Balance</th>
    </tr>
  </thead>
  <tbody>
    <?php
	$result_select = mysql_query("SELECT fb.*, s.fname,s.lname,s.sname FROM finance_balances as fb inner join studentdetails s on fb.admno=s.admno order by fb.admno asc");
	while ($row = mysql_fetch_array ($result_select)) { ?>
    <tr>
      <td><?php echo $row['admno'] ?></td>
      <td><?php echo $row['fname']." ".$row['lname']." ".$row['sname'] ?></td>
      <td align="right"><?php echo $row['balance']?></td>
    </tr>
    <?php
}
?>
  </tbody>
</table>
<?php
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         
	        
			 

			 //close of connection
			//mysql_close($conn); 
				
		 	
			
		 }
	}//end of if is set	 
 ?>
</body>
</html>
