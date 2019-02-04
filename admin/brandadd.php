<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include("../classes/Brand.php");?>
<?php $brnd = new Brand();  ?>
<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['save']))
    {
        $brandName = $_POST['brandName'];
        $insertBrnd = $brnd->brndInsert($brandName);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
            <?php 
                if(isset($insertBrnd))
                {
                    echo $insertBrnd;
                }
            ?>
               <div class="block copyblock"> 
                <?php //if(isset($catadd)){ echo $catadd;} ?>
                 <form action="" method="POST">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Brand Name..." name="brandName" class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="save" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>