<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include("../classes/Brand.php"); ?>
<?php 
    $brnd = new Brand();
    if(!isset($_GET['brandId']) || empty($_GET['brandId']))
    {
        echo "<script>window.location='brandlist.php'; </script>";
    }
    else{
        //echo "Himel";
        $brandId = base64_decode($_GET['brandId']);
        // echo $id;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" AND  isset($_POST["update"]))
    {
        $brndUdt = $brnd->updateBrbdById($_POST);
    }
    
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
            
               <div class="block copyblock"> 
                <?php if(isset($brndUdt)){ echo $brndUdt;} ?>

                <?php 
                    $showBrnd = $brnd->getBrndById($brandId);
                    if($showBrnd != false)
                    {
                        while($rows = $showBrnd->fetch_assoc())
                        {
                ?>
                 <form action="" method="POST">
                        <table class="form">                    
                            <tr>
                            
                                    <input type="hidden" name="brandId" value="<?php echo $rows['brandId'] ?>">
                                
                                <td>
                                    <input type="text" name="brandName" class="medium" value="<?php echo $rows['brandName'] ?>" />
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
                    echo "<script>window.location='brandlist.php'; </script>";
                } ?>    
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>