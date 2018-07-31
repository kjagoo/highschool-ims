<?php
// Test CVS

require_once 'Excel/reader.php';


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/

//$data->read('jxlrwtest.xls');

/*


 $data->sheets[0]['numRows'] - count rows
 $data->sheets[0]['numCols'] - count columns
 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
    
    $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
        if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
    $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format 
    $data->sheets[0]['cellsInfo'][$i][$j]['colspan'] 
    $data->sheets[0]['cellsInfo'][$i][$j]['rowspan'] 
*/
$filename = $_FILES['cover_image']['name']; // Get the name of the file (including file extension).
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
	/***************************************************/
	if(!$filename){
	 echo "<script language=javascript>alert('Please Provide the Excel contact file'); </script>";
		 echo "<script language=javascript>window.history.go(-1); </script>";
	}
	echo $filename;
	 $upload_path = 'groupContacts/'; // The place the files will be uploaded to (currently a 'files' directory).
	  move_uploaded_file($_FILES['cover_image']['tmp_name'],$upload_path . $filename);
	  
	  
$data->read("groupContacts/".$filename);	
$original = explode(".", $filename);

	
	$newFilename =str_replace(" ","_",$original[0]);

//echo $newFilename; // piece1

//error_reporting(E_ALL ^ E_NOTICE);
include('dbconnector.php');
for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	$tele=$data->sheets[0]['cells'][$i][$j];
		//echo "".$tele."";
		
		$query="insert into contacts_groups (group_name,telephones) values('$newFilename','$tele')";
		 $result = mysql_query($query);
	if (!$result) {
         die('Invalid commad: ' . mysql_error());
   		 }else{
		   echo "<script language=javascript>alert('File has been Uploaded Please Select Contacts from the Opposit menu'); </script>";
		 echo "<script language=javascript>window.history.go(-1); </script>";
		 }
	}
	
	echo "<br/>";

}


//print_r($data);
//print_r($data->formatRecords);
?>
