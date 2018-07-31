<?php
require_once('auth.php');
include 'includes/DAO.php';
require_once("includes/dbconnector.php"); 
include 'includes/functions.php';

$username=$_SESSION['SESS_MEMBER_ID_'];
$func = new Functions();
$activity = "Viewed Lost books list";
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
    <li><a class="active" href="library_lostbooks.php">Lost Books List</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Lost Books List
          <div style="float:right; margin-right:20px;"><a href="pdf_lostbooks.php"  title="Click to Print">
            <button><i class="icon icon-orange icon-print"></i>Print</button>
            </a> </div></td>
      </tr>
      <tr>
        <td colspan="2"><table id="example" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th> #</th>
                <th width="20%">Title</th>
                <th  width="10%">Book No</th>
                <th width="15%">Subject</th>
                <th>Book Type</th>
                <th>YR Edn.</th>
                <th>Issued By </th>
                <th>Issued to</th>
                <th> </th>
                
              </tr>
            </thead>
            <tbody>
              <?php 
	$result = mysql_query("select b.title,b.publisher, b.category, b.bookid,b.btype,b.yrofedition, l.bookid, l.bookno, l.comments, l.userid, l.issuer_ref, s.fname,s.lname,s.sname, s.admno 
from books_invemtory as b inner join lib_lost_books l on l.bookid=b.bookid  inner join studentdetails s on l.userid=s.admno order by b.title desc");
 		$num=0;
		while($row = mysql_fetch_array($result)){
		$num++;
		echo '<tr class="record"  title="'. $row['comments'].'">';
				echo '<td>'.$num.'</td>';
				//echo '<td>'.$row['sn'].'</td>';
        		echo '<td>'.$row['title'].'</td>';
				?>
            <td align="center"><script type="text/javascript">
var test = "<?php echo $row['bookno']; ?>";
document.write(test.parseURL());
</script></td>
              <?php
				echo '<td>'.$row['category'].'</td>';
				
				echo '<td>'.$row['btype'].'</td>';
				//echo '<td>'.$row['form'].'</td>';
				echo '<td align="center">'.$row['yrofedition'].'</td>';
				echo '<td align=center>'.$row['issuer_ref'].'</td>';
				echo '<td align=center><a rel="#" title="'.$row['fname']." ".$row['sname']." ".$row['lname'].'" class="tool"><span title="">'.$row['userid'].'</span></a></td>';
				
				?>
              <td align="center"><a href="#" id="<?php echo $row["bookid"]; ?>" class="delbutton" title="Marks as Replaced"><i class="icon icon-orange icon-arrowreturn-ws"></i></a></td>
            
              <?php
				echo '</tr>';
			}

?>
              </tbody>
          </table></td>
      </tr>
    </table>
  </div>
</div>
<!--end of display area-->
</body>
</html>
