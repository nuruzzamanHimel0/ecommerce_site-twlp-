<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include("../classes/Catagory.php"); ?>
<?php 
	$cat = new Catagory();
	if(isset($_GET['dltId']) )
	{
		$dltId = base64_decode($_GET['dltId']);
		$dltCat =$cat->dltCatById($dltId);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block"> 
                	  <?php if(isset($dltCat)){ echo $dltCat;} ?>
                <?php 
                	$allCat = $cat->showAllCat();
                	if( $allCat != FALSE)
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
						while($values = $allCat->fetch_assoc())
						{ 
							$i++;
					?>	
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $values['catName']; ?></td>
							<td>
								<a href="catedit.php?catId=<?php echo base64_encode($values['catId']); ?>">Edit</a> 
								|| 
								<a href="?dltId=<?php echo base64_encode($values['catId']); ?>" onclick="return confirm('Are you sure ??')">Delete</a>
							</td>
						</tr>
					<?php } ?>	
					</tbody>
				</table>
			<?php }else{ ?>
					 <div class='error absolute'> <div class="notexist">Catagory List NOT Exist !!</div></div>
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

