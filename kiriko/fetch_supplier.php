<?php
	include("includes/dbconnector.php");
	$q = $_GET['q'];
	
	if($q=='New' || $q==""){
	?>
	<div id="txtHint">
 	<table width="100%">
	<tr>
	 <td></td>
	<td><select name="select" id="select"  class="select" required onchange="getSupplierDetails(this.value)">
               <option value="" >-- Select Supplier -- </option>
			     <option value="New" selected="selected" >New Supplier</option>
				  <?php
				 $qry="select * from suppliers";
				$result=mysql_query($qry) ;
				while($row=mysql_fetch_array($result)){
				$supplier=str_replace(" ","_",$row['supplier']); 
				
				?>
				 <option value="<?php echo $supplier?>" ><?php echo str_replace("_"," ",$supplier)?></option>
				 <?php
				 }
				 ?>
				</select></td>
				</tr>
              <tr>
                <td>Supplier:</td>
                <td><input type="text" name="sname" class="inputFields  form-control" required="required" /></td>
				
              </tr>
			  <tr>
                <td>Tax Pin:</td>
                <td><input type="text" name="pin" class="inputFields  form-control" required="required" /></td>
              </tr>
              <tr>
                <td>Address:</td>
                <td><input type="text" name="saddress" class="inputFields  form-control" required="required" /></td>
              </tr>
              <tr>
                <td>Telephone #:</td>
                <td><input type="text"name="stel" class="inputFields  form-control" required="required" /></td>
              </tr>
			  <tr>
                <td>Email Address:</td>
                <td><input type="text"name="semail" class="inputFields  form-control" required="required" /></td>
              </tr>
            </table>
	</div>
	<?php
	}else{
	
	$qry="select * from suppliers where supplier='$q'";
	$result=mysql_query($qry) ;
	while($row=mysql_fetch_array($result)){
	$supplier=$row['supplier']; 
	$pin=$row['pin'];
	$address=$row['address'];
	$telephone=$row['telephone'];
	$email=$row['email'];
	 }
	 ?>
	 	<div id="txtHint">
	 <table width="100%">
              <tr>
                <td>Supplier:</td>
                <td>
				<input type="hidden" name="select" value="-" />
				<select name="sname" id="sname"  class="select" required onchange="getSupplierDetails(this.value)">
				
				<option value="<?php echo $q?>"><?php echo str_replace("_"," ",$q)?> </option>
			     <option value="New" >New Supplier</option>
				  <?php
				 $qry="select * from suppliers";
				$result=mysql_query($qry) ;
				while($row=mysql_fetch_array($result)){
				$supplier=str_replace(" ","_",$row['supplier']); 
				
				?>
				 <option value="<?php echo $supplier?>" ><?php echo str_replace("_"," ",$supplier)?></option>
				 <?php
				 }
				 ?>
				</select>
				
				</td>
              </tr>
			  <tr>
                <td>Tax Pin:</td>
                <td><input type="text" name="pin" class="inputFields  form-control" required="required" value="<?php echo $pin?>" /></td>
              </tr>
              <tr>
                <td>Address:</td>
                <td><input type="text" name="saddress" class="inputFields  form-control" required="required" value="<?php echo $address?>" /></td>
              </tr>
              <tr>
                <td>Telephone #:</td>
                <td><input type="text"name="stel" class="inputFields  form-control" required="required" value="<?php echo $telephone?>"/></td>
              </tr>
			  <tr>
                <td>Email Address:</td>
                <td><input type="text"name="semail" class="inputFields  form-control" required="required" value="<?php echo $email?>"/></td>
              </tr>
            </table>
	 </div>
	 <?php
	
	}
	?>