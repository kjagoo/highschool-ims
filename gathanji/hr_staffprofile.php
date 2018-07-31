<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

 $id = $_GET['id'];
 $result = mysql_query("SELECT * from staff where idpass='$id'");


if ($result) {
	while ($row = mysql_fetch_array($result)) {
		$fname=$row['fname'];
		$mname=$row['mname'];
		$lname=$row['lname'];
		$idpass=$row['idpass'];
		$kra=$row['kra_pin'];
		$salary=$row['salary'];
		$qualification=$row['qualification'];
		$datejoined=$row['dateJoined'];
		$staffno=$row['staffno'];
		$category=$row['category'];
		$emptype=$row['employement_type'];
		$imageref=$row['imgref'];
		$telephone=$row['telephone'];
		$address=$row['address'];
 	}
 
 
}// end of results check

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/print.css" />
<link rel="stylesheet" type="text/css" href="css/Style.css" />
<link href='css/opa-icons.css' rel='stylesheet'>
<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
}
a{cursor:pointer;
}
</style>
<script type="text/javascript">

/*--This JavaScript method for Print command--*/

    function PrintDoc() {

        var toPrint = document.getElementById('printarea');

        var popupWin = window.open('', '_blank', 'width=350,height=150,location=no,left=200px');

        popupWin.document.open();

        popupWin.document.write('<html><title>::Preview::</title><link rel="stylesheet" type="text/css" href="css/print.css" /></head><body onload="window.print()">')

        popupWin.document.write(toPrint.innerHTML);

        popupWin.document.write('</html>');

        popupWin.document.close();

    }

/*--This JavaScript method for Print Preview command--*/

    function PrintPreview() {

        var toPrint = document.getElementById('printarea');

        var popupWin = window.open('', '_blank', 'width=350,height=150,location=no,left=200px');

        popupWin.document.open();

        popupWin.document.write('<html><title>::Print Preview::</title><link rel="stylesheet" type="text/css" href="css/Print.css" media="screen"/></head><body">')

        popupWin.document.write(toPrint.innerHTML);

        popupWin.document.write('</html>');

        popupWin.document.close();

    }

</script>
</head>
<body>
<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="hr_stafflist.php"><i class="icon icon-green icon-contacts"></i>Staff List</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="page_tabs_content">
  <div class="clear"></div>
  <div id="display_Area">
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Staff Information:
          <div style=" width:200px; float:right; margin-right:20px;">
            <table width="100%">
              <tr>
                <td><a href="hr_staffprofile.php?id=<?php echo $id?>"  title="Refresh Page" class="noline"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
                <td align="right"><a href="" onClick="PrintDoc()" class="noline"><i class="icon icon-orange icon-print"></i>Print</td>
                <td align="right"><a href="hr_stafflist.php"  title="Click to Go Back" class="noline"><i class="icon icon-green icon-undo"></i>Back</a></td>
              </tr>
            </table>
          </div></td>
      </tr>
      <tr>
        <td><div  id="printarea">
          <table class="tble" width="90%">
            <tr>
              <td rowspan="3" valign="middle"><img src="Staff/<?php echo $imageref?>" height="125" width="104" border="1"/> </td>
              <td colspan="3" align="center"><table width="100%">
                  <tr>
                    <td align="center">DON BOSCO SECONDARY SCHOOL</td>
                  </tr>
                  <tr>
                    <td align="center">P. O Box 434, Shinyanga </td>
                  </tr>
                  <tr>
                    <td align="center"><u>Employee Profile</u></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td valign="top"><table width="100%" align="left">
                  <tr>
                    <td>Full Name:</td>
                    <td colspan="3"><?php echo $fname." ".$mname." ".$lname; ?> </td>
                  </tr>
                  <tr>
                    <td>ID/ Passport #:</td>
                    <td colspan="3"><?php echo $idpass; ?> </td>
                  </tr>
                  <tr>
                    <td>Employee Category:</td>
                    <td><?php echo $category; ?> </td>
                  </tr>
                  <tr>
                    <td>Staff No:</td>
                    <td><?php echo $staffno; ?> </td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4"><hr/></td>
            </tr>
            <tr>
              <td colspan="2"><u><strong>Other Details</strong></u></td>
            </tr>
            <tr>
              <td>Employment Type:</td>
              <td><?php echo $emptype; ?> </td>
            </tr>
            <tr>
              <td>Salary:</td>
              <td><?php echo $salary; ?> </td>
            </tr>
            <tr>
              <td>KRA PIN #:</td>
              <td><?php echo $kra; ?> </td>
            </tr>
            <tr>
              <td width="20%">Address:</td>
              <td><?php echo $address; ?></td>
            </tr>
            <tr>
              <td width="20%">Staff Qualifications:</td>
              <td colspan="3"><table>
                  <?php 
		  $arq=explode(',',$qualification);
		  for ($i=0;$i<count($arq);$i++){
		  ?>
                  <tr>
                    <td><?php echo strtoupper($arq[$i])?></td>
                  </tr>
                  <?php
		  }
		  ?>
                </table></td>
            </tr>
          </table></td>
      </tr>
    </table>
  </div>
</div>
</div>
<!--end of display area.-->
</body>
</html>
