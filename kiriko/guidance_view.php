<?php
include('includes/dbconnector.php');
$curr_year=date('Y');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
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
<body class="centonomy_theme" style="background-color:white;">

<?php



if (isset ($_GET['ref'])){
	
	$admno=$_GET["ref"];

$query = "select * from studentdetails where admno='$admno'";

// run the query and store the results in the $result variable.
$result =mysql_query($query);
if (!$result) {
echo "Error!-".mysql_error();
}else{

while($row = mysql_fetch_array($result)){
		$nameis=$row['fname'];
		$snames=$row['sname'];
		$lnam=$row['lname'];
		$admno=$row['admno'];
		$form=$row['form'];
		$stream=$row['class'];
		//$imageref=$row['picture'];
	}
	
            ?>
	<div class="panel">
       <header class='dataListHeader'>Guidance and Councelling Report</header>
	 <div class="panel-body">	

  <form name="frmRegistration" id="registration-form"  class="form-horizontal row-border" method="post">
       <table width='100%'>
	   
	   <tr>
        <td class="alterCell" width="25%" rowspan="2" valign="top"><img src="Image/<?php echo $admno?>.jpg" width="150" height="150" border="1" />
		Name:<?php echo str_replace("_"," ",$nameis)." ".str_replace("&","'",$snames)." ".str_replace("&","'",$lnam)?><br/>
		<?php echo $form." ".$stream?><br/>
		</td>
		
        <td width="75%" align='left'>Guidance Comments<br/><textarea cols="50" rows="5" name="comment"  tabindex="13" style="padding:20px;"></textarea></td>
		</tr>
		<tr>
            <td align="center"><input type="submit" name="Record" value="Save Record" class="btn btn-primary"/></td>
          </tr>
	   </table>
		<input type="hidden" name="admno" tabindex="1" required value="<?php echo $admno ?>"/>			
  </form>
  
  <table class="borders" cellpadding="5" cellspacing="0">
	 <tr style="height:30px;">
	 <td class="dataListHeader">Previous Reports</td>
	  </tr>
	<tr>
	<td>
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th> #</th>
          <th>Date </th>
          <th>Comments</th>
        </tr>
      </thead>
      <tbody>
	<?php
		$num=0;
		$resultd = mysql_query("SELECT * FROM guidance where admno='$admno'");
		while($rowd = mysql_fetch_array($resultd)){
		$num++;
		?>
        <tr>
          <td><?php echo $num;?></td>
          <td><?php echo $rowd['date_added'] ?></td>
          <td><?php echo $rowd['comments'];?></td>
        </tr>
        <?php
			}
		?>
      </tbody>
    </table>
	</td>
</tr>
</table>
 </div> 
 </div>           
       <?php     
  }
}else{
	?>
	<div class="panel">
       <header class='dataListHeader'>Guidance and Councelling Report</header>
	 <div class="panel-body">
	 <table  class="display table table-bordered table-striped" id="dynamic-table">
             <thead>
        <tr>
          <th> #</th>
          <th>Date </th>
          <th>Comments</th>
        </tr>
      </thead>
              <tbody>
			  </tbody>
			  </table>
	</div>
	</div>
	<?php
		}
	?>
	
	 
<!--\\\\\\\ wrapper end\\\\\\-->
<script src="js/bootstrap.min.js"></script>
<script src="js/common-script.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/jPushMenu.js"></script>
<script src="plugins/data-tables/jquery.dataTables.js"></script>
<script src="plugins/data-tables/DT_bootstrap.js"></script>
<script src="plugins/data-tables/dynamic_table_init.js"></script>
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    
    
     });
    

   </script>
</body>
</html>