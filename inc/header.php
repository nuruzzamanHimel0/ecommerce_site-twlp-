<?php include("lib/Session.php");?>
<?php 
    Session::sess_start();
    // Session::getLogOut();
?>
<?php include("config/Config.php");?>
<?php include("lib/Database.php");?>
<?php include("helper/Formate.php");?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<?php 
	spl_autoload_register(function($class_name)
	{
		include("classes/".$class_name.".php");
	});
?>
<?php 
	$db = new Database();
	$fm = new Formate();
	$brnd = new Brand();
	$cat = new Catagory();
	$pro = new Product();
	$ct = new Cart();
	$cmr = new Customer();
?>

<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="360; URL='<?php echo $_SERVER['PHP_SELF'] ?>'"  />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>

		<?php 
			if(isset($_GET['action']) && $_GET['action'] == 'logout')
			{
				$cmrId = session::sess_get("cmrId");
				$dltCart = $ct->deleteCustomerCart();
				$dltCompar = $pro->deleteCompare($cmrId);

				session::sess_destroy();
			}
		?>	    
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php 
									$ckCat = $ct->checkOutCart();
									if($ckCat)
									{
										echo Session::sess_get("sum")." | Qry:".Session::sess_get("qty");
									}
									else{
										Session::sess_set("sum",NULL);
										Session::sess_set("qty",NULL);
										echo "(Empty)";
									}
									
									?>
								</span>
							</a>
						</div>
			      </div>

		   <div class="login">
		<?php 
			$sessChk = session::sess_get("cmrlogin");
		if($sessChk == FALSE)
		{
		?>
			<a href="login.php">Login</a>
		<?php
		}else{
		?>
			<a href="?action=logout">LogOut</a>
		<?php	
		}
		?>   	
		   	
		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="topbrands.php">Top Brands</a></li>
	 
	<?php 
		$cartChk = $ct->checkOutCart();
		if($cartChk == TRUE)
		{
	?>
	 <li><a href="cart.php">Cart</a></li> 
	  <li><a href="payment.php">Payment</a></li>
	<?php } ?>
	<?php 
		$cmrId = session::sess_get("cmrId");
		$cartOrder = $ct->checkOutOrder($cmrId);
		if($cartOrder == TRUE)
		{
	?>
	  <li><a href="orderdetails.php">Order</a></li>
	<?php } ?>
	  <?php 
			$login = session::sess_get("cmrlogin");
		if($login == TRUE)
		{
		?>
	  <li><a href="profile.php">Profile</a></li>
	<?php } ?>
	<?php 
		$cmrId = session::sess_get("cmrId");
		$getCmpPro = $pro->getCompareData($cmrId);
		if($getCmpPro != FALSE)
		{
	?>
	<li><a href="compare.php">Compare</a> </li>
	<?php } ?>
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>