<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

 $id = $_GET['id'];
 $result = mysql_query("SELECT * from studentdetails where admno='$id'");


if ($result) {
	while ($row = mysql_fetch_array($result)) {
		$adm=$row['admno'];
		$fname=$row['fname'];
		$mname=$row['sname'];
		$lname=$row['lname'];
		$gender=$row['gender'];
		$yob=$row['dob'];
		$religion=$row['religion'];
		$form=$row['form'];
		$class=$row['class'];
		$admnyear=$row['yrofadmn'];
		$category=$row['category'];
		$imageref=$row['picture'];
		$house=$row['house'];
		$previous=$row['previouschool'];
 	}
 if(!file_exists("Image/".$adm.".jpg"))
  {
  $image1="images/blur.png";
  }
else
  {
 $image1 = "Image/".$adm.".jpg";
  }
 
}// end of results check
$res = mysql_query("SELECT * from parentdetails  where admno='$adm'");
$pfname="Not Available";
$pmname="Not Available";
$plname="Not Available";
$address="Not Available";
$ptele="Not Available";
if ($res) {

while ($rows = mysql_fetch_array($res)) {

$pfname=$rows['fname'];
$pmname=$rows['sname'];
$plname=$rows['lname'];
$address=$rows['address'];
$ptele=$rows['telephone'];


 }
 
	$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
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
<div id="display_Area">
<div id="page_tabs_content">
    <div  id="printarea">
      <table class="borders" width="90%">
        <tr style="height:30px;">
		<td colspan="2" class="dataListHeader"> Student Profile
		<div style="float:right; margin-right:20px;"> 
		<table width="200px;"><tr><td align="center"><a href="student_profile.php?id=<?php echo $id?>" class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
		<td><a href="#" class="noline" onClick="PrintDoc()"><span class="icon icon-orange icon-print"></span>Print</a></td>
		<td align="right"> <a href="#" class="noline" onClick="window.location='student_list_view.php'"><span class="icon icon-orange icon-undo"></span>Back</a></td></tr></table>
		
		
		 
		  </div>
		  </td>
        </tr>
        <tr>
          <td colspan="4" align="center"><table width="100%">
              <tr>
                <td align="center"><?php echo $schoolname?></td>
              </tr>
              <tr>
                <td align="center">P. O Box <?php echo $po?>, <?php echo $plac?> </td>
              </tr>
			  <tr>
                <td align="center"><u>Student Profile</u></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td valign="middle"><img src="<?php echo $image1?>" height="125" width="104" border="1"/> </td>
          <td valign="top"><table width="100%">
              <tr>
                <td colspan="2"><u>Student Personal Details</u></td>
              </tr>
              <tr>
                <td>Student Name:</td>
                <td colspan="3"><?php echo $fname." ".$mname." ".$lname; ?> </td>
              </tr>
              <tr>
                <td>Admission No.:</td>
                <td><?php echo $adm; ?></td>
                <td>Class:</td>
                <td><?php echo $form." ".$class; ?></td>
              </tr>
              <tr> </tr>
              <tr>
                <td>Year Admitted:</td>
                <td><?php echo $admnyear; ?></td>
              </tr>
              <tr>
                <td>Category:</td>
                <td><?php echo $category; ?></td>
                <td>House:</td>
                <td><?php echo $house; ?></td>
              </tr>
              
              <tr>
                <td>Previous School:</td>
                <td colspan="3"><?php echo $previous; ?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="2"><u>Family Details</u></td>
        </tr>
        <tr>
          <td width="20%">Place of Residence:</td>
          <td><?php echo $address; ?></td>
        </tr>
        <tr>
          <td>Yr of Birth:</td>
          <td><?php echo $yob; ?></td>
        </tr>
        <tr>
          <td>Gender:</td>
          <td><?php echo $gender; ?></td>
        </tr>
        
        <tr>
          <td>Religion:</td>
          <td><?php echo $religion; ?></td>
        </tr>
       
        <tr>
          <td colspan="2"><u>Parent  Details</u></td>
        </tr>
        <tr>
          <td>Full Name:</td>
          <td><?php echo $pfname." ".$plname?></td>
        </tr>
        <tr>
          <td>Address:</td>
          <td><?php echo $pmname; ?></td>
        </tr>
        <tr>
          <td>Telephone #:</td>
          <td><?php echo $ptele; ?></td>
        </tr>
        
        <tr>
          <td colspan="2"><u>Student Performance Overview</u></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><table border="1" width="90%" align="center">
              <tr>
                <td>&nbsp;</td>
                <td colspan=3>Form 1</td>
                <td colspan=3>Form 2</td>
                <td colspan=3>Form 3</td>
                <td colspan=2>Form 4</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td >T1</td>
                <td >T2</td>
                <td >T3</td>
                <td >T1</td>
                <td >T2</td>
                <td >T3</td>
                <td >T1</td>
                <td >T2</td>
                <td >T3</td>
                <td >T1</td>
                <td >T2</td>
              </tr>
              <tr>
                <td id=inputfields>Mean:</td>
                <td align=center>-</td>
                <td align=center>-</td>
                <td align=center>-</td>
                <td align=center>-</td>
                <td align=center>-</td>
                <td align=center>-</td>
                <td align=center>-</td>
                <td align=center>-</td>
                <td align=center>-</td>
                <td>-</td>
                <td>-</td>
              </tr>
              <tr>
                <td id=inputfields>Pos:</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              </tr>
              <tr>
                <td id=inputfields>Out OF:</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
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
