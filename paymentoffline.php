<?php include("inc/header.php"); ?>
<?php 
	$chklogin = Session::sess_get("cmrlogin");
	if($chklogin == FALSE)
	{
		header("Location: login.php");
		exit();
	}
?>
<?php 
		$cartChk = $ct->checkOutCart();
		if($cartChk == FALSE)
		{
			header("Location: index.php");
			exit();
		}
	?>
<style type="text/css">
	.image {
	/* width: 100%; */
	text-align: center;
	background: #fff;
	padding: 0px 0px;
}
	.image img {
	width: 128px;
	border: 2px solid #ddd;
	/* border-radius: 50%; */
	height: 127px;
	background: #f0dbdb;
	padding: 3px;
}
	.tblone {
	width: 516px;
	margin: 0px auto;
	/* text-align: justify; */
	border: 2px solid #ddd;
}
	.tblone tr{}
	.tblone tr td {
	text-align: justify;
	font-size: 19px;
	/* font-weight: none; */
}
.division{width: 50%; float: left;}
.tbltwo {
	float: right;
	text-align: left;
	margin-top: 19px;
	width: 60%;
	margin-right: 5px;
	border: 2px solid #ddd;
	padding: 15px 14px !important;
	/* display: block; */
	height: 100px;
}
.tbltwo tr td {
	text-align: justify;
	font-size: 19px;
	/* font-weight: none; */
	/* margin-left: 5px !important; */
	padding: 7px 11px;
}
.order{}
.order a {
	background: #ff0000;
	color: #fff;
	font-size: 30px;
	padding: 5px 59px;
	margin: 18px auto 1px;
	width: 117px;
	display: block;
	border: 2px solid #ca0000;
	border-radius: 5px;
}
</style>

  <?php 
  		 
    if(isset($_GET['order']) AND $_GET['order'] == "order" )
    {
    	$cmrId = session::sess_get("cmrId");
    	$insertOrder = $ct->orderProduct($cmrId);
    	$dltCart = $ct->deleteCustomerCart();
    	header("Location: success.php");
    }
    ?>	 

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="division">
    				
						<table class="tblone">
							<tr>
								<th width="5%">No</th>
								<th width="30%">Product</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total</th>
							</tr>
					<?php 
						$getPro = $ct->getCartProduct();
						$sum = 0;
							$qty = 0;
						if($getPro != FALSE)
						{	$i = 0;
							
							while ($getCartReslt = $getPro->fetch_assoc()) 
							{
								$i++;
					?>		
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $getCartReslt["productName"]; ?></td>
								<td>$<?php echo $getCartReslt["price"]; ?></td>
								<td><?php echo $getCartReslt["quantity"]; ?></td>
								<td>
									<?php
									$total = $getCartReslt["price"] * $getCartReslt["quantity"];
									 echo $total; 
									 ?>
								</td>
							</tr>
							<?php 

							$sum = $sum+$total;
							$qty = $qty + $getCartReslt["quantity"];
							 ?>
					<?php }}
					 ?>		
						</table>
				

				
						<table class="tbltwo" >
							<tr>
								<td width="40%">Sub Total</td>
								<td width="10%">:</td>
								<td>$<?php echo $sum; ?></td>
							</tr>
							<tr>
								<td>VAT  </td>
								<td>:</td>
								<td>15%($<?php echo $vat = $sum * 0.15; ?>)</td>
							</tr>
							<tr>
								<td>Grand Total </td>
								<td>:</td>
								<td>
									$<?php 
										$vat = $sum * 0.15;
										$grandTotal = $sum + $vat;
										echo $grandTotal;
									?>
								 </td>
							</tr>
							<tr>
								<td>Quantity  </td>
								<td>:</td>
								<td> <?php echo $qty; ?></td>
							</tr>
					   </table>
    		</div>
    		<div class="division">
    			<?php 
		    	$cmrId = session::sess_get("cmrId");
		    	$getCmrReslt = $cmr->getCustomerByid($cmrId);

		    	if($getCmrReslt != FALSE)
		    	{
		    		while ($value = $getCmrReslt->fetch_assoc() ) 
		    		{
		    			if($value['image'] == NULL)
		    			{
		    	?>		
		    		<div class="image">
		    			<img src="images/m.png" alt="Profile Image">
		    		</div>
		    	<?php }else{ ?>
		    		<div class="image">
		    			<img src="<?php echo $value['image'];  ?>" alt="Profile Image">
		    		</div>
		    	<?php } ?>	
						<table class="tblone">
							<tr>
								<td width="20%">Name</td>
								<td width="5%">:</td>
								<td width="40%">
									<?php echo ucwords($value['name']);  ?>
								</td>
							</tr>
							<tr>
								<td>Address</td>
								<td>:</td>
								<td>
									<?php echo ucwords($value['address']);  ?>
								</td>
							</tr>
							<tr>
								<td>City</td>
								<td>:</td>
								<td><?php echo ucwords($value['city']);  ?></td>
							</tr>
							<tr>
								<td>Country</td>
								<td>:</td>
								<td><?php echo ucwords($value['country']);  ?></td>
							</tr>
							<tr>
								<td>Zip-Code</td>
								<td>:</td>
								<td><?php echo ucwords($value['zip']);  ?></td>
							</tr>
							<tr>
								<td>Phone</td>
								<td>:</td>
								<td><?php echo $value['phone'];  ?></td>
							</tr>
							<tr>
								<td>E-mail</td>
								<td>:</td>
								<td><?php echo $value['email'];  ?></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td>
									<a href="editprofile.php">Update Your Profile</a>
								</td>
							</tr>
						</table>
				<?php } } ?>	
    		</div>

    		
 		</div>
 		<div class="order">
    			<a href="?order=order" onclick="return confirm('Are You want to Order Now ??')"> ORDER</a>
    		</div>
 	</div>
	</div>

   <?php include("inc/footer.php"); ?>