<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include("../classes/Product.php"); ?>
<?php 
	$pro = new Product();
	$fm = new Formate();
	if(isset($_GET['dltId']) )
	{
		$productId = $_GET['dltId'];
		$dltPro = $pro->dltProductById($productId);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block"> 
        <?php if(isset($dltPro)){ echo $dltPro;} ?> 
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$getPro = $pro->getAllProduct();
				if($getPro != FALSE)
				{
					while ($getrows = $getPro->fetch_assoc()) 
					{
			?>	
				<tr class="odd gradeX resize ">
					<td><?php echo $getrows["productName"]; ?></td>
					<td><?php echo $getrows['catName']; ?></td>
					<td><?php echo $getrows['brandName']; ?></td>
					<td class="center"> <?php echo $fm->textshort($getrows["body"],50); ?></td>
					<td class="center">$<?php echo $getrows["price"]; ?></td>
					<td class="center"> 
						<img src="<?php echo $getrows["image"]; ?>" width="50px" height="100px" alt="Product Image">
					</td>
					<td class="center"> 
						<?php 
							if($getrows["type"] == 0)
							{
								echo "Featured";
							}
							else{
								echo "General";
							}
						?>
					</td>
					<td>
						<a href="proedit.php?proId=<?php echo base64_encode($getrows['productId']); ?>">Edit</a> 
						|| 
						<a href="?dltId=<?php echo $getrows['productId']; ?>" onclick="return confirm('Are you sure ??')">Delete</a>
					</td>
				</tr>
			<?php }}?>
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
