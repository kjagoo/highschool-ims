<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
 require_once("includes/dbconnector.php");  

 include 'includes/functions.php';
$func = new Functions();
$activity = "Backed up Database";
$func->addAuditTrail($activity,$username);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>

<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
}
</style>
<script type="text/javascript">

function deleteConfirm(){
	doIt=confirm('You are about to delete this record\n\nDo you wish to proceed?');
	if(doIt){
  return true
	//window.location="deleteEmployee.php?id="+id;//redirect the users to the home page
	}else{
	return false
	}

}

var xmlhttp;
function loadXMLDoc(url,cfunc)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function commonFunction(id){
loadXMLDoc(id,function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("new_Area").innerHTML=xmlhttp.responseText;
    }
  });
}


	</script>
<script language="javascript" src="scripts/calendar.js"></script>
</head>
<body>

<div id="new_Area">
  <div id="page_tabs">
    <ul>
	<li><a class="active" href="system_back_up.php">Database Back Up</a></li>
    </ul>
  </div>
  <div class="clear"></div>
  <div id="display_Area">
    <div id="page_tabs_content">
      <?php

$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="kiangunu";
$date = date("Y-m-d__H-i-s");
$time=date("H:i:s a");
$directory="Database/";
$backupFile=$directory.$dbname.'_'.$date.'.sql';
$command = "mysqldump -u root kiangunu >".$backupFile;
system($command);


//echo  $backupFile;
 
 
?>
<?php
	$error = "";		//error holder
	if(isset($_POST['createpdf'])){
		$post = $_POST;		
		$file_folder = "Database/";	// folder to load files
		if(extension_loaded('zip')){	// Checking ZIP extension is available
			//if(isset($post['files']) and count($post['files']) > 0){	// Checking files are selected
				$zip = new ZipArchive();			// Load zip library	
				$zip_name = $backupFile.".zip";			// Zip name
				if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE){		// Opening zip file to load files
					$error .=  "* Sorry ZIP creation failed at this time<br/>";
				}
				//foreach($post['files'] as $file){				
					$zip->addFile($backupFile);			// Adding files into zip
				//}
				$zip->close();
				if(file_exists($zip_name)){
					// push to download the zip
					header('Content-type: application/zip');
					header('Content-Disposition: attachment; filename="'.$zip_name.'"');
					readfile($zip_name);
					// remove zip file is exists in temp path
					unlink($zip_name);
				}
				
			//}else
				//$error .= "* Please select file to zip <br/>";
		}else
			$error .= "* You dont have ZIP extension<br/>";
	}
?>
<fieldset>
<form name="zips" method="post">
      <table class="tablesorter_ordninary">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div class="clear"></div></td>
        </tr>
        <tr>
          <td>Database Name: <?php echo str_replace('Database/','',$backupFile) ?></td>
		  <td align="center"><input type="submit" name="createpdf" value="Download" class="btn btn-success" />
		  </td>
        </tr>
      </table>
</form>
</fieldset>
	  <div class="spacer"></div>
    </div>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
