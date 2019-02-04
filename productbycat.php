<?php include("inc/header.php"); ?>
<?php 
	if(!isset($_GET['catId']) || empty($_GET['catId']))
    {
        echo "<script>window.location='404.php'; </script>";
    }
    else{
        //echo "Himel";
        $catId = base64_decode($_GET['catId']);

        // echo $catId;
    }

?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    	<?php 
    		$getCPreslt = $pro->getProductByCatId($catId);
    		if($getCPreslt)
    		{
    			$getVal = $getCPreslt->fetch_assoc();
    			
    	?>	
    		<div class="heading">
    			<h3>Latest from 
    				<span style="color: green;font-weight: bold;font-size: 26px;text-decoration: underline;">
    					<?php echo $getVal['catName']; ?>
    				</span>
    			</h3>
    		</div>
    	<?php  }else{
    		header("Location: 404.php");
    	} ?>	
    		<div class="clear"></div>
    	</div>
   
	      <div class="section group">
	     <?php 
    	
				$getCPreslt = $pro->getProductByCatId($catId);
				if($getCPreslt)
				{
					while ($getVal = $getCPreslt->fetch_assoc()) 
					{
		    ?>	  	
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo base64_encode($getVal['productId']); ?>"><img src="admin/<?php echo $getVal['image']; ?>" alt="" /></a>
					 <h2><?php echo $getVal['productName']; ?> </h2>
					 <p>
					 	<?php  $text = strip_tags($getVal['body']); ?>
					 	<?php echo $fm->textshort($text,40); ?>
					 </p>
					 <p><span class="price">$<?php echo $getVal['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo base64_encode($getVal['productId']); ?>" class="details">Details</a></span></div>
				</div>
		<?php } } ?>		
			</div>

	
	
    </div>
 </div>
</div>
   <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Information</h4>
						<ul>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Customer Service</a></li>
						<li><a href="#"><span>Advanced Search</span></a></li>
						<li><a href="#">Orders and Returns</a></li>
						<li><a href="#"><span>Contact Us</span></a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Why buy from us</h4>
						<ul>
						<li><a href="about.html">About Us</a></li>
						<li><a href="faq.html">Customer Service</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="contact.html"><span>Site Map</span></a></li>
						<li><a href="preview-2.html"><span>Search Terms</span></a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>My account</h4>
						<ul>
							<li><a href="contact.html">Sign In</a></li>
							<li><a href="index.html">View Cart</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">Track My Order</a></li>
							<li><a href="faq.html">Help</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Contact</h4>
						<ul>
							<li><span>+91-123-456789</span></li>
							<li><span>+00-123-000000</span></li>
						</ul>
						<div class="social-icons">
							<h4>Follow Us</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>Compant Name © All rights Reseverd </p>
		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
</body>
</html>

