<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

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
<script type="text/javascript">

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

  function validateForm() {

var uname=document.forms["examform"]["outofe"].value;
if (uname==null || uname=="")
  {
  alert("Provide Exam Out Of");
 document.forms["examform"]["outofe"].focus();
  
  return false;
  } 
 }
 function validateFormCats(){
 var sname=document.forms["catsform"]["outof"].value;
  if (sname==null ||sname=="")
  {
  alert("Provide Cats Marks Out Of");
  newpassf="";
  document.forms["catsform"]["outof"].focus();
  return false;
  }
}

function validateMock(){
 var p1=document.forms["mock"]["p1"].value;
 var p2=document.forms["mock"]["p2"].value;
 var p3=document.forms["mock"]["p3"].value;
 var total=document.forms["mock"]["total"].value;
 
  if (p1==null ||p1=="")
  {
  alert("Provide Mock Paper 1 Out Of (0) if the Students Do not Take this Paper");
  newpassf="";
  document.forms["mock"]["p1"].focus();
  return false;
  }
  if (p2==null ||p2=="")
  {
  alert("Provide Mock Paper 2 Out Of (0) if the Students Do not Take this Paper");
  newpassf="";
  document.forms["mock"]["p2"].focus();
  return false;
  }
  if (p3==null ||p3=="")
  {
  alert("Provide Mock Paper 3 Out Of (0) if the Students Do not Take this Paper");
  newpassf="";
  document.forms["mock"]["p3"].focus();
  return false;
  }
  if (total==null ||total=="")
  {
  alert("Provide Totals for this Paper");
  newpassf="";
  document.forms["mock"]["total"].focus();
  return false;
  }
}


   function year() {        
        var newOpt;     
        var i;     
        var selectLength = 0;     
        for(i=2010;i<2050;i++,selectLength ++){     
            newOpt = new Option(i,i);           
            document.catsform.years.options[selectLength ]  = newOpt;  
		}        
    } 
	function yearm() {        
        var newOpt;     
        var i;     
        var selectLength = 0;     
        for(i=2010;i<2050;i++,selectLength ++){     
            newOpt = new Option(i,i);           
			document.mock.yrs.options[selectLength ]  = newOpt;       
		}        
    } 
	function yearms() {        
        var newOpt;     
        var i;     
        var selectLength = 0;     
        for(i=2010;i<2050;i++,selectLength ++){     
            newOpt = new Option(i,i);           
			document.examform.year2.options[selectLength ]  = newOpt;       
		}        
    } 

      
   </script>
</head>
<body onLoad="year(); yearm(); yearms();">

<div id="page_tabs">
  <ul>
    <li><a class="active" href="marks_set.php">Set Marks</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  <table class='borders' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='6'>Marks Setting</td>
        </tr>
      <tr>
        <td valign="top">
		<fieldset>
		<form id="contact-form" action="saveCatOutOf.php" name="catsform" method="post">
			<table width="100%">
            <tr>
              <td valign="top" align="center" colspan="2"><span id="freetext"><u>SET WAT MARKS</u></span></td>
            </tr>
            <tr>
              <td>&nbsp&nbsp;</td>
            </tr>
            <tr>
              <td valign="top"><span id="freetext">Subject</span></td>
              <td><select name="subs" class="select" tabindex="1">
                  <option value="ENGLISH" >101-ENGLISH </option>
                  <option value="KISWAHILI" >102-KISWAHILI</option>
                  <option value="MATH" >121-MATHEMATICS</option>
                  <option value="BIOLOGY" >231-BIOLOGY</option>
                  <option value="PHYSICS" >232-PHYSICS</option>
                  <option value="CHEMISTRY" >233-CHEMISTRY</option>
                  <option value="HISTORY" >311-HISTORY</option>
                  <option value="GEOGRAPHY" >312-GEOGRAPHY</option>
                  <option value="CRE" >313-CRE</option>
				  <option value="HOME" >441-HOME SCIENCE</option>
                  <option value="AGRICULTURE" >443-AGRICULTURE</option>
				  <option value="COMPUTER" >451-COMPUTER</option>
				  <option value="FRENCH">501-FRENCH</option>
                  <option value="BSTUDIES" >565-B/STUDIES</option>
				  
				  
                </select>
              </td>
            </tr>
            <tr>
              <td ><span id="freetext">Form</span></td>
              <td><select name="forms" class="select" tabindex="2">
                  <option value="1" >FORM 1 </option>
                  <option value="2" >FORM 2</option>
                  <option value="3" >FORM 3</option>
                  <option value="4" >FORM 4</option>
                </select>
              </td>
            </tr>
            <tr>
              <td ><span id="freetext">Term</span></td>
              <td><select name="term" class="select" tabindex="3">
                  <option value="1" >TERM 1 </option>
                  <option value="2" >TERM 2</option>
                  <option value="3" >TERM 3</option>
                </select>
              </td>
            </tr>
            <tr>
              <td ><span id="freetext">Year</span></td>
              <td><select name="years" class="select" tabindex="4">
                </select>
              </td>
            </tr>
            <tr>
              <td ><span id="freetext">Exam</span></td>
              <td><select name="cats" class="select" tabindex="5">
                  <option value="1" >Tune-Up </option>
                  <option value="2" >Mid-Term</option>
                </select>
              </td>
            </tr>
            <tr>
              <td ><span id="freetext">OUT OF</span></td>
              <td><input type="text" name="outof" id="inputMarks" class="inputFields" tabindex="6" required autofocus />
              </td>
            </tr>
            <tr>
              <td>&nbsp&nbsp;</td>
              <td valign="middle"><input class="btn btn-primary" type="submit" value="Save WAT Setting" /></td>
          
      </tr>
      <tr>
        <td>&nbsp&nbsp;</td>
      </tr>
    </table>
	</form>
	</fieldset>
    </td>
    <td id="horizontal_line">&nbsp;</td>
    <td valign="top">
	<fieldset>
	<form id="contact-form" action="saveExamOutOf.php" name="examform" method="post">
        <table width="100%">
          <tr>
            <td valign="top" align="center" colspan="2"><span id="freetext"><u>SET EXAM MARKS</u></span></td>
          </tr>
          <tr>
            <td>&nbsp&nbsp;</td>
          </tr>
          <tr>
            <td valign="top"><span id="freetext">Subject</span></td>
            <td><select name="subse" class="select" tabindex="1" >
                <option value="ENGLISH" >101-ENGLISH </option>
                  <option value="KISWAHILI" >102-KISWAHILI</option>
                  <option value="MATH" >121-MATHEMATICS</option>
                  <option value="BIOLOGY" >231-BIOLOGY</option>
                  <option value="PHYSICS" >232-PHYSICS</option>
                  <option value="CHEMISTRY" >233-CHEMISTRY</option>
                  <option value="HISTORY" >311-HISTORY</option>
                  <option value="GEOGRAPHY" >312-GEOGRAPHY</option>
                  <option value="CRE" >313-CRE</option>
				  <option value="HOME" >441-HOME SCIENCE</option>
                  <option value="AGRICULTURE" >443-AGRICULTURE</option>
				  <option value="COMPUTER" >451-COMPUTER</option>
				  <option value="FRENCH">501-FRENCH</option>
                  <option value="BSTUDIES" >565-B/STUDIES</option>
              </select>
            </td>
          </tr>
          <tr>
            <td ><span id="freetext">Form</span></td>
            <td><select name="formse" class="select" tabindex="2">
                <option value="1" >FORM 1 </option>
                <option value="2" >FORM 2</option>
                <option value="3" >FORM 3</option>
                <option value="4" >FORM 4</option>
              </select>
            </td>
          </tr>
          <tr>
            <td ><span id="freetext">Year</span></td>
            <td><select name="year2" class="select" tabindex="3">
              </select>
            </td>
          </tr>
          <tr>
            <td ><span id="freetext">OUT OF</span></td>
            <td><input type="text" name="outofe" id="inputMarks" class="inputFields" tabindex="4" required autofocus />
            </td>
          </tr>
          <tr>
            <td>&nbsp&nbsp;</td>
            <td valign="middle"><input class="btn btn-primary" type="submit" value="Save Exam Setting" /></td>
          </tr>
          <tr>
            <td>&nbsp&nbsp;</td>
          </tr>
        </table>
      </form>
	  </fieldset>
	  </td>
    <td id="horizontal_line">&nbsp;</td>
    <td valign="middle">
	<fieldset>
	<form id="contact-form" action="saveMockOutOf.php" name="mock" method="post">
        <table width="100%">
          <tr>
            <td valign="top" align="center" colspan="2"><span id="freetext"><u>SET MOCK EXAMS OUT</u></span></td>
          </tr>
          <tr>
            <td>&nbsp&nbsp;</td>
          </tr>
          <tr>
            <td ><span id="freetext">Select Year</span></td>
            <td><select name="yrs" class="select" tabindex="1">
              </select>
            </td>
          </tr>
          <tr>
            <td ><span id="freetext">Select Form</span></td>
            <td><select name="formm" class="select" tabindex="2"  >
                <option value="1" >FORM 1 </option>
                <option value="2" >FORM 2</option>
                <option value="3" >FORM 3</option>
                <option value="4" >FORM 4</option>
              </select>
            </td>
          </tr>
          <tr>
            <td ><span id="freetext">Select Term</span></td>
            <td><select name="termm" class="select" tabindex="3">
                <option value="1" >TERM 1 </option>
                <option value="2" >TERM 2</option>
                <option value="3" >TERM 3</option>
              </select>
            </td>
          </tr>
          <tr>
            <td valign="top"><span id="freetext">Subject</span></td>
            <td><select name="subm" class="select" tabindex="4">
                <option value="ENGLISH" >101-ENGLISH </option>
                  <option value="KISWAHILI" >102-KISWAHILI</option>
                  <option value="MATH" >121-MATHEMATICS</option>
                  <option value="BIOLOGY" >231-BIOLOGY</option>
                  <option value="PHYSICS" >232-PHYSICS</option>
                  <option value="CHEMISTRY" >233-CHEMISTRY</option>
                  <option value="HISTORY" >311-HISTORY</option>
                  <option value="GEOGRAPHY" >312-GEOGRAPHY</option>
                  <option value="CRE" >313-CRE</option>
				  <option value="HOME" >441-HOME SCIENCE</option>
                  <option value="AGRICULTURE" >443-AGRICULTURE</option>
				  <option value="COMPUTER" >451-COMPUTER</option>
				  <option value="FRENCH">501-FRENCH</option>
                  <option value="BSTUDIES" >565-B/STUDIES</option>
              </select>
            </td>
          </tr>
          <tr>
            <td ><span id="freetext">Pr 1 Ouf of</span></td>
            <td><input type="text" name="p1" id="inputMarks" class="inputFields" tabindex="5" required autofocus/>
            </td>
          </tr>
          <tr>
            <td ><span id="freetext">Pr 2 Ouf of</span></td>
            <td><input type="text" name="p2" id="inputMarks" class="inputFields" tabindex="6" required autofocus/>
            </td>
          </tr>
          <tr>
            <td ><span id="freetext">Pr 3 Ouf of</span></td>
            <td><input type="text" name="p3" id="inputMarks" class="inputFields" tabindex="7" required autofocus />
            </td>
          </tr>
          <tr>
            <td ><span id="freetext">Total</span></td>
            <td><input type="text" name="total" id="inputMarks" class="inputFields" tabindex="8" required autofocus/>
            </td>
          </tr>
          <tr>
            <td>&nbsp&nbsp;</td>
            <td valign="middle"><input class="btn btn-primary" type="submit" value="Save Mock Setting"/></td>
          </tr>
          <tr>
            <td>&nbsp&nbsp;</td>
          </tr>
        </table>
      </form>
	  </fieldset>
	  </td>
    </tr>
    </table>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
