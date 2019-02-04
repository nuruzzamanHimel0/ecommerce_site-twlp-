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
	.tblone tr td {
	text-align: justify;
	font-size: 19px;
	/* font-weight: none; */
}
</style>

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
	</div>

   <?php include("inc/footer.php"); ?>