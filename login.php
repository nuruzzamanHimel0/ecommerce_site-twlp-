<?php include("inc/header.php"); ?>
<?php 
	$sessChk = session::sess_get("cmrlogin");
	if($sessChk == TRUE)
	{
		header("Location: order.php");
	}
?>
<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['login']))
	{
		$custmrlog = $cmr->customerLogin($_POST);
	}
?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Log In</h3>
        	<?php 
        		if(isset($custmrlog))
        		{
        			echo $custmrlog;
        		}else{
        			echo "<p>Sign in with the form below.</p>";
        		}
        	?>
        	
        	<form action="" method="post" id="member">
                	<input name="email" type="email" placeholder="E-mail" >
                    <input name="password" type="password" placeholder="Password" >
                      <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
            </form>
                 
                  
        </div>
    <?php 
    	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['register']))
    	{
    		$custmrReg = $cmr->customerRegistration($_POST,$_FILES);
    	}
    ?>	                
    	<div class="register_account">
    		<h3>Register New Account</h3>

    	
    <?php if(isset($custmrReg)){echo $custmrReg;} ?>

    		<form action="" method="post" enctype="multipart/form-data">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zipCode" placeholder="Zip-Code">
							</div>
							<div>
								<input type="email" name="email" placeholder="E-mail">
							</div>
							<div>
							 Image: <input type="file" name="image" >
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		<div>
						<input type="text" name="country" placeholder="Country">
				 	</div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Phone">
		          </div>
				  
				  <div>
					<input type="password" name="password" placeholder="Password">
				</div>
				
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		   
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php include("inc/footer.php"); ?>
