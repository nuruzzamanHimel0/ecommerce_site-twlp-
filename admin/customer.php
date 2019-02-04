<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include("../classes/Customer.php"); ?>
<?php 
    
    $cmr = new Customer(); 
?>
<?php 
    if(!isset($_GET['cmrId']) || empty($_GET['cmrId']))
    {
    echo "<script>window.location='inbox.php'; </script>";
    }
    else{
        $cmrId = base64_decode($_GET['cmrId']);
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
        <h2>View Customer Details </h2>
        <div class="block">  
           <?php //if(isset($udtProduct)){ echo $udtProduct;} ?>     
        <?php 
            $getCmr = $cmr->getCustomerByid($cmrId);
            if($getCmr)
            {
                while ($result = $getCmr->fetch_assoc())
                 {    
        ?>           
        <div class="image">
            <img src="../<?php echo $result["image"]; ?>" width="90px" height="100px" alt="Customer Image"> 
        </div>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result["name"];  ?>" class="medium" readonly="readonly"   />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result["address"];  ?>" class="medium" readonly="readonly"   />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>City</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result["city"];  ?>" class="medium" readonly="readonly"   />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Country</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result["country"];  ?>" class="medium" readonly="readonly"   />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Zip-Code</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result["zip"];  ?>" class="medium" readonly="readonly"   />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone No</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result["phone"];  ?>" class="medium" readonly="readonly"   />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result["email"];  ?>" class="medium" readonly="readonly"   />
                    </td>
                </tr>
				 
				
            
               <!--  <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td><img src="<?php //echo $result["image"]; ?>" width="90px" height="100px" alt="Product Image"> <br>
                        <input type="file" name="image" />
                    </td>
                </tr> -->
				
				

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


