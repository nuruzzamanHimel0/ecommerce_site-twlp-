<?php include("../lib/Session.php");?>
<?php 
	Session::sess_start();
?>
<?php include("../config/Config.php");?>
<?php include("../lib/Database.php");?>
<?php include("../helper/Formate.php");?>
<?php 
	class AdminLogin{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Formate();
		}

		public function adminLogin($username,$password)
		{
			$username = $this->fm->validation($username);
			$password = $this->fm->validation($password);

			$username = mysqli_real_escape_string($this->db->conn,$username);
			$password = mysqli_real_escape_string($this->db->conn,$password);

			if(empty($username) || empty($password))
			{
				$loginMsg = "Field can't Empty !!!";
				return $loginMsg;
			}
			else{
				$query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password' LIMIT 1 ";
				$result = $this->db->select($query);
				if($result != FALSE)
				{
					$value = $result->fetch_assoc();
					
						Session::sess_set("login",TRUE);
						Session::sess_set("adminId",$value['id']);
						Session::sess_set("name",$value['name']);
						Session::sess_set("username",$value['username']);
						Session::sess_set("role",$value['role']);
						header("Location: index.php");
					
				}else{
					$loginMsg = "Username and Password Not match";
					return $loginMsg;
				}
			}

		}
	}
?>