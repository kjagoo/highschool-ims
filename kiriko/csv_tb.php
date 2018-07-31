<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=TrialBalance-export.xls");

include('includes/dbconnector.php');
include("includes/Accounting.php");
$accounting = new Accounting();
$from=$_GET['from'];
$today=$_GET['to'];
$mainaccount=$_GET['mainaccount'];

$str =str_replace("-","",$from);
		$year1=date('Y', strtotime($str));
	 
		$str2 =str_replace("-","",$today);
		$year2=date('Y', strtotime($str2));
		if($mainaccount=='Parents'){
		$voteheadacct='finance_voteheads';	
		}
		if($mainaccount=='Operations'){
		$voteheadacct='finance_operationalvoteheads';	
		}
		if($mainaccount=='Tution'){
		$voteheadacct='finance_tuitionvoteheads';	
		}
?>
 <table width="100%" border='1'>
   			<thead>
              <tr>
			   <th align="center"><strong>Votehead</strong></th>
			   <th align="center"><strong>LF</strong></th>
			   <th align="center"><strong>Debit</strong></th>
			   <th align="center"><strong>Credit</strong></th>
			   <th align="center"><strong>Balance</strong></th>
			</tr>
			</thead>
			<tbody>
			 
			<!--select operating Banks-->
					<?php
					$totdebit=0;
					$totcredit=0;
					$bankin=0;
					$bankout=0;
					$result = mysql_query("select * from bank_accounts order by bank_name desc");
					while($rowreg = mysql_fetch_array($result)){ 
					
					$bankin=$accounting->getRevenueReceivedBank($from, $today,$rowreg['account_number'],$mainaccount);
					$bankout=$accounting->getExpensesDoneBank($from, $today,$rowreg['account_number'],$mainaccount);
					
					?>
					<tr>
					 <td><?php echo str_replace("_"," ",$rowreg['bank_name'])?></td>
                      <td></td>
						<td align="right"><?php echo number_format($bankin,2)?></td>
						<td align="right"><?php echo number_format($bankout,2)?></td>
						<td align="right"><?php echo number_format($bankin-$bankout,2)?></td>
					</tr>
						<?php
						$totdebit+=$bankin;
						$totcredit+=$bankout;
						//$debitgrandTotals+=($bankin+$bankedfee)-$bankout;
					}
					?>
				   <!--end of banks-->
			<?php
			//get all the available voteheads
			 $num=000;
			
			$result = mysql_query("select distinct(votehead) from $voteheadacct where fiscal_year between '$year1' and '$year2' order by votehead asc");
			 while($row = mysql_fetch_array($result)){
			 $num++;
			?>
			<tr>
			  <td class="alterCell" width="25%"><?php echo str_replace("_"," ",$row['votehead'])?></td>
			   <td align="center"><?php echo sprintf('%02d',$num)?></td>
			   
				<td align="right"><?php echo number_format($accounting->getExpensesDonePerVotehead($from,$today,$row['votehead'],$mainaccount)+$accounting->getPBDoneAccount($from, $today,$row['votehead'],$mainaccount),2);?></td>
				<td class="alterCell" align="right"><?php echo number_format($accounting->getPaidFeeByVotehead($from,$today,$row['votehead'],$mainaccount),2);?></td>
				
				<td align="right"> <?php echo number_format($accounting->getPaidFeeByVotehead($from,$today,$row['votehead'],$mainaccount)-($accounting->getExpensesDonePerVotehead($from,$today,$row['votehead'],$mainaccount)+$accounting->getPBDoneAccount($from, $today,$row['votehead'],$mainaccount)) ,2) ?></td>
			</tr>
			<?php
			
			
			$totcredit+=$accounting->getPaidFeeByVotehead($from,$today,$row['votehead'],$mainaccount);
			$totdebit+=$accounting->getExpensesDonePerVotehead($from,$today,$row['votehead'],$mainaccount)+$accounting->getPBDoneAccount($from, $today,$row['votehead'],$mainaccount);
			
			}
			?>
			<?php
			//get all the available voteheads
			
			
			?>
			<?php
			//get all the available voteheads
			
			?>
			
		<tr>
          <td class="alterCell" width="25%">Other Incomes</td>
		   <td align="center"><?php echo sprintf('%02d',($num+6))?></td>
          <td align="right"></td>
		  <td class="alterCell" align="right"><?php echo number_format($accounting->getPaidFeeByVotehead($from,$today,'Income',$mainaccount),2);?></td>
		   <td align="right"></td>
        </tr>
			</thead>
		<tr>
          <td class="alterCell" width="20%" align='right'>TOTALS</td>
		  <td class="alterCell" align="right"></td>
		  <td class="alterCell" align="right"><?php echo number_format(($totdebit),2)?></td>
		  <td class="alterCell" align="right"><?php echo number_format(($totcredit+$accounting->getPaidFeeByVotehead($from,$today,'Income',$mainaccount)),2)?></td>
		   <td align="right"></td>
        </tr>
			</tbody>
			</table>
			
  </td>
 </tr>
 </table>	