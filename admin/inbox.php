<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include("../classes/Catagory.php"); ?>
<?php include("../classes/Product.php"); ?>
<?php include("../classes/Cart.php"); ?>

<?php 
	$pro = new Product();
    $cat = new Catagory();
    $ct = new Cart();
    $fm = new Formate();
?>
<?php 
	if(!isset($_GET['referesh']))
	{
		echo "<meta http-equiv='refresh' content='5;URL=?referesh=referesh' > ";
	}
?>
	
<?php 
	if(isset($_GET['shiftId']) AND isset($_GET['price']))
	{
		$id = $_GET['shiftId'];
		$price = $_GET['price'];
		$datetime = $_GET['datetime'];

		$proShift = $ct->productShifted($id,$price,$datetime);
	}
?>
<?php 
	if(isset($_GET['removeId']) AND isset($_GET['price']))
	{
		$id = $_GET['removeId'];
		$price = $_GET['price'];
		$datetime = $_GET['datetime'];

		$proRemove = $ct->productRemove($id,$price,$datetime);
	}
?>
<style type="text/css">
	.gradeX td img{width: 65px; height: 65px;}
	.gradeX  td a {color: #285fe3;
	text-decoration: underline;
	font-size: 16px;
	font-style: italic;}
	tr.odd td, tr.even td {
	padding-left: 5px;
	padding-bottom: 14px;
	padding-top: 0px;
	text-align: center;
}
</style>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">  
            <?php 
            	if(isset($proShift))
            	{
            		echo $proShift;
            	}
            	if(isset($proRemove))
            	{
            		echo $proRemove;
            	}
            ?>          
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5px">No</th>
							<th width="25px">Customer Name</th>
							<th width="">Order D & T</th>
							<th>Product Name</th>
							<th width="15px">Image</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Action</th>
							<th>Confirm</th>
						</tr>
					</thead>
					<tbody>
				<?php 
					$getOrder = $ct->getAllOrderProduct();
					if($getOrder != FALSE)
					{ 	
						$i = 0;
						while ($value = $getOrder->fetch_assoc()) {
							$i++;
						
				?>		
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td>
								<a href="customer.php?cmrId=<?php echo base64_encode($value['customerId']); ?>">
									<?php echo ucwords($value['name']); ?>
								</a>
							</td>
							<td><?php echo $fm->formatDate($value['datetime']); ?></td>
							
							<td>
								<a href="product.php?proId=<?php echo base64_encode($value['productId']); ?>">
									<?php echo ucwords($value['productName']); ?>
								</a>
							</td>
							<td>
								<img src="<?php echo $value["image"]; ?>" alt="Order Img"/>
							</td>
							
							<td><?php echo $value['quantity']; ?></td>
							<td><?php echo $value['price']; ?></td>
							<td>
								<a href="customer.php?cmrId=<?php echo base64_encode($value['customerId']); ?>">
									View Customer Details
								</a>
							</td>
							<td>
								<?php 
									if($value['status'] == 0)
									{
								?>
								<a href="?shiftId=<?php echo $value['id']; ?>&price=<?php echo $value['price']; ?>&datetime=<?php echo $value['datetime']; ?>">Shift</a>
							<?php }else{ ?>
								<a href="?removeId=<?php echo $value['id']; ?>&price=<?php echo $value['price']; ?>&datetime=<?php echo $value['datetime']; ?>">Remove</a>
							<?php } ?>	
							</td>
							<td>
								<?php 
									if($value['confirm'] == 0)
									{
										echo "<p style='color:red; font-weight:bold;'>Not Confirmed</p>";
									}else{
										echo "<p style='color:green; font-weight:bold;'>CONFIRMED </p>";
									}	
								?>
							</td>
						</tr>
				<?php } } ?>		

					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
