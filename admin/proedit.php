<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include("../classes/Catagory.php"); ?>
<?php include("../classes/Brand.php"); ?>
<?php include("../classes/Product.php"); ?>
<?php 
    $pro = new Product();
    $cat = new Catagory();
    $brnd = new Brand();
    
?>
<?php 
    if(!isset($_GET['proId']) || empty($_GET['proId']))
    {
    echo "<script>window.location='productlist.php'; </script>";
    }
    else{
        $proId = base64_decode($_GET['proId']);
    }
?>
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['update']))
    {
        $udtProduct = $pro->ProductUpdateById($_POST,$_FILES);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">  
           <?php if(isset($udtProduct)){ echo $udtProduct;} ?>     
        <?php 
            $getPro = $pro->getProductById($proId);
            if($getPro)
            {
                while ($result = $getPro->fetch_assoc())
                 {    
        ?>           
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               <input type="hidden" name="productId" value="<?php echo $result["productId"];  ?>">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result["productName"];  ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                     <?php                       
                            $getCat = $cat->showAllCat();
                            if($getCat != FALSE)
                            {
                        ?>      
                        <select id="select" name="catId">
                            <option >Select Category</option>
                        <?php 
                             while($value = $getCat->fetch_assoc())
                            {
                        ?> 
                            <option value="<?php echo $value['catId']; ?>"
                            <?php 
                                if($result["catId"] == $value['catId'] )
                                {
                            ?>
                                selected = "selected"
                            <?php       
                                }
                            ?>
                            >
                                 <?php echo $value['catName']; ?>
                                
                            </option>
                       <?php }} ?> 
                        </select>
                         
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <?php 
                            
                            $getBrnd = $brnd->showAllBrnd();
                            if($getBrnd != FALSE)
                            {
                            
                        ?>   
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                        <?php 
                            while($value = $getBrnd->fetch_assoc())
                                {
                        ?>   
                            <option value="<?php echo $value['brandId']; ?>" 
                            <?php 
                                if($result["brandId"] == $value['brandId'] )
                                {
                            ?>
                                selected = "selected"
                            <?php       
                                }
                            ?>
                             >
                                <?php echo $value['brandName']; ?>
                            </option>
                          <?php }} ?>    
                        </select>
                        
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            <?php echo $result["body"];  ?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        $<input type="text" name="price" value="<?php echo $result["price"];  ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td><img src="<?php echo $result["image"]; ?>" width="90px" height="100px" alt="Product Image"> <br>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                        <?php 
                            if($result["type"] == 0)
                            {
                        ?>
                        <option value="0" selected="selected">Featured</option>
                            <option value="1">General</option>
                        <?php        
                            }else
                            {
                        ?>
                        <option value="0">Featured</option>
                            <option value="1" selected="selected">General</option>
                        <?php        
                            }
                        ?>    
                            
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="update" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php }}?>    
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


