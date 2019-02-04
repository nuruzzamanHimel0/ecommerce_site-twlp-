<?php 
	
	class Cart{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Formate();
		}
		public function addToCart($data)
		{
			$productId = $this->fm->validation($data['productId']);
			$quantity = $this->fm->validation($data['quantity']);

			$productId = mysqli_real_escape_string($this->db->conn,$productId);
			$quantity = mysqli_real_escape_string($this->db->conn,$quantity);
			$sId = session_id();

			$query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
			$result = $this->db->select($query)->fetch_assoc();

			$productName = mysqli_real_escape_string($this->db->conn,$result['productName']);
			$price = mysqli_real_escape_string($this->db->conn,$result['price']);
			$image = mysqli_real_escape_string($this->db->conn,$result['image']);

			$query = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId' ";
			$result = $this->db->select($query);

			 if($result)
			{
				$msg = "<span style='color:red;font-size:19px;font-weight:bold;'>Product Already Exist !!! </span>";
				return $msg;
			}
			else if($quantity<=0)
			{
				$msg = "<span style='color:red;font-size:19px;font-weight:bold;'>
				Please Give Possitive Quantity in this Product </span>";
				return $msg;
			}
			else{

			 $query = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) VALUES('$sId','$productId','$productName','$price','$quantity','$image') ";
				 // echo $query;
				 $catresult = $this->db->insert($query);
				 if($catresult != FALSE)
				 {
				 	header("Location: cart.php");
				 	exit();
				 }
				 else{
				 	header("Location: 404.php");
				 	exit();
				 }
			}
		}

		public function getCartProduct()
		{
			$sId = session_id();

			$query = "SELECT * FROM tbl_cart WHERE sId= '$sId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateCartQuantity($data)
		{
			$cartId = $this->fm->validation($data['cartId']);
			$quantity = $this->fm->validation($data['quantity']);

			$cartId = mysqli_real_escape_string($this->db->conn,$cartId);
			$quantity = mysqli_real_escape_string($this->db->conn,$quantity);

			if($quantity<1)
			{
				$query = "DELETE FROM tbl_cart WHERE cartId = $cartId ";
				$result = $this->db->delete($query);
				if($result != FALSE)
				 {
				 	header("Location: cart.php");				 
				 }
				 else{
				 	$msg ="<span class='error succerror' >Fail to Cart Delete . </span>";
				 	return $msg;
				 }
			}
			else{
			$query = "UPDATE tbl_cart
							SET 
							quantity = '$quantity'
							WHERE cartId = '$cartId'
			    	";
			    	$udtReslt = $this->db->update($query);
			    	 if($udtReslt != FALSE)
					 {
					 	header("Location: cart.php");
					 }
					 else{
					 	$msg ="<span class='error succerror' >Fail to Cart Update . </span>";
					 	return $msg;
					 }
			}
		}

		public function dltCartById($cartId)
		{
			$query = "DELETE FROM tbl_cart WHERE cartId = $cartId ";
			$result = $this->db->delete($query);
			if($result != FALSE)
				 {
				 	header("Location: cart.php");
				 }
				 else{
				 	$msg ="<span class='error succerror' >Fail to Cart Delete . </span>";
				 	return $msg;
				 }
		}

		public function checkOutCart()
		{
			$sId = session_id();

			$query = "SELECT * FROM tbl_cart WHERE sId= '$sId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function deleteCustomerCart()
		{
			$sId = session_id();

			$query = "DELETE FROM tbl_cart WHERE sId = '$sId' ";
			$result = $this->db->delete($query);
			//return $result;
		}

		public function orderProduct($cmrId)
		{
			$sId = session_id();

			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
			$result = $this->db->select($query);
			if($result != FALSE)
			{
				while ($value = $result->fetch_assoc())
				 {
					$productId = $value['productId'];
					$productName = $value['productName'];
					$price = $value['price'];
					$quantity = $value['quantity'];
					$image = $value['image'];

					$total_price = $price * $quantity;

					$query = "INSERT INTO tbl_order(customerId,productId,productName,price,quantity,image) VALUES('$cmrId','$productId','$productName','$total_price','$quantity','$image') ";
				 // echo $query;
				 $orderResult = $this->db->insert($query);
				}
			}
		}

		public function payableAmount($cmrId)
		{
			$query = "SELECT price FROM tbl_order WHERE customerId= '$cmrId' AND datetime = now() ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getOrderProduct($cmrId)
		{
			$query = "SELECT * FROM tbl_order WHERE customerId= '$cmrId' ORDER BY datetime DESC ";
			$result = $this->db->select($query);
			return $result;
		}

		public function checkOutOrder($cmrId)
		{
			$query = "SELECT * FROM tbl_order WHERE customerId= '$cmrId' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function deleteOrderbyId($id)
		{
			$query = "DELETE FROM tbl_order WHERE id = '$id' ";
			$result = $this->db->delete($query);
			header("Location: orderdetails.php");
			exit();
		}

		public function getAllOrderProduct()
		{
			$query = "SELECT tbl_order.*,tbl_customer.name 
			FROM tbl_order 
			INNER JOIN tbl_customer
			ON tbl_order.customerId = tbl_customer.id 
			ORDER BY tbl_order.datetime DESC
			  ";

			 // $query = " SELECT o.*,c.name 
			 // FROM tbl_order AS o,tbl_customer AS c 
			 // WHERE o.customerId = c.id
			 // ORDER BY o.datetime
			 //  "; 
			$result = $this->db->select($query);
			return $result;
		}

		public function productShifted($id,$price,$datetime)
		{
			$id = mysqli_real_escape_string($this->db->conn,$id);
			$price = mysqli_real_escape_string($this->db->conn,$price);
			$datetime = mysqli_real_escape_string($this->db->conn,$datetime);

			$query = "UPDATE tbl_order
							SET 
							status = '1'
							WHERE id = '$id' AND price ='$price' AND datetime = '$datetime'
			    	";
			    	$udtOrderReslt = $this->db->update($query);
			    	 if($udtOrderReslt != FALSE)
					 {
					 	$msg ="<span class='success succerror' >Shifted Successfully</span>";
					 	return $msg;
					 }
					 else{
					 	$msg ="<span class='error succerror' >Fail to Shift !! </span>";
					 	return $msg;
					 }
		}

		public function productConfirm($id)
		{
			$id = mysqli_real_escape_string($this->db->conn,$id);

			$query = "UPDATE tbl_order
							SET 
							confirm = '1'
							WHERE id = '$id'
			    	";
			    	$udtOrderReslt = $this->db->update($query);
			    	 if($udtOrderReslt != FALSE)
					 {
					 	$msg ="<span class='success succerror' >Confrim Successfully</span>";
					 	return $msg;
					 }
					 else{
					 	$msg ="<span class='error succerror' >Fail to Confirm !! </span>";
					 	return $msg;
					 }
		}

		public function productRemove($id,$price,$datetime)
		{
			$id = mysqli_real_escape_string($this->db->conn,$id);
			$price = mysqli_real_escape_string($this->db->conn,$price);
			$datetime = mysqli_real_escape_string($this->db->conn,$datetime);

			$query = "DELETE FROM tbl_order WHERE id = '$id' AND price = '$price' AND datetime = '$datetime' ";
			$result = $this->db->delete($query);
			    	
			    	 if($result != FALSE)
					 {
					 	$msg ="<span class='success succerror' >Remove Successfully</span>";
					 	return $msg;
					 }
					 else{
					 	$msg ="<span class='error succerror' >Fail to Remove !! </span>";
					 	return $msg;
					 }
		}



	}
?>