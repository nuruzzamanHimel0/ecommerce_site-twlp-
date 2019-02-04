<?php include("../classes/AdminLogin.php");?>
<?php Session::getLogIn(); ?>

<?php 
	$al = new AdminLogin();
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$loginChk = $al->adminLogin($username,$password);
	}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Admin Login</h1>
			<span style="font-size: 18px;color:red;">
				<?php 
					if(isset($loginChk))
					{
						echo $loginChk;
					}
				?>
			</span>
			<div>
				<input type="text" placeholder="Username"  name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" name="login" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="https://www.facebook.com/nuruzzaman.himel0">Nuruzzaman Himel</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>