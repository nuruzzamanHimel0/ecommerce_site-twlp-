<?php include("inc/header.php"); ?>
<?php 
	$chklogin = Session::sess_get("cmrlogin");
	if($chklogin == FALSE)
	{
		header("Location: login.php");
		exit();
	}
?>
<style type="text/css">
	.image {
	/* width: 100%; */
	text-align: center;
	background: #fff;
	padding: 5px 5px;
}
	.image img {
	width: 189px;
	border: 2px solid #ddd;
	border-radius: 50%;
	height: 174px;
}
	.tblone {
	width: 60%;
	margin: 0px auto;
	/* padding: 11px 10px; */
}
	.tblone tr{}
	.tblone tr td input[type="text"] {
	width: 100%;
	padding: 6px 5px;
	font-size: 19px;
}
.tblone tr td button
{
width: 24%;
	height: 35px;
	font-size: 20px;
	background: #684e4e;
	color: #fff;
}

	.tblone tr td {
	text-align: justify;
	font-size: 19px;
	/* font-weight: none; */
}
</style>

  <?php 
  		$cmrId = session::sess_get("cmrId");
    	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['save']))
    	{
    		$custmrUpdt = $cmr->customerUpdate($_POST,$_FILES,$cmrId);
    	}
    ?>	 

 <div class="main">
    <div class="content">
    	<div class="section group">
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
    	<form action="" method="post" enctype="multipart/form-data">
    		
    	
				<table class="tblone">
					<?php 
						if(isset($custmrUpdt))
						{
					?>
					<tr>
						<td colspan="2"><?php echo $custmrUpdt; ?></td>
					</tr>
				<?php } ?>
					<tr>
						<td width="20%">Name</td>
						<td width="40%">
							<input type="text" name="name" value="<?php echo ucwords($value['name']);  ?>">
						</td>
					</tr>
					<tr>
						<td>Address</td>
						
						<td>
							
							<input type="text" name="address" value="<?php echo ucwords($value['address']);  ?>">
						</td>
					</tr>
					<tr>
						<td>City</td>
					
						<td>
							<input type="text" name="city" value="<?php echo ucwords($value['city']);  ?>">
						</td>
					</tr>
					<tr>
						<td>Country</td>
					
						<td>
							<input type="text" name="country" value="<?php echo ucwords($value['country']);  ?>">
						</td>
					</tr>
					<tr>
						<td>Zip-Code</td>
						
						<td>
							<input type="text" name="zip" value="<?php echo ucwords($value['zip']);  ?>">
						</td>
					</tr>
					<tr>
						<td>Phone</td>
					
						<td>
							<input type="text" name="phone" value="<?php echo $value['phone'];  ?>">
						</td>
					</tr>
					<tr>
						<td>E-mail</td>
					
						<td>
							<input type="text" name="email" value="<?php echo $value['email'];  ?>" readonly>
						</td>
					</tr>
					<tr>
						<td>Image</td>
					
						<td>
							<input type="file" name="image" >
						</td>
					</tr>
					<tr>
						<td></td>
						
						<td>
							<!-- <input type="button" name="save" value="Save">
 -->							<button class="grey" name="save"> Save</button>
 								
						</td>
					</tr>
				</table>
				</form>
		<?php } } ?>		
 		</div>
 	</div>
	</div>

   <?php include("inc/footer.php"); ?>