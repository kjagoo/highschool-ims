<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>

<script language="javascript" src="scripts/calendar.js"></script>
<SCRIPT LANGUAGE="JavaScript" src="js/script2.js"></SCRIPT>
<script type='text/javascript' src='js/jquery_d.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/basic.js'></script>
</head>
<body>
    <?php
	if(isset($_GET['keyword']) ){
	include('includes/dbconnector.php');
	include 'includes/DAO.php';
	$dao = new DAO();
	
	$keyword=$_GET['keyword'];
	//if (is_numeric($keyword)){
   		//$sql = "select * from studentdetails where admno = '".$keyword."'";
	//}else{
	//$arr=explode(" ",$keyword);
	$sql = "select * from studentdetails where admno = '$keyword'";
	//}
	$result = mysql_query($sql);
	$rowscountc=mysql_num_rows($result);
	 if($rowscountc==1 ||$rowscountc>1){
	while($row = mysql_fetch_array($result)){
		$nameis=$row['fname'];
		$snames=$row['sname'];
		$lnam=$row['lname'];
		$admno=$row['admno'];
		$form=$row['form'];
		$stream=$row['class'];
	}
	
	?>
	<form action="save_issueoutbook.php" method="post">
     <table class="borders" width="100%">
	<tr style="height:30px;">
          <td class="dataListHeader" colspan="7">Issue Book: <?php echo $keyword;?></td>
        </tr>
          <tr>
            <td class="alterCell" width="20%"><b>Student Name</b></td>
            <td class="alterCell2" colspan="3"><?php echo $nameis." ".$snames." ".$lnam;?></td>
			<td class="alterCell2" rowspan="7" valign="top"><div style="width:100px;">image</div></td>
		</tr>
		<tr>
            <td class="alterCell" width="20%"><b>Admission #</b></td>
            <td class="alterCell2" colspan="3"><?php echo $admno;?></td>
            
          </tr>
          <tr>
            <td class="alterCell" width="20%"><b>Current Form</b></td>
            <td class="alterCell2" colspan="3"><?php echo $form. " ".$stream;?></td>
          </tr>
          <tr>
            <td class="alterCell" width="20%"><b>Current # of Books</b></td>
            <td class="alterCell2" colspan="3"><?php echo $dao->getIssuedBooks($admno)?></td>
          </tr>
          <tr>
            <td class="alterCell" width="20%"><b>Book Title</b></td>
            <td class="alterCell2" colspan="5">
			<div id="holder2">
                <input type="text" class="inputFields" name="keyword2" id="keyword2" tabindex="11">
              </div>
			  <div style="clear:both;"></div>
			  <div id="ajax_response2"></div>
              </td>
          </tr>
		  <tr>
            <td class="alterCell" width="20%"><b>Book Number</b></td>
            <td class="alterCell2" colspan="5">
                <input type="text" class="inputFields" name="bookno" tabindex="12"></td>
          </tr>
		  <tr>
            <td class="alterCell" width="20%"><b>Due Date</b></td>
            <td class="alterCell2" colspan="4"><?php
				require_once('classes/tc_calendar.php');
			  $myCalendar = new tc_calendar("date4", true, false);
			  $myCalendar->setIcon("images/iconCalendar.gif");
			  $myCalendar->setDate(date('d'), date('m'), date('Y'));
			  $myCalendar->setPath("calendar/");
			  $myCalendar->setYearInterval(2050, 2010);
			//  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
			  $myCalendar->setDateFormat('j F Y');
			  $myCalendar->setAlignment('right', 'bottom');
			  $myCalendar->getDate();
			  //$myCalendar->setSpecificDate(array("2011-04-01", "2011-04-04", "2011-12-25"), 0, 'year');
			  //$myCalendar->setSpecificDate(array("2011-04-10", "2011-04-14"), 0, 'month');
			  //$myCalendar->setSpecificDate(array("2011-06-01"), 0, '');
			  $myCalendar->writeScript();
				?></td>
          </tr>
		  <tr>
            <td class="alterCell" width="20%" rowspan="2"><b>Comments</b></td>
            <td colspan="4" class="alterCell2" ><textarea cols="50" rows="5" name="comment"   tabindex="13"></textarea></td>
          </tr>
          <tr>
            <td colspan="2" class="alterCell3"  align="center"><input type="submit" name="Record" value="Issue & Save Record" class="btn btn-primary"/></td>
            <td align="center"><input type="button" name="edit" value="Cancel" class="btn btn-primary" onClick="window.location='library_view_issuebook.php'"/></td>
          </tr>
      </table>
	   <input type="hidden" name="userid" value="<?php echo $admno;?>"  />
	   
	   </form>
      <?php
	  }else{?>
	 	 <script language=javascript>alert('WARNING !\n\nNo Record Found For That ADM NO'); </script>
		<script language=javascript>window.location='library_view_issuebook.php' </script>
		<?php
	  }
	}else{?>
	
	<table class="borders" width="100%">
	<tr style="height:30px;">
          <td class="dataListHeader" colspan="7">Issue Book: Provide Student Details</td>
        </tr>
        <tbody>
          <tr>
            <td class="alterCell" width="20%"><b>Student Name</b></td>
            <td class="alterCell2" colspan="3">-</td>
			<td class="alterCell2" rowspan="7" valign="top"><div style="width:100px;">image</div></td>
		</tr>
		<tr>
            <td class="alterCell" width="20%"><b>Admission #</b></td>
            <td class="alterCell2" colspan="3">-</td>
            
          </tr>
          <tr>
            <td class="alterCell" width="20%"><b>Current Form</b></td>
            <td class="alterCell2" colspan="3">-</td>
          </tr>
          <tr>
            <td class="alterCell" width="20%"><b>Current # of Books</b></td>
            <td class="alterCell2" colspan="3">-</td>
          </tr>
          <tr>
            <td class="alterCell" width="20%"><b>Book Title</b></td>
            <td class="alterCell2" colspan="4">
			<div id="holder2">
                <input type="text" disabled="disabled" class="inputFields" name="keyword2" id="keyword2" tabindex="11">
				
              </div>
			  <div style="clear:both;"></div>
			  <div id="ajax_response2"></div>
              </td>
          </tr>
		  <tr>
            <td class="alterCell" width="20%"><b>Book Number</b></td>
            <td class="alterCell2" colspan="4">
                <input type="text" disabled="disabled" class="inputFields" name="bookno" tabindex="12"></td>
          </tr>
		  <tr>
            <td class="alterCell" width="20%"><b>Due Date</b></td>
            <td class="alterCell2" colspan="4"></td>
          </tr>
		  <tr>
            <td class="alterCell" width="20%" rowspan="2"><b>Comments</b></td>
            <td colspan="3"><textarea disabled="disabled" cols="50" rows="5" name="comment"   tabindex="13"></textarea></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" disabled="disabled" name="Record" value="Issue & Save Record" class="btn btn-primary"/></td>
            
          </tr>
        </tbody>
      </table>
	
	<?php
	}
	?>
</body>
</html>
