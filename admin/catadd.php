<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include("../classes/Catagory.php");?>
<?php $cat = new Catagory();  ?>
<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['save']))
    {
        $catName = $_POST['catName'];
        $insertCat = $cat->catInsert($catName);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
            <?php 
                if(isset($insertCat))
                {
                    echo $insertCat;
                }
            ?>
               <div class="block copyblock"> 
                <?php //if(isset($catadd)){ echo $catadd;} ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." name="catName" class="medium" />
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