<?php
  require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

 include 'includes/functions.php';
 include 'includes/Finance.php';
 $finance = new Financials(); 

$func = new Functions();
$activity = "Viewed Expenses";
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
a{cursor:pointer;
}
</style>
<script language="javascript" src="scripts/calendar.js"></script>
<script type="text/javascript" src="js/scriptadd.js"></script> 
<SCRIPT type="text/javascript">


function deleteConfirm(){
	doIt=confirm('You are about to delete this record\n\nDo you wish to proceed?');
	if(doIt){
  return true
	//window.location="deleteEmployee.php?id="+id;//redirect the users to the home page
	}else{
	return false
	}

}
function download(){
	window.location='files.xls';
}

 function searchFunction(str)
    {
    if (str=="")
    {
    document.getElementById("display_Area").innerHTML="";
    return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("display_Area").innerHTML=xmlhttp.responseText;
    }
    }
    xmlhttp.open("GET","getFileDetailsSearch.php?q="+str,true);
    xmlhttp.send();
    }
	
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}

function disableTextBox(obj){
	 
        var selected=document.pays.expensetype.options[obj.selectedIndex].value;
		 if(selected=="Cash" || selected=="select"){
			document.pays.bank.value=""; 
		   document.pays.chqno.value=""; 
		    document.pays.bank.disabled=true; 
		   document.pays.chqno.disabled=true; 
		   }
		   if(selected=="Cheque"){
		   document.pays.bank.value="Bank Name"; 
		   document.pays.chqno.value="Cheque #"; 
		    document.pays.bank.disabled=false; 
		   document.pays.chqno.disabled=false; 
		   }
	}
      
    $(document).ready(function() {
    $("#getvoteheads").change(function() {
	
	var year = $("#year").val();
	var term = $("#term").val();
	var cashbooks = $("#cashbooks").val();
	
	$.ajax({  
    type: "POST",  
    url: "fetch_voteheads.php",  
    data: {"year": year,"term":term,"cashbooks":cashbooks},
    success: function(msg){ 
	var res = msg.split(",");
        
        for(String s : res)
{
     
}
	
	}//close success
	}); //close ajax
	});
});

function showType(){
	var selected=document.getElementById("cashbooks").value;
	if(selected=='parent'){
		document.getElementById('individual').style.display = "block";
		document.getElementById('none').style.display = "none";
	}else if (selected == 'operational'){
		document.getElementById('individual').style.display = "none";
		document.getElementById('none').style.display = "block";
	} else if(selected == 'tuition')

}
        
        

	</script>
</head>
<body>

