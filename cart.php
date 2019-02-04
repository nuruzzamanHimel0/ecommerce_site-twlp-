<?php include("inc/header.php"); ?>
<?php 
	
	if($_SERVER["REQUEST_METHOD"] == "POST" AND  isset($_POST["update"]))
    {
        $udtCart = $ct->updateCartQuantity($_POST);
    }
?>
<?php 
	if(isset($_GET['dltId']) )
	{
		$cartId = base64_decode($_GET['dltId']);
		$dltCart =$ct->dltCartById($cartId);
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

<?php 
	if(!isset($_GET['id']))
	{
		echo "<meta http-equiv='refresh' content='0;URL=?id=himel' > ";
	}
?>	
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    <?php 
			    	if(isset($udtCart))
			    	{
			    		echo $udtCart;
			    	}
			    ?>
			     <?php 
			    	if(isset($dltCart))
			    	{
			    		echo $dltCart;
			    	}
			    ?>	

				<?php 
					$ckCat = $ct->checkOutCart();
					if($ckCat != FALSE)
					{
				?>		
						<table class="tblone">
							<tr>
								<th width="5%">Serial No</th>
								<th width="30%">Product Name</th>
								<th width="20%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
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
								<td><img src="admin/<?php echo $getCartReslt["image"]; ?>" alt=""/></td>
								<td>$<?php echo $getCartReslt["price"]; ?></td>
								<td>
				<form action="" method="post">
					<input type="hidden" name="cartId" value="<?php echo $getCartReslt["cartId"]; ?>">
					<input type="number" name="quantity" value="<?php echo $getCartReslt["quantity"]; ?>"/>
					<input type="submit" name="update" value="Update"/>
				</form>
								</td>
								<td>
									<?php
									$total = $getCartReslt["price"] * $getCartReslt["quantity"];
									 echo $total; 
									 ?>
								</td>
								<td>
									<a href="?dltId=<?php echo base64_encode($getCartReslt['cartId']); ?>" onclick="return confirm('Are you sure to want to Delete ???')">X</a>
								</td>
							</tr>
							<?php 

							$sum = $sum+$total;
							$qty = $qty + $getCartReslt["quantity"];
							Session::sess_set("sum","$sum");
							Session::sess_set("qty","$qty");
							 ?>
					<?php }}
					 ?>		
						</table>
				<?php }
				else{
						echo "<p style='color: red;font-size: 34px;text-align: center;font-weight: bold;'>Cart Not Found !! <a href='index.php' style='font-size: 24px;color: green;font-weight: bold;font-style: italic;'>Continue Shopping.....</a> </p>";
					}  ?>		
					<?php 
						$ckCat = $ct->checkOutCart();
						if($ckCat)
						{
					?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$<?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>15%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									$<?php 
										$vat = $sum * 0.15;
										$grandTotal = $sum + $vat;
										echo $grandTotal;
									?>
								 </td>
							</tr>
					   </table>
					<?php 
				}?>
					</div>

					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<?php 
							$cartChk = $ct->checkOutCart();
							if($cartChk == TRUE)
							{
						?>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					<?php } ?>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 
<?php include("inc/footer.php"); ?>