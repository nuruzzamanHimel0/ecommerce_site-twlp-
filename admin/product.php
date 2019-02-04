<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include("../classes/Product.php"); ?>
<?php 
    
    $pro = new Product(); 
?>
<?php 
    if(!isset($_GET['proId']) || empty($_GET['proId']))
    {
    echo "<script>window.location='inbox.php'; </script>";
    }
    else{
        $proId = base64_decode($_GET['proId']);
    }
?>
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['back']))
    {
        echo "<script>window.location='inbox.php'; </script>";
    }
?>
<style type="text/css">
    .form{}
    .form tr{}
    .form tr td {
    font-size: 16px;
    padding: 6px 3px;
}
    .form tr td input[type="text"] {
    font-size: 18px;
    padding: 8px 19px;
    text-transform:uppercase ;
}
table.form input[type="submit"] {
    border: 1px solid #ddd;
    color: #444;
    cursor: pointer;
    font-size: 22px;
    padding: 6px 41px;
    text-transform: uppercase;
    font-weight: bold;
    margin-top: 13px;
}
    .image{}
    .image img {
    height: 174px;
    margin: 6px auto;
    display: block;
    background: #fff;
    border: 2px solid #ddd;
    padding: 5px;
    width: 181px;
}
    
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View Product</h2>
        <div class="block">  
           <?php //if(isset($udtProduct)){ echo $udtProduct;} ?>     
        <?php 
            $viewPro = $pro->viewProductById($proId);
            if($viewPro)
            {
                while ($result = $viewPro->fetch_assoc())
                 {    
        ?>           
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Product Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result["productName"];  ?>" class="medium" readonly="readonly"   />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Catagory Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result["catName"];  ?>" class="medium" readonly="readonly"   />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Brand Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result["brandName"];  ?>" class="medium" readonly="readonly"   />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Details</label>
                    </td>
                    <td>
                        <textarea class="tinymce" cols="60" rows="15">
                            <?php echo $result["body"];  ?>
                        </textarea>
                        <!--  -->
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Image</label>
                    </td>
                    <td>
                       <img src="<?php echo $result["image"]; ?>" width="90px" height="100px" alt="Customer Image">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Type</label>
                    </td>
                    <td>
                        <?php 
                            if($result["type"] == 0)
                            {
                                echo "FEATURE PRODUCT";
                            }
                            else{
                                echo "NEW PRODUCT";
                            }
                        ?>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="back" Value="Back" />
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


