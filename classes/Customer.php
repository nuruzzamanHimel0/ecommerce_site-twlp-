<?php 
	
	class Customer{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Formate();
		}

		public function customerRegistration($data,$file)
		{
			$password = substr(md5($data['password']),0,10);

			// echo $password;
			// exit();

			$name = $this->fm->validation($data['name']);
			$city = $this->fm->validation($data['city']);
			$zipCode =$this->fm->validation($data['zipCode']);
			$email = $this->fm->validation($data['email']);
			$address = $this->fm->validation($data['address']);
			$country = $this->fm->validation($data['country']);
			$phone = $this->fm->validation($data['phone']);
			 $password = $this->fm->validation($password);

			$name = mysqli_real_escape_string($this->db->conn,$name);
			$city = mysqli_real_escape_string($this->db->conn,$city);
			$zipCode = mysqli_real_escape_string($this->db->conn,$zipCode);
			$email = mysqli_real_escape_string($this->db->conn,$email);
			$address = mysqli_real_escape_string($this->db->conn,$address);
			$country = mysqli_real_escape_string($this->db->conn,$country);
			$phone = mysqli_real_escape_string($this->db->conn,$phone);
			 $password = mysqli_real_escape_string($this->db->conn,$password);
			//  echo $passwrd;
			// exit();
			$permited = array('jpg','jpeg','png');
			$file_name = $file['image']['name'];
			$tmp_name = $file['image']['tmp_name'];
			$file_size = $file['image']['size'];

			$div = explode(".",$file_name);
			$extension = strtolower(end($div));
			$unique_name = substr(md5(time()),0,10).".".$extension;

			 $uploadImage = "images/customer/$unique_name";
			 // echo $uploadImage;
			 // exit();


			if($name == "" || $city == "" || $zipCode == " " || $email == "" || $address == "" || $country == "" || $phone == ""  || $password == "")
				{
					$msg = "<span class='error'  style='font-size: 20px; font-weight:bold;'> Field Can't Empty.</span>";
					return $msg;
				}
			
	        else if(!empty($file_name))
	            {

				if($file_size>3145728)
	            	{
			            $msg = "<span class='error'  style='font-size: 20px; font-weight:bold;'> Photo size is too high.</span>";
						return $msg;
		            }
		        elseif(in_array($extension , $permited) === FALSE)
		            {
			            $msg =  "<span class='error'  style='font-size: 20px; font-weight:bold;'>You can upload only ".ucwords(implode(" , ",$permited))." </span>";
			            return $msg;
		            }
		        else{
		        		move_uploaded_file($tmp_name,$uploadImage);
	            	$mailQuery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1 ";
					$mailChk = $this->db->select($mailQuery);
					if($mailChk != FALSE)
					{
						$msg = "<span class='error' style='font-size: 20px; font-weight:bold;'> Email Already Exist !!</span>";
						return $msg;
					}
					else{
						$query = "INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,password,image) 
						VALUES('$name','$address','$city','$country','$zipCode','$phone','$email', '$password','$uploadImage' )";
						// echo $query;
						// exit();
		            	$regReslt = $this->db->insert($query);
		            	 if($regReslt != FALSE)
						 {
						 	$msg ="<span class='success style='font-size: 20px; font-weight:bold;'>Register Successfully. </span>";
						 	return $msg;
						 }
						 else{
						 	$msg ="<span class='success'  style='font-size: 20px; font-weight:bold;'> Register Fail. </span>";
						 	return $msg;
						 }
					}
		        }
	            	
	            } //else if(!empty($file_name))
	            else{
	            	$mailQuery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1 ";
					$mailChk = $this->db->select($mailQuery);
					if($mailChk != FALSE)
					{
						$msg = "<span class='error' style='font-size: 20px; font-weight:bold;'> Email Already Exist !!</span>";
						return $msg;
					}
					else{
						$query = "INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,password) 
						VALUES('$name','$address','$city','$country','$zipCode','$phone','$email', ' $password' )";
						// echo $query;
						// exit();
		            	$regReslt = $this->db->insert($query);
		            	 if($regReslt != FALSE)
						 {
						 	$msg ="<span class='success style='font-size: 20px; font-weight:bold;'>Register Successfully. </span>";
						 	return $msg;
						 }
						 else{
						 	$msg ="<span class='success'  style='font-size: 20px; font-weight:bold;'> Register Fail. </span>";
						 	return $msg;
						 }
					}
	            }

		
		}

		public function customerLogin($data)
		{
			$password = substr(md5($data['password']),0,10);

			$email = $data['email'];
			$password = $password;

			$email = mysqli_real_escape_string($this->db->conn,$email);
			$password = mysqli_real_escape_string($this->db->conn,$password);
			// echo $email."<br>";
			// echo $password;
			// exit();

			if(empty($email) || empty($password))
			{
				$msg = "<span class='error'  style='font-size: 20px; font-weight:bold;'> Field Can't Empty.</span>";
				return $msg;
			}
			else{
				// $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password' ";
				$query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password' LIMIT 1 ";
				// echo $query;
				// exit();
				$logReslt = $this->db->select($query);
				if($logReslt != FALSE)
				{
					$logValue = $logReslt->fetch_assoc();
					Session::sess_set("cmrlogin",TRUE);
					Session::sess_set("cmrId",$logValue['id']);
					Session::sess_set("cmrName",$logValue['name']);
					header("Location: index.php");
				}
				else{
					$msg ="<span class='error'  style='font-size: 20px; font-weight:bold;'> Eamil And Password not match!! </span>";
					 	return $msg;
				}

			}
		}

		public function getCustomerByid($id)
		{
			$query = "SELECT * FROM tbl_customer WHERE id='$id' LIMIT 1 ";
			$cmrReslt = $this->db->select($query);
			return $cmrReslt;
		}

		public function customerUpdate($data,$file,$cmrId)
		{
			$name = $this->fm->validation($data['name']);
			$city = $this->fm->validation($data['city']);
			$zip = $this->fm->validation($data['zip']);
			$address = $this->fm->validation($data['address']);
			$country = $this->fm->validation($data['country']);
			$phone = $this->fm->validation($data['phone']);

			$name = mysqli_real_escape_string($this->db->conn,$name);
			$city = mysqli_real_escape_string($this->db->conn,$city);
			$zip = mysqli_real_escape_string($this->db->conn,$zip);
			$address = mysqli_real_escape_string($this->db->conn,$address);
			$country = mysqli_real_escape_string($this->db->conn,$country);
			$phone = mysqli_real_escape_string($this->db->conn,$phone);

			$permited = array('jpg','jpeg','png');
			$file_name = $file['image']['name'];
			$tmp_name = $file['image']['tmp_name'];
			$file_size = $file['image']['size'];

			$div = explode(".",$file_name);
			$extension = strtolower(end($div));
			$unique_name = substr(md5(time()),0,10).".".$extension;

			 $uploadImage = "images/customer/$unique_name";

			 if($name == "" || $city == "" || $zip == " " || $address == "" || $country == "" || $phone == "" )
				{
					$msg = "<span class='error'  style='font-size: 20px; font-weight:bold;'> Field Can't Empty.</span>";
					return $msg;
				}
			else if(!empty($file_name))
	            {

				if($file_size>3145728)
	            	{
			            $msg = "<span class='error'  style='font-size: 20px; font-weight:bold;'> Photo size is too high.</span>";
						return $msg;
		            }
		        elseif(in_array($extension , $permited) === FALSE)
		            {
			            $msg =  "<span class='error'  style='font-size: 20px; font-weight:bold;'>You can upload only ".ucwords(implode(" , ",$permited))." </span>";
			            return $msg;
		            }
		        else{
		        	
		        	$query = "SELECT * FROM tbl_customer WHERE id='$cmrId' LIMIT 1 ";
					$cmrReslt = $this->db->select($query);
					if($cmrReslt)
					{
						$value = $cmrReslt->fetch_assoc();
						if($value['image'] != NULL)
						{
							unlink($value['image']);
						}
					}

		        		move_uploaded_file($tmp_name,$uploadImage);
	            	
		            	$query = "UPDATE tbl_customer
								SET 
								name = '$name',
								address = '$address',
								city = '$city',
								country = '$country',
								zip = '$zip',
								phone = '$phone',
								image = '$uploadImage'
								WHERE id = '$cmrId'
		            	";
		            	$udtRes = $this->db->update($query);
		            	 if($udtRes != FALSE)
						 {
						 	$msg ="<span class='success style='font-size: 20px; font-weight:bold;'>Profile Update Successfully. </span>";
						 	return $msg;
						 }
						 else{
						 	$msg ="<span class='error'  style='font-size: 20px; font-weight:bold;'> Profile Update Fail. </span>";
						 	return $msg;
						 }
					
		        }
	            	
	            } //else if(!empty($file_name))	
	            else{
	            	$query = "UPDATE tbl_customer
								SET 
								name = '$name',
								address = '$address',
								city = '$city',
								country = '$country',
								zip = '$zip',
								phone = '$phone'
								
								WHERE id = '$cmrId'
		            	";
		            	$udtRes = $this->db->update($query);
		            	 if($udtRes != FALSE)
						 {
						 	$msg ="<span class='success style='font-size: 20px; font-weight:bold;'>Profile Update Successfully. </span>";
						 	return $msg;
						 }
						 else{
						 	$msg ="<span class='error'  style='font-size: 20px; font-weight:bold;'> Profile Update Fail. </span>";
						 	return $msg;
						 }
	            }
		}

	}
?>