<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a  href="finance_inventory.php">Receive Purchase Order</a></li>
    <li><a  href="finance_inventory_received.php">Received Purchase Orders</a></li>
    <li><a  class="active" href="expenses.php">Expenses</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  <fieldset>
    <form name="pays" action="AccRecordExpenses.php" method="post">
     <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
      
        <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Expenses
      <div style="float:right; margin-right:20px; width:60%;">
        
      </div></td>
  </tr>
          <td><table width="100%">
              <tr>
                <td><table width="100%">
                    <tr>
                      <td class="alterCell" width="20%">Select Year:</td>
                      <td>
					  <select name="year" class="select">
            <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
          </select>
					  </td>
                      <td class="alterCell" width="20%"> Select Term:</td>
                      <td><select name="term" class="select">
                          <option value="1" >TERM 1 </option>
                          <option value="2" >TERM 2 </option>
                          <option value="3" >TERM 3 </option>
                        </select>
                      </td>
                    </tr>
					<tr>
                      <td class="alterCell" width="20%"> Date Inccurred:</td>
                      <td align="center"><?php
		
                     require_once('classes/tc_calendar.php');
					  $myCalendar = new tc_calendar("date5", true, false);
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
				?>
                      </td>
					 </tr>
					 <tr>
                      <td class="alterCell" width="20%"> Mode:</td>
                      <td><select name="expensetype" class="select" onchange="disableTextBox(this)">
                          <option value="select" >Select Expense Type</option>
                          <option value="Cash" >Cash</option>
                          <option value="Cheque" >Cheque</option>
                        </select>
                      </td>
                      <td><input type="text" name="bank" value="Bank Name" id="inputfields" disabled="disabled"
				 onFocus="if(this.value=='Bank Name'){this.value='';}" 
 				onBlur="if(this.value==''){this.value='Bank Name';}" /></td>
                      <td><input type="text" name="chqno" value="Cheque #" id="inputfields" disabled="disabled"
				 onFocus="if(this.value=='Cheque #'){this.value='';}" 
 					onBlur="if(this.value==''){this.value='Cheque #';}" /></td>
                    </tr>
                    <tr>
                      <td colspan="6"><hr /></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td><table width="100%">
                    <tr>
                      <td class="alterCell" width="20%"> Amount:</td>
                      <td><input type="text" name="amount" class="inputFields" /></td>
                    </tr>
                    <tr>
                      <td class="alterCell" width="20%"> Amount(Words):</td>
                      <td><input type="text" name="words" class="inputFields" /></td>
                    </tr>
                    
                    <tr>
                      <td class="alterCell" width="20%"> Cash Book:</td>
                      <td><select name="cashbooks" class="select" onchange="showType()">
                          <option value="select" >Select Cashbook</option>
                          <option value="parent" >Parents' Cashbook</option>
                          <option value="operational">Operational Cashbook</option>
                          <option value="tuition" >Tuition Cashbook</option>
                          
                        </select>
                      </td>
                    </tr>
                        
                        
                        
                        
                        <tr>
                            <td class="alterCell" width="20%">Debited Account:</td>
                            
                                   <td> <select class="select" name="period" onchange="">
                                        <option value="">--Select Account--</option>
                                        <?php
                                        include('includes/dbconnector.php');
                                        //$query = ("SELECT votehead FROM finance_voteheads where term = '" . $trm . "' AND  YEAR =  '" . $year . "'");

                                        $query = ("SELECT distinct votehead FROM finance_voteheads  ");
                                        $result = mysql_query($query);

                                        while ($row = mysql_fetch_array($result)) {

                                            echo "<OPTION VALUE=" . str_replace(" ", "_", $row['votehead']) . ">" . $row['votehead'] . "</OPTION>";
                                        }
                                        
                                        
                                        $query2 = ("SELECT distinct votehead FROM finance_operationalvoteheads  ");
                                        $result2 = mysql_query($query2);

                                        while ($row2 = mysql_fetch_array($result2)) {

                                            echo "<OPTION VALUE=" . str_replace(" ", "_", $row2['votehead']) . ">" . $row2['votehead'] . "</OPTION>";
                                        }
                                        
                                        
                                        
                                        $query3 = ("SELECT distinct votehead FROM finance_tuitionvoteheads  ");
                                        $result3 = mysql_query($query3);

                                        while ($row3 = mysql_fetch_array($result3)) {

                                            echo "<OPTION VALUE=" . str_replace(" ", "_", $row3['votehead']) . ">" . $row3['votehead'] . "</OPTION>";
                                        }
                                        
                                                                                
                                        ?>
                                    </select>
                                   </td>
                               
                  
                            

                        </tr>
                        
                       
                    <tr>
                      <td class="alterCell" width="20%"> Particulars/<br />
                        Description:</td>
                      <td><textarea name="description" cols="70" rows="3" id="textArea"></textarea></td>
                    </tr>
                    <tr>
                      <td colspan="2"><hr /></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td><table width="100%">
                    <tr>
                      <td class="alterCell" width="20%"> Recepient's Name:</td>
                      <td><input type="text" name="rname" class="inputFields" /></td>
                      <td class="alterCell" width="20%"> Recepient's ID No.:</td>
                      <td><input type="text" name="rid" class="inputFields" /></td>
                    </tr>
                   
                  </table></td>
              </tr>
              
            </table></td>
        </tr>
       
        <tr>
          <td colspan="2" align="center"><input type="submit" class="button_ black" value="Save Expenses" onclick="return validateForm();" />
          </td>
        </tr>
      </table>
    </form>
</fieldset>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
