<?php include("inc/header.php"); ?>


<?php 
		$cmrId = session::sess_get("cmrId");
		$getCmpPro = $pro->getCompareData($cmrId);
		if($getCmpPro == FALSE)
		{
			header("Location: index.php");
			exit();
		}
	?>
<style type="text/css">
	table.tblone img {
	height: 77px;
	width: 97px;
}
.shopleft, .shopleft {
	float: left;
	text-align: center;
	width: 100%;
	margin-top: 16px;
}
</style>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare</h2>
		
						<table class="tblone">
							<tr>
								<th > No</th>
								<th >Product Name</th>
								<th >Price</th>
								<th >Image</th>
								<th >Action</th>
							</tr>
					<?php 
						$cmrId = session::sess_get("cmrId");
						$getCmpPro = $pro->getCompareData($cmrId);
						
						if($getCmpPro != FALSE)
						{	$i = 0;
							
							while ($value = $getCmpPro->fetch_assoc()) 
							{
								$i++;
					?>		
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $value["productName"]; ?></td>
								<td>$<?php echo $value["price"]; ?></td>
								<td><img src="admin/<?php echo $value["image"]; ?>" alt=""/></td>
								<td>
									<a href="details.php?proId=<?php echo base64_encode($value['productId']); ?>">View</a>
								</td>
							</tr>
					<?php }}
					 ?>		
						</table>
						
					</div>

					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 
<?php include("inc/footer.php"); ?>