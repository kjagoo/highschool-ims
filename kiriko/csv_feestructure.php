<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=FeesStructure-export.xls");

include('includes/dbconnector.php'); 
include 'includes/Finance.php';
	$finacial= new Financials();

	$finance=$_GET['year'];
	$term=$_GET['term'];
	$form=$_GET['form'];

echo "<h1>FEES STRUCTURE FORM ". $form."  ". $term." YEAR ". $finance." </h1>";
?>

 <table width='100%' border=1>
   			<thead>
              <tr>
			   <th>Votehead</th>
               <th>Payable Amount</th>
			   <th>Projection</th>
			</tr>
			</thead>
			<tbody>
			 
			<?php
		if($term=='ALL'){
	 $result = mysql_query("select * from finance_fees where fiscal_yr='$finance' and form='$form' order by votehead asc");
	}else{
	 $result = mysql_query("select * from finance_fees where fiscal_yr='$finance' and term='$term' and form='$form' order by votehead asc");
	}
		 
		  $rowscounts=mysql_num_rows($result);
		  if($rowscounts==1 ||$rowscounts>1){
		  
		  $num=0;
		  $totalb=0;
		  $totalbs=0;
		  $totalp=0;
		  while($row = mysql_fetch_array($result)){ $num++;?>
        <tr>
		 
          <td class="alterCell" width="25%"><?php echo $row['votehead']?></td>
          <td align="right"><?php echo number_format($row['amount'],2)?> </td>
		  <td align="right"><?php echo number_format(($finacial->getEstimateProjection($row['votehead'],$finance,$form,$row['amount'])),2)?></td>
        </tr>
		
        <?php 
		  $totalb+=$row['amount'];
		  $totalp+=($finacial->getEstimateProjection($row['votehead'],$finance,$form,$row['amount']));
		 }
			?>
		</tbody>
		<tfoot>
        <tr>
          <th align="right" style="font-weight:bold; margin-right:20px;">Summary:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($totalb,2)?></th>
		  <th align="right" style="font-weight:bold;"><?php echo number_format($totalp,2)?></th>
        </tr>
		</tfoot>
        <?php  }
		  ?>
      </table></td>
</table>