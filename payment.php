<?php include("inc/header.php"); ?>
<?php 
	$chklogin = Session::sess_get("cmrlogin");
	if($chklogin == FALSE)
	{
		header("Location: login.php");
		exit();
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
<style type="text/css">
.payment {
	width: 500px;
	border: 2px solid #dddde4;
	margin: 0px auto;
	min-height: 230px;
	text-align: center;
	padding: 47px 44px;
}
.payment h2 {
	border-bottom: 2px solid #ddd;
	padding-bottom: 11px;
	margin-bottom: 86px;
}
.payment a {
	background: #ff0000;
	font-size: 26px;
	color: #fff;
	font-weight: bold;
	padding: 10px 17px;
	margin-right: 10px;
	border-radius: 6px;
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
    		<div class="payment">
    			<h2> Choose Payment option</h2>
    			<a href="paymentoffline.php">Offline Payment</a>
    			<a href="paymentonline.php">Online Payment</a>
    		</div>

    		<div class="back">
    			<a href="cart.php">Previous </a>
    		</div>
 		</div>
 	</div>
	</div>

   <?php include("inc/footer.php"); ?>