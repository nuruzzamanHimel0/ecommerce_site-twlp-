<?php 
	class Brand{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Formate();
		}


		public function brndInsert($brandName)
		{
			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->conn,$brandName);

			if(empty($brandName))
			{
				$msg = "<span class='error' style='position: relative;left: 98px;top: 11px;'> Field Can't Empty.</span>";
				return $msg;
			}
			else{
				 $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName') ";
				 // echo $query;
				 $result = $this->db->insert($query);
				 if($result != FALSE)
				 {
				 	$msg ="<span class='success' style='position: relative;left: 98px;top: 11px; '>Brnad Insert Successfully. </span>";
				 	return $msg;
				 }
				 else{
				 	$msg ="<span class='success' style='position: relative;left: 98px;top: 11px;'>Fail to Brand Insert. </span>";
				 	return $msg;
				 }
			}
		}

		public function showAllBrnd()
		{
			$query = "SELECT * FROM tbl_brand ORDER BY brandId ASC";
			// echo $query;
			// exit();
			$result = $this->db->select($query);
			return $result;
		}
		public function getBrndById($brandId)
		{
			$query = "SELECT * FROM tbl_brand WHERE brandId= $brandId";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateBrbdById($data)
		{
			$brandId =  mysqli_real_escape_string($this->db->conn,$data['brandId']);
			$brandName =$this->fm->validation( $data["brandName"]);

			$brandName =mysqli_real_escape_string($this->db->conn, $data["brandName"]);

			if(empty($brandName))
			{
				$msg = "<span class='error' style='position: relative;left: 98px;top: 11px;'> Field Can't Empty.</span>";
				return $msg;
			}
			else
			{
				 $query = "UPDATE tbl_brand  SET brandName = '$brandName' WHERE brandId= $brandId ";
				 // echo $query;
				 $result = $this->db->update($query);
				 if($result != FALSE)
				 {
				 	$msg ="<span class='success' style='position: relative;left: 98px;top: 11px; '>Brand Update Successfully. </span>";
				 	return $msg;
				 }
				 else{
				 	$msg ="<span class='success' style='position: relative;left: 98px;top: 11px;'>Fail to Brand Update . </span>";
				 	return $msg;
				 }
			}
		}

		public function dltBrndById($dltId)
		{
			$query = "DELETE FROM tbl_brand WHERE brandId = $dltId ";
			$result = $this->db->delete($query);
			if($result != FALSE)
				 {
				 	$msg ="<span class='success' style='position: relative;left: 320px;top: 11px;border: 3px dashed;padding: 8px 30px; ' font-size:22px; background:#ddd;>Data Delete Successfully. </span>";
				 	return $msg;
				 }
				 else{
				 	$msg ="<span class='error' style='position: relative;left: 320px ;top: 11px;font-size: 24px;border: 3px dashed;padding: 8px 30px;font-size:22px; background:#ddd;'>Fail to Data Delete . </span>";
				 	return $msg;
				 }
		}

	}
?>