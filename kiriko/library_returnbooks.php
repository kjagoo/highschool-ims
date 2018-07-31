<?php
require_once('auth.php');
include 'includes/DAO.php';
require_once("includes/dbconnector.php"); 
include 'includes/functions.php';

$username=$_SESSION['SESS_MEMBER_ID_'];
$func = new Functions();
$activity = "Viewed Issued books page";
$func->addAuditTrail($activity,$username);



$dao = new DAO();
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
a{cursor:pointer;
}
</style>
<!-- Initiate tablesorter script -->
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<style type="text/css" class="init">

	</style>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
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
 
String.prototype.parseURL = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(url) {
		
		
		return url.link(url);
		
			});
};
function Warn(){
	alert('ERROR!\n\nYou cannot delete this book from the list because it has unreturned books');
	return false
}
	</script>
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="library_returnbooks.php">Issued Books</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <?php
	 $dt = new DateTime();
	  $todays_date=$dt->format('Y-m-d');
	  $timenow = strtotime($todays_date);
	  
	  $statement = "b.bookid,b.category, b.title, b.author, b.publisher, i.bookid,i.bookno, i.userid, i.dateissued, i.datedue,s.fname,s.lname,s.sname, s.admno from books_invemtory b inner join issued_books i on b.bookid=i.bookid inner join studentdetails s on i.userid=s.admno  order by b.title asc";
 $statement_2="books b inner join issued_books i on b.bookid=i.bookid inner join studentdetails s on i.userid=s.admno";
 
  $query="SELECT $statement";
  $result = mysql_query($query);
   
		?>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Issued Books
          <div style="float:right; margin-right:20px;"><a href="pdf_issued_books.php"  title="Click to Print"><i class="icon32 icon-orange icon-print"></i></a> </div></td>
      </tr>
      <tr>
        <td><table id="example" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="20%"> Title</th>
                <th width="15%"> Subject</th>
                <th> Bookno</th>
                <th width="20%"> Publisher</th>
                <th width="20%">Issued To </th>
                <th width="10%">Issued On</th>
                <th width="10%">Due on</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php 
 		$num=0;
		while($row = mysql_fetch_array($result)){
		$num++;?>
              <tr class="record">
                <?php
        		echo '<td>'.$row['title'].'</td>';
				echo '<td>'.$row['category'].'</td>';
				?>
                <td><script type="text/javascript">
					var test = "<?php echo $row['bookno']; ?>";
					document.write(test.parseURL());
					</script></td>
                <?php
				echo '<td>'.$row['publisher'].'</td>';
				
				//echo '<td>'.$row['category'].'</td>';
				//echo '<td>'.$row['form'].'</td>';
				echo '<td>'.$row['admno']."- ".$row['fname']." ".$row['sname'].'</td>';
				echo '<td><font color="#00CC00">'.$row['dateissued'].'</font></td>';
				$date1 = strtotime($row['datedue']);
				$date2 = time();
				$subTime = $date1 - $date2;
				//$difs = (($date2-$date1)/(60*60))%24;
				//echo $date1." - ".$date2."= ".$subTime;
				if($subTime<0){
				echo '<td><font color="#FF0000">'.$row['datedue'].'</font></td>';// display red for overdue
				}else{
				echo '<td><font color="#00CC00">'.$row['datedue'].'</font></td>';// display green for not over due
				}
				?>
                <td align="center"><a href="#openModal<?php echo $num?>" title="Click to Edit Marks">Return</a>
                  <div id="openModal<?php echo $num?>" class="modalDialog">
                    <div> <a href="library_returnbooks.php" title="Close" class="close">X</a>
                      <form name="printed" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
                          <tr style='height:30px;'>
                            <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp;<font color="#FFFFFF">Returning Books Window</font> </td>
                          </tr>
                          <tbody>
                            <tr>
                              <td class="alterCell" width="20%"><b>Book Title</b></td>
                              <td class="alterCell2"><?php echo $row['title']?></td>
                            </tr>
                            <tr>
                              <td class="alterCell" width="20%"><b>Book Author</b></td>
                              <td class="alterCell2"><?php echo $row['author'];?></td>
                            </tr>
                            <tr>
                              <td class="alterCell" width="20%"><b>Date Issued</b></td>
                              <td class="alterCell2"><?php echo $row['dateissued'];?></td>
                            </tr>
                            <tr>
                              <td class="alterCell" width="20%"><b>Date Due</b></td>
                              <td class="alterCell2"><?php 
							  if($subTime<0){ 
							  echo '<font color="#FF0000">'.$row['datedue'].'</font>';}else{echo $row['datedue'];}?></td>
                            </tr>
                            <tr>
                              <td class="alterCell" width="20%"><b>Book Status</b></td>
                              <td class="alterCell2"><select name="status" class="select" required  tabindex="8">
                                  <option value="">-- Select Book Status --</option>
                                  <option value="Available">Available</option>
                                  <option value="Lost">Lost</option>
                                  <option value="SFR">Subject for Replacement</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td class="alterCell" width="20%"><b>Receiver's Comments</b></td>
                              <td class="alterCell2"><textarea name="comments" cols="35" rows="3"></textarea></td>
                            </tr>
                            <tr>
                              <td colspan="2"><table width="100%">
                                  <tr>
                                    <td align="center"><input type="submit" name="Record" value="Accept and Save" class="btn btn-success"/></td>
                                    <td align="center"><input type="button" name="edit" value="Cancel" class="btn btn-warning" onClick="window.location='library_returnbooks.php'"/></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </tbody>
                        </table>
                        <input type="hidden" id="bid" name="bookid" value="<?php echo $row['bookid']?>" />
                        <input type="hidden" id="sid" name="sid" value="<?php echo $row['userid']?>" />
                        <input type="hidden" id="bno" name="bookno" value="<?php echo $row['bookno']?>" />
                      </form>
                    </div>
                  </div></td>
              </tr>
              <?php
	}//end of while loop

?>
              <?php
	if(isset($_POST['bookid']) && isset($_POST['sid']) && isset($_POST['status'])){
	require_once("includes/dbconnector.php");
	
	$bookid=$_POST['bookid'];
	$bookno=$_POST['bookno'];
	$admno=$_POST['sid'];
	$comments=$_POST['comments'];
	$status=$_POST['status'];
	$date=date("Y-m-d H:i:s a");
	
	if($status=="Available"){
	$qury="insert into returned_books (bookid,userid,datereturned,receivedby,comments) values ('$bookid','$admno','$date','$username','$comments')";
	}else{
	$qury="insert into lib_lost_books (bookid,bookno,userid,date_ref,issuer_ref,comments) values ('$bookid','$bookno','$admno','$date','$username','$comments')";
	}
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
		$resultr=mysql_query("delete from issued_books where userid='$admno' and bookid='$bookid'");
		
	if(!$resultr){
	die('Invalid query: ' . mysql_error());
	}else{
	if($status=="Available"){}else{
		
		$resultupdatebooks=mysql_query("update books_invemtory set noofpcs=noofpcs-1 where bookid='$bookid'");
		}
	echo "<script language=javascript>alert('Books Record Has been Successfuly Updated') </script>";
		 echo "<script language=javascript>window.location='library_returnbooks.php' </script>";
		 }
	}
	}
	
?>
            </tbody>
          </table></td>
      </tr>
    </table>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
