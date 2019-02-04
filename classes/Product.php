<?php 
	class Product{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Formate();
		}

		public function ProInsert($data,$file)
		{
			$productName = $this->fm->validation($data['productName']);
			$catId = $this->fm->validation($data['catId']);
			$brandId = $this->fm->validation($data['brandId']);
			$body = $this->fm->validation($data['body']);
			$price = $this->fm->validation($data['price']);
			$type = $this->fm->validation($data['type']);

			$productName = mysqli_real_escape_string($this->db->conn,$productName);
			$catId = mysqli_real_escape_string($this->db->conn,$catId);
			$brandId = mysqli_real_escape_string($this->db->conn,$brandId);
			$body = mysqli_real_escape_string($this->db->conn,$body);
			$price = mysqli_real_escape_string($this->db->conn,$price);
			$type = mysqli_real_escape_string($this->db->conn,$type);

			$permited = array('jpg','jpeg','png','gif');
			$file_name = $file['image']['name'];
			$tmp_name = $file['image']['tmp_name'];
			$file_size = $file['image']['size'];

			$div = explode(".",$file_name);
			$extension = strtolower(end($div));
			$unique_name = substr(md5(time()),0,10).".".$extension;

			$upload_image = "uploads/".$unique_name;

			if($productName == "" || $catId == "" || $brandId == " " || $body == "" || $price == "" || $type == ""  || $file_name = "")
			{
				$msg = "<span class='error' style='position: relative;left: 320px ;top: -18px;font-size: 24px;border: 3px dashed;padding: 8px 30px;font-size:22px; background:#ddd;'> Field Can't Empty.</span>";
				return $msg;
			}
			elseif($file_size>3145728)
            {
            $msg =  "<span class='error' style='position: relative;left: 320px ;top: -18px;font-size: 24px;border: 3px dashed;padding: 8px 30px;font-size:22px; background:#ddd;'><p >Photo Size is High !!</p> </span>";
            return $msg;
            }
            elseif(in_array($extension , $permited) === FALSE)
            {
            $msg =  "<span class='error' style='position: relative;left: 320px ;top: -18px;font-size: 24px;border: 3px dashed;padding: 8px 30px;font-size:22px; background:#ddd;'><p>You can upload only".implode(",",$permited)."</p> </span>";
            return $msg;
            }
            else{
            	move_uploaded_file($tmp_name,$upload_image);
            	$query = "INSERT INTO tbl_product(productName,catId,brandId,body, 	price,image,type) VALUES('$productName','$catId','$brandId','$body','$price','$upload_image','$type')";
            	$proReslt = $this->db->insert($query);
            	 if($proReslt != FALSE)
				 {
				 	$msg ="<span class='success'style='position: relative;left: 320px ;top: -18px;font-size: 24px;border: 3px dashed;padding: 8px 30px;font-size:22px; background:#ddd;'>Product Insert Successfully. </span>";
				 	return $msg;
				 }
				 else{
				 	$msg ="<span class='success' style='position: relative;left: 320px ;top: -18px;font-size: 24px;border: 3px dashed;padding: 8px 30px;font-size:22px; background:#ddd;'>Fail to Product Insert . </span>";
				 	return $msg;
				 }
            }
		}

		public function getAllProduct()
		{
			// $query = "SELECT * FROM tbl_product ORDER BY productId DESC";
			// $result = $this->db->select($query);
			// return $result;

			// $query = "SELECT tbl_product.productName,tbl_catagory.catName,tbl_brand.brandName,tbl_product.body,tbl_product.price,tbl_product.image,tbl_product.type
			// FROM  tbl_product
			// 	INNER JOIN tbl_catagory
			// 		ON tbl_product.catId = tbl_catagory.catId
			// 	INNER JOIN tbl_brand 
			// 		ON tbl_product.brandId =tbl_brand.brandId
			// 			ORDER BY tbl_product.productId DESC";

			// $query = " SELECT tbl_product.*,tbl_catagory.catName,tbl_brand.brandName 
			// FROM  tbl_product 
			// 	INNER JOIN tbl_catagory
			// 	 	ON tbl_product.catId = tbl_catagory.catId 
			// 	INNER JOIN tbl_brand 
			// 		ON tbl_product.brandId = tbl_brand.brandId
			//  			ORDER BY tbl_product.productId DESC";

			$query = "SELECT p.*,c.catName,b.brandName
					FROM tbl_product as p,tbl_catagory as c,tbl_brand as b
					WHERE p.catId = c.catId AND p.brandId = b.brandId
					ORDER BY p.productId DESC 
			";

			$result = $this->db->select($query);
			return $result;	 
		}

		public function getProductById($proId)
		{
			$query = "SELECT * FROM tbl_product WHERE productId= $proId";
			$result = $this->db->select($query);
			return $result;
		}

		public function ProductUpdateById($data,$file)
		{
			$productId = $this->fm->validation($data['productId']);
			$productName = $this->fm->validation($data['productName']);
			$catId = $this->fm->validation($data['catId']);
			$brandId = $this->fm->validation($data['brandId']);
			$body = $this->fm->validation($data['body']);
			$price = $this->fm->validation($data['price']);
			$type = $this->fm->validation($data['type']);

			$productId = mysqli_real_escape_string($this->db->conn,$productId);
			$productName = mysqli_real_escape_string($this->db->conn,$productName);
			$catId = mysqli_real_escape_string($this->db->conn,$catId);
			$brandId = mysqli_real_escape_string($this->db->conn,$brandId);
			$body = mysqli_real_escape_string($this->db->conn,$body);
			$price = mysqli_real_escape_string($this->db->conn,$price);
			$type = mysqli_real_escape_string($this->db->conn,$type);

			$permited = array('jpg','jpeg','png','gif');
			$file_name = $file['image']['name'];
			$tmp_name = $file['image']['tmp_name'];
			$file_size = $file['image']['size'];

			//return $file_name;


			$div = explode(".",$file_name);
			$extension = strtolower(end($div));
			$unique_name = substr(md5(time()),0,10).".".$extension;

			$upload_image = "uploads/".$unique_name;

			if($productName == "" || $catId == "" || $brandId == " " || $body == "" || $price == "" || $type == "")
			{
				$msg = "<span class='error succerror' > Field Can't Empty.</span>";
				return $msg;
			}
			else{
				if(!empty($file_name))
				{
					if($file_size>3145728)
		            {
		            $msg =  "<span class='error succerror' ><p >Photo Size is High !!</p> </span>";
		            return $msg;
		            }
		            elseif(in_array($extension , $permited) === FALSE)
		            {
		            $msg =  "<span class='error succerror' <p>You can upload only".implode(",",$permited)."</p> </span>";
		            return $msg;
		            }
		            else{
		            	$query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
		            	$result = $this->db->select($query);
		            	while ($values = $result->fetch_assoc()) {
		            		unlink($values['image']);
		            	}
		            	move_uploaded_file($tmp_name,$upload_image);
		            	
		            	$query = "UPDATE tbl_product
								SET 
								productName = '$productName',
								catId = '$catId',
								brandId = '$brandId',
								body = '$body',
								price = '$price',
								image = '$upload_image',
								type = '$type'
								WHERE productId = '$productId'
		            	";
		            	$proReslt = $this->db->update($query);
		            	 if($proReslt != FALSE)
						 {
						 	$msg ="<span class='success succerror'>Product Update Successfully. </span>";
						 	return $msg;
						 }
						 else{
						 	$msg ="<span class='error succerror' >Fail to Product Update . </span>";
						 	return $msg;
						 }
						}
			} //............. if end................
			else{
					$query = "UPDATE tbl_product
								SET 
								productName = '$productName',
								catId = '$catId',
								brandId = '$brandId',
								body = '$body',
								price = '$price',
								type = '$type'
								WHERE productId = '$productId'
		            	";
		            	$proReslt = $this->db->update($query);
		            	 if($proReslt != FALSE)
						 {
						 	$msg ="<span class='success succerror'>Product Update Successfully . </span>";
						 	return $msg;
						 }
						 else{
						 	$msg ="<span class='error succerror'>Fail to Product Update . </span>";
						 	return $msg;
						 }
			} //else end......

		} // main else end.....
	}

	public function dltProductById($productId)
	{
		$query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
            	$result = $this->db->select($query);
            	while ($values = $result->fetch_assoc()) {
            		unlink($values['image']);
            	}
        $dltquery = "DELETE FROM tbl_product WHERE productId = '$productId'";
        $dltresult = $this->db->delete($dltquery);
        if($dltresult != FALSE)
			 {
			 	$msg ="<span class='success succerror'>Product Delete Successfully . </span>";
			 	return $msg;
			 }
			 else{
			 	$msg ="<span class='error succerror'>Fail to Product Delete . </span>";
			 	return $msg;
			 }

	}

	public function getFeturedProduct()
	{
			$query = "SELECT * FROM tbl_product WHERE type= '0' ORDER BY productId DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
	}
	public function getNewProduct()
	{
			$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
	}

	public function getSingleProduct($productId)
	{
		$query = "SELECT tbl_product.*,tbl_catagory.catName, tbl_brand.brandName
				FROM tbl_product 
				INNER JOIN tbl_catagory 
				ON tbl_product.catId = tbl_catagory.catId 
					AND  tbl_product.productId = '$productId'
				INNER JOIN tbl_brand 
				ON tbl_product.brandId = tbl_brand.brandId
					AND  tbl_product.productId = '$productId'
				";
				

		// $query = "SELECT p.*,c.catName,b.brandName
		// 			FROM tbl_product as p,tbl_catagory as c,tbl_brand as b
		// 			WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$productId'
		// 	";
		$result = $this->db->select($query);
		return $result;
	}

	public function getProductByCatId($catId)
	{
		$query = "SELECT tbl_catagory.catName,tbl_product.*
				FROM tbl_catagory
				INNER JOIN tbl_product
				ON tbl_catagory.catId = tbl_product.catId
					 AND tbl_catagory.catId = '$catId'
					 	ORDER BY tbl_product.productId ASC
		";
		$result = $this->db->select($query);
			return $result;
	}

	public function viewProductById($proId)
	{
		$query = "
			SELECT tbl_product.*,tbl_brand.brandName,tbl_catagory.catName 
			FROM tbl_product 
			INNER JOIN tbl_brand 
			ON tbl_product.brandId =  tbl_brand.brandId AND tbl_product.productId ='$proId'
			INNER JOIN  tbl_catagory 
			ON tbl_product.catId =  tbl_catagory.catId AND tbl_product.productId ='$proId' 
		";
		$result = $this->db->select($query);
			return $result;
	}

	public function insertCompateDate($cmrId,$productId)
	{
		$cmrId = mysqli_real_escape_string($this->db->conn,$cmrId);
		$productId = mysqli_real_escape_string($this->db->conn,$productId);

		$cquery = "SELECT * FROM tbl_compare WHERE productId = '$productId' AND cmrId = '$cmrId' ";
			$cresult = $this->db->select($cquery);
			if($cresult != FALSE)
			{
				$msg ="<span class='error' style='color:red;font-size:19px;font-weight:bold;'>Product Already Added </span>";
				 	return $msg;
			}
			else{
				$query = "SELECT * FROM tbl_product WHERE productId = '$productId' LIMIT 1 ";
			$result = $this->db->select($query);
			if($result != FALSE)
			{
				$value = $result->fetch_assoc();
				$productName = $value['productName'];
				$price = $value['price'];
				$image = $value['image'];

				$query = "INSERT INTO tbl_compare(cmrId,productId, 	productName,price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
            	$compReslt = $this->db->insert($query);
            	 if($compReslt != FALSE)
				 {
				 	$msg ="<span class='success' style='font-size:19px;font-weight:bold;'>Add to compare </span>";
				 	return $msg;
				 }
				 else{
				 	$msg ="<span class='error' style='color:red;font-size:19px;font-weight:bold;'>Fail to Add. </span>";
				 	return $msg;
				 }
			}
			}
	}

	public function getCompareData($cmrId)
	{
		$query = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' ORDER BY id DESC ";
			$result = $this->db->select($query);
			return $result;
	}

	public function deleteCompare($cmrId)
	{
		$dltquery = "DELETE FROM tbl_compare WHERE cmrId = '$cmrId'";
        $dltresult = $this->db->delete($dltquery);
	}
}
?>