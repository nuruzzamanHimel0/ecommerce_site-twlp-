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
.psuccess {
	width: 500px;
	border: 2px solid #dddde4;
	margin: 0px auto;
	min-height: 230px;
	text-align: center;
	padding: 47px 44px;
}
.psuccess h2 {
	border-bottom: 2px solid #ddd;
	padding-bottom: 11px;
	margin-bottom: 53px;
}
.psuccess p {
	text-align: justify;
	font-size: 18px;
	line-height: 31px;
}
.psuccess p a {
	/* background: #ff0000; */
	font-size: 19px;
	color: #1537f0;
	font-weight: bold;
	font-style: italic;
	text-decoration: underline;
}
.back{}
.back a {
	background: #555;
	color: #fff;
	padding: 10px 18px;
	font-size: 20px;
	border: 1px solid #333;
	margin: 11px auto;
	display: block;
	width: 80px;
	border-radius: 5px;
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
    		$amount = $ct->payableAmount($cmrId);
    		$sum = 0;
    		if($amount)
    		{
    			while ($value = $amount->fetch_assoc()) {
    				$price = $value['price'];
    				$sum = $sum + $price;
    			}
    		}
    	?>	
    		<div class="psuccess">
    			<h2> Success</h2>
    			<p style="color:red;"> Total Payment Amount(Including Vat): 
				$<?php 
				
					$vat = $sum * 0.15;
					$grandTotal = $sum + $vat;
					
						echo $grandTotal;		
				?>
    			</p>
    			<p> Thanks for Purches. Reveive order successfully. We will coutuct to you ASAP with delivery Details. Here is your order details....
					<a href="orderdetails.php">Visit Here</a>
    			</p>
    			
    		</div>

    		<!-- <div class="back">
    			<a href="cart.php">Previous </a>
    		</div> -->
 		</div>
 	</div>
	</div>

   <?php include("inc/footer.php"); ?>