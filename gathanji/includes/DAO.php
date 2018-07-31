<?php
include('dbconnector.php');
class DAO{

function DAO() {
}
 var $form;
 
 function getBalance($admno,$form,$term,$year){
 /*$result = mysql_query("SELECT * FROM balances WHERE admno='".$admno."' and form='".$form."' and term='".$term."' and year='".$year."'");
 $bal=0;
 while ($row = mysql_fetch_array($result)) {
 $bal=$row['balance'];
 }*/
$bal=(($this->getPayable($form,$term,$year))-($this->getPayment($admno,$term,$year)) );
    return ($bal);
   }
   
   
   function getPayment($admno,$term,$year){
 $result = mysql_query("SELECT sum(amount) as paid FROM feestructures WHERE admno='".$admno."' and term='".$term."' and year='".$year."'");
 $paid=0;
 while ($row = mysql_fetch_array($result)) {
 $paid=$row['paid'];
 }
    return ($paid);
   }
   
   
   function getPayable($form,$term,$year){
 $result = mysql_query("SELECT payable FROM fees WHERE form='".$form."' and term='".$term."' and year='".$year."'");
 $payable=0;
 while ($row = mysql_fetch_array($result)) {
 $payable=$row['payable'];
 }
    return ($payable);
   }
   
   function getGeneralPayable($year){
 $result = mysql_query("SELECT sum(payable) as payable FROM fees WHERE  year='".$year."'");
 $payable=0;
 while ($row = mysql_fetch_array($result)) {
 $payable=$row['payable'];
 }
    return ($payable);
   }
   function getGeneralPaid($year){
 $result = mysql_query("SELECT sum(amount) as paid FROM feestructures WHERE  year='".$year."'");
 $paid=0;
 while ($row = mysql_fetch_array($result)) {
 $paid=$row['paid'];
 }
    return ($paid);
   }
   
   
  function getCurrentYears(){
	 $result = mysql_query("SELECT year FROM current_op");
	 $year="";
		 while ($row = mysql_fetch_array($result)) {
		 $year=$row['year'];
		}
	
	$gets = new Currents();
	$gets->setCurrentYear($year);
	return $gets->getCurrentYear();
   }
  function getCurrentTerm(){
	 $result = mysql_query("SELECT term FROM current_op");
	 $term="";
		 while ($row = mysql_fetch_array($result)) {
		 $term=$row['term'];
		}
	
	$gets = new Currents();
	$gets->setCurrentTerm($term);
	return $gets->getCurrentTerm();
   }
   
   
 //////// FUNCTION FOR LIBRARY MODULES ////////////////
   
  function getBooksIssued($bookid){
 $result = mysql_query("SELECT count(bookid) as issuedbooks FROM issued_books WHERE  bookid='".$bookid."'");
 	$issuedbooks=0;
	 while ($row = mysql_fetch_array($result)) {
 		$issuedbooks=$row['issuedbooks'];
	 }
    return ($issuedbooks);
   }
   
    function getBooksInventoty(){
 $result = mysql_query("select count(bookid) as total from books_invemtory");
 	$tbooks=0;
	 while ($row = mysql_fetch_array($result)) {
 		$tbooks=$row['total'];
	 }
    return ($tbooks);
   }
   function getBooksQty(){
 $result = mysql_query("select sum(noofpcs) as total from books_invemtory");
 	$tbooks=0;
	 while ($row = mysql_fetch_array($result)) {
 		$tbooks=$row['total'];
	 }
    return ($tbooks);
   }
    function getBooksIssuedOut(){
 $result = mysql_query("select count(bookid) as total from issued_books");
 	$tbooks=0;
	 while ($row = mysql_fetch_array($result)) {
 		$tbooks=$row['total'];
	 }
    return ($tbooks);
   }
    function getLostBooks(){
 $result = mysql_query("select count(bookid) as total from lib_lost_books");
 	$tbooks=0;
	 while ($row = mysql_fetch_array($result)) {
 		$tbooks=$row['total'];
	 }
    return ($tbooks);
   }
   
function getIssuedBooks($admno){
 $result = mysql_query("SELECT count(userid) as books FROM issued_books WHERE  userid='".$admno."'");
 	$ibooks=0;
	 while ($row = mysql_fetch_array($result)) {
 		$ibooks=$row['books'];
	 }
    return ($ibooks);
   }
   
    function getBooksByCategory($category){
 $result = mysql_query("select count(bookid) as total from books_invemtory where category='$category'");
 	$tbooks=0;
	 while ($row = mysql_fetch_array($result)) {
 		$tbooks=$row['total'];
	 }
    return ($tbooks);
   }
  
 /*
 *Get the number of books lost by a student
 * denie leaving certificate
 */
  function getStudentLostBooks($admno){
 $result = mysql_query("select count(bookid) as total from lib_lost_books where userid='$admno'");
 	$tbooks=0;
	 while ($row = mysql_fetch_array($result)) {
 		$tbooks=$row['total'];
	 }
    return ($tbooks);
   }
   

   
   
   
   
   
}// end of class DAO
class Currents {
    var $yearis;
	var $termis;
     
    function getCurrentYear(){
        return $this->yearis;
    }
     
   function setCurrentYear($yr) {
        $this->yearis = $yr;
    }
	function getCurrentTerm(){
        return $this->termis;
    }
     
    function setCurrentTerm($trm) {
        $this->termis = $trm;
    }
}
?>
