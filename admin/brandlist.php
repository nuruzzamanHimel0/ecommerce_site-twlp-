<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include("../classes/Brand.php");?>
<?php $brnd = new Brand();  ?>
<?php
	if(isset($_GET['dltId']) )
	{
		$dltId = base64_decode($_GET['dltId']);
		$dltBrnd =$brnd->dltBrndById($dltId);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block"> 
                	  <?php if(isset($dltBrnd)){ echo $dltBrnd;} ?>
                <?php 
                	$allBrnd = $brnd->showAllBrnd();
                	if($allBrnd != FALSE)
                	{

                ?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$i = 0;
						while($rows = $allBrnd->fetch_assoc())
						{ 
							$i++;
					?>	
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $rows["brandName"]; ?></td>
							<td>
								<a href="brandedit.php?brandId=<?php echo base64_encode($rows['brandId']); ?>">Edit</a> 
								|| 
								<a href="?dltId=<?php echo base64_encode($rows['brandId']); ?>" onclick="return confirm('Are you sure to Delete ??')">Delete</a>
							</td>
						</tr>
					<?php } ?>	
					</tbody>
				</table>
			<?php }else{ ?>
					 <div class='error absolute'> <div class="notexist">Brnad List NOT Exist !!</div></div>
			<?php }?>
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

