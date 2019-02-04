	<div class="header_bottom">
		<div class="header_bottom_left">
	
			<div class="section group">
			
	<?php 
	$resltBrand = "";
	
		$queryBrand = "SELECT * FROM tbl_brand ORDER BY brandId DESC LIMIT 4 ";
		// echo $queryBrand;
		// exit();
		$resltBrand = $db->select($queryBrand);
		if($resltBrand)
		{
			while ($valueBrand = $resltBrand->fetch_assoc())
			 {
			 	$brnadId = $valueBrand["brandId"];
			 	$queryPro = "SELECT * FROM tbl_product WHERE brandId = '$brnadId' ORDER BY productId DESC LIMIt 1 ";
			 	//echo $queryPro;
			 	$resltProduct = $db->select($queryPro);
			 	if($resltProduct)
				{
					$valueProduct = $resltProduct->fetch_assoc();
					 

	?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proId=<?php echo base64_encode($valueProduct['productId']); ?>"> <img src="admin/<?php echo $valueProduct['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $valueBrand['brandName']; ?></h2>
						<p><?php echo $fm->textshort($valueProduct['body'],30);  ?></p>
						<div class="button"><span><a href="details.php?proId=<?php echo base64_encode($valueProduct['productId']); ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
		<?php 
		 }}}
		?>	   		
				
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	