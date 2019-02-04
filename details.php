<?php include("inc/header.php"); ?>
<?php 
	if(isset($_GET['proId']) )
    {
    
        $productId =base64_decode($_GET['proId']);
       // echo $productId;
    }
?>
<?php 
	
	if($_SERVER["REQUEST_METHOD"] == "POST" AND  isset($_POST["submit"]))
    {
        $addCart = $ct->addToCart($_POST);
    }
?>
<?php 
	if(isset($_GET['compid']))
	{
		$cmrId = session::sess_get("cmrId");
		$productId = $_GET['compid'];
		$comReslt =$pro->insertCompateDate($cmrId,$productId);
	}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	
			<?php 
			 	$getPro = $pro->getSingleProduct($productId);
			 	if($getPro)
			 	{
			 		while ($result = $getPro->fetch_assoc() ) 
			 		{
			?>				
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?></h2>
					<p>
						<?php echo $fm->textshort($result['body'],200); ?>
					</p>					
					<div class="price">
						<p>Price: <span>$<?php echo $result['price']; ?></span></p>
						<p>Category: <span><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="hidden" name="productId" value="<?php echo $result['productId']; ?>">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
				<?php 
					if(isset($addCart))
					{
						echo $addCart."<br>";
					}
					if(isset($comReslt))
					{
						echo $comReslt."<br>";
					}
				?>
				 <?php 
					$login = session::sess_get("cmrlogin");
					if($login == TRUE)
					{
				?>
				<div class="add-cart">
					<a class="buysubmit" href="?wlistid=<?php echo $result['productId']; ?>">Save To List</a>			
					<a class="buysubmit" href="?compid=<?php echo $result['productId']; ?>">Add To Compare</a>			
				</div>
				<?php } ?>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p>
				<?php echo $result['body']; ?>
			</p>
	    </div>
		<?php } } ?>		
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
			<?php 
				$getAllCat = $cat->showAllCat();
				if($getAllCat != FALSE)
				{
					while ($catValue = $getAllCat->fetch_assoc()) 
					{
				
			?>			
				      <li><a href="productbycat.php?catId=<?php echo base64_encode($catValue['catId']); ?>">
				      	<?php echo $catValue['catName']; ?>
				      </a></li>
			<?php } } ?>	 
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>

   <?php include("inc/footer.php"); ?>