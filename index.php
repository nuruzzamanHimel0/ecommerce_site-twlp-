<?php include("inc/header.php"); ?>
<?php include("inc/slider.php"); ?>


 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	    <?php 
	    	$getFPro = $pro->getFeturedProduct();
	    	if($getFPro != FALSE)
	    	{
	    		while ($getFreslt = $getFPro->fetch_assoc()) {
	    ?>  	
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo base64_encode($getFreslt['productId']); ?>"><img src="admin/<?php echo $getFreslt['image']; ?>" alt="" /></a>
					 <h2><?php echo $getFreslt['productName']; ?> </h2>
					 <p><?php  $text = strip_tags($getFreslt['body']); ?>
					 	<?php echo $fm->textshort($text,40); ?>
					 </p>
					 <p><span class="price">$<?php echo $getFreslt['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo base64_encode($getFreslt['productId']); ?>" class="details">Details</a></span></div>
				</div>
		<?php } } ?>		
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php 
		    	$getNPro = $pro->getNewProduct();
		    	if($getNPro != FALSE)
		    	{
		    		while ($getNreslt = $getNPro->fetch_assoc()) {
		    ?> 
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo base64_encode($getNreslt['productId']); ?>"><img src="admin/<?php echo $getNreslt['image']; ?>" alt="" /></a>
					  <h2><?php echo $getNreslt['productName']; ?> </h2>

					  <p><span class="price">$<?php echo $getNreslt['price']; ?>
				     <div class="button"><span><a href="details.php?proId=<?php echo base64_encode($getNreslt['productId']); ?>" class="details">Details</a></span></div>
				</div>
			<?php } } ?>
				
				
			</div>
    </div>
 </div>
 <?php include("inc/footer.php"); ?>
