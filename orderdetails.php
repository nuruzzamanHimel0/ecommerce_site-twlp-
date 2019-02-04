<?php include("inc/header.php"); ?>
<?php 
	$sessChk = session::sess_get("cmrlogin");
	$confirmChk = 0;
	if($sessChk == FALSE)
	{
		header("Location: login.php");
	}
?>
<?php 
	if(isset($_GET['dltId']) && !empty($_GET['dltId']))
	{
		$id = base64_decode($_GET['dltId']);
		$dltOrder = $ct->deleteOrderbyId($id);
	}
?>
<?php 
	if(isset($_GET['confirmId']) )
	{
		$id = base64_decode($_GET['confirmId']);
		$proConfrm = $ct->productConfirm($id);

	}
?>
<?php 
  // Auto refresh code.....................
	if(!isset($_GET['refresh']))
	{
		echo "<meta http-equiv='refresh' content='5;URL=?refresh=refresh'>";
	}
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="section group">
				<div class="order">
					<h2>Your Order Details:</h2>
				<?php 
            	if(isset($proConfrm))
            	{
            		echo $proConfrm;
            	}
            ?>
					<table class="tblone">
							<tr>
								<th>No</th>
								<th>Product</th>
								<th>Image</th>
								<th>Quantity</th>
								<th>Total Price</th>
								<th>Date</th>
								<th>Status</th>
								<th>Action</th>
							
								<th>Confirm</th>
		
							</tr>
					<?php 
					$cmrId = session::sess_get("cmrId");
						$getOrder = $ct->getOrderProduct($cmrId);
						if($getOrder != FALSE)
						{	$i = 0;
							
							while ($getOrderReslt = $getOrder->fetch_assoc()) 
							{
								$i++;
					?>		
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $getOrderReslt["productName"]; ?></td>
								<td><img src="admin/<?php echo $getOrderReslt["image"]; ?>" alt=""/></td>
								<td>$<?php echo $getOrderReslt["quantity"]; ?></td>
								
								<td>
									<?php
									$total = $getOrderReslt["price"];
									 echo $total; 
									 ?>
								</td>
								<td><?php echo $fm->formatDate($getOrderReslt["datetime"]); ?></td>
								<td>
									<?php 
										if($getOrderReslt["status"] == 0)
										{
											echo "Pending";
										}
										else{
											echo "Shifted";
										}
									?>
										
								</td>
								<td>
									<?php 
										if($getOrderReslt["status"] == 0)
										{
									?>
									<a href="?dltId=<?php echo base64_encode($getOrderReslt['id']); ?>" onclick="return confirm('Are you sure to want to Cancel Order ???')">X</a>
									<?php
									 }
									 else if($getOrderReslt["confirm"] == 1)
										{
											
									?>

									<a href="?dltId=<?php echo base64_encode($getOrderReslt['id']); ?>" onclick="return confirm('Are you sure to want to Cancel Order ???')">X</a>
									<?php		
										}else{
									?>	<a href="?confirmId=<?php echo base64_encode($getOrderReslt['id']); ?>" onclick="return confirm('Are you sure to want to Confirm Your Order ???')">CONFIRM</a> 
									<?php	
									} 
									?>
								</td>
								<td>
									<?php 
										if($getOrderReslt["confirm"] == 0)
										{
											echo "---";
										}
										else{
											echo "<p style='color:green; font-weight:bold;'>CONFIRMED </p>";
										}
									?>
								</td>
								
							</tr>
					<?php }}
					 ?>		
						</table>
				</div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 
<?php include("inc/footer.php"); ?>