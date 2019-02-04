<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include("../classes/Catagory.php"); ?>
<?php 
    $cat = new Catagory();
    if(!isset($_GET['catId']) || empty($_GET['catId']))
    {
        echo "<script>window.location='catlist.php'; </script>";
    }
    else{
        //echo "Himel";
        $catId = base64_decode($_GET['catId']);
        // echo $id;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" AND  isset($_POST["update"]))
    {
        $catUdt = $cat->updateCat($_POST);
    }
    
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
            
               <div class="block copyblock"> 
                <?php if(isset($catUdt)){ echo $catUdt;} ?>

                <?php 
                    $showCat = $cat->getCatById($catId);
                    if($showCat != false)
                    {
                        while($value = $showCat->fetch_assoc())
                        {
                ?>
                 <form action="" method="POST">
                        <table class="form">					
                            <tr>
                            
                                    <input type="hidden" name="catId" value="<?php echo $value['catId'] ?>">
                                
                                <td>
                                    <input type="text" name="catName" class="medium" value="<?php echo $value['catName'] ?>" />
                                </td>
                            </tr>
    						<tr> 
                                <td>
                                    <input type="submit" name="update" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php } }else{
                    echo "<script>window.location='catlist.php'; </script>";
                } ?>    
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>