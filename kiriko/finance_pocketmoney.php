<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
 include 'includes/Finance.php';
$finance = new Financials();
include("includes/fees.php");
	$fees = new Fees(); 

$func = new Functions();
$activity = "Viewed Finance pocket money page";
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
<link href="css/fonts.google.css" rel="stylesheet" type="text/css" />
<link href="css/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<script src="js/jquery-2.1.0.js"></script>
<script language="javascript" src="scripts/calendar.js"></script>
<script src="jsvalidators/save_pm_transaction.js"></script>
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
<script>
function getBanks(str) {
    if (str == "") {
        document.getElementById("txtBanks").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtBanks").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","fetch_banks.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a  class="active" href="finance_pocketmoney.php">Pocket Money Management</a></li>
	 <li><a href="finance_pocketmoney_list.php">Pocket Money Reports</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
  
     <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Pocket Money Management
      <div style="float:right; margin-right:20px; width:60%;">
        <table width="80%" align="right">
          <tr>
            <td align="right"><a href="finance_pocketmoney.php" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh Page</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  
</table>
<div class="col-sm-5">
                  <div class="panel panel-default">
                    <div class="panel-body">
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th> Student Name </th>
						<th>Bal</th>
						<th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					  $totalpm=0;
					 $sqlquly = "select * from studentdetails where form NOT IN ('FORM 5','TRAN') order by admno desc";
						$getStd1 = mysql_query($sqlquly);
						  while ($row= mysql_fetch_array($getStd1 )) {
						?>
						<tr id="<?php echo $row['admno']?>">
                        <td><?php echo str_replace("_"," ",$row['fname'])." ".str_replace("_"," ",$row['lname'])." ".str_replace("_"," ",$row['sname'])?></td>
						<td align='right'><?php echo number_format($fees->pocketMoneyBal($row['admno']),2)?></td>
						 <td>

						 <div class="btn-group">
						  <a href="finance_pm_view.php?ref=<?php echo $row['admno']?>" class="btn btn-primary btn-xs " target="reportView">  Process </a>
						  
						</div>
						 </td>
						 
                      </tr>
                            <?php 
					 $totalpm+=$fees->pocketMoneyBal($row['admno']);		
					} 
					
					?>
                    </tbody>
					<tfoot>
        <tr>
          <th align="right" style="font-weight:bold; margin-right:20px;">Total Pocket Money:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($totalpm,2)?></th>
		  <th></th>
        </tr>
		</tfoot>
					
					
                  </table>
                      
                    </div>
                  </div>
                </div>

<div class="col-sm-7">
				
                  
<iframe name="reportView" src="finance_pm_view.php" style="width: 100%; height: 550px;" frameborder="0"></iframe>
				  
				  
</div>
	
  </div>
</div>
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

</script>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
