
<?php 
	class Catagory 
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Formate();
		}

		public function catInsert($catName)
		{
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->conn,$catName);

			if(empty($catName))
			{
				$msg = "<span class='error' style='position: relative;left: 98px;top: 11px;'> Field Can't Empty.</span>";
				return $msg;
			}
			else{
				 $query = "INSERT INTO tbl_catagory(catName) VALUES('$catName') ";
				 // echo $query;
				 $result = $this->db->insert($query);
				 if($result != FALSE)
				 {
				 	$msg ="<span class='success' style='position: relative;left: 98px;top: 11px; '>Data Insert Successfully. </span>";
				 	return $msg;
				 }
				 else{
				 	$msg ="<span class='success' style='position: relative;left: 98px;top: 11px;'>Fail to Data Insert Successfully. </span>";
				 	return $msg;
				 }
			}
		}

		public function showAllCat()
		{
			$query = "SELECT * FROM tbl_catagory ORDER BY catId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getCatById($catId)
		{
			$query = "SELECT * FROM tbl_catagory WHERE catId= $catId";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateCat($data)
		{
			$catId =  mysqli_real_escape_string($this->db->conn,$data['catId']);
			$catName =$this->fm->validation( $data["catName"]);

			$catName =mysqli_real_escape_string($this->db->conn, $data["catName"]);

			if(empty($catName))
			{
				$msg = "<span class='error' style='position: relative;left: 98px;top: 11px;'> Field Can't Empty.</span>";
				return $msg;
			}
			else
			{
				 $query = "UPDATE tbl_catagory  SET catName = '$catName' WHERE catId= $catId ";
				 // echo $query;
				 $result = $this->db->update($query);
				 if($result != FALSE)
				 {
				 	$msg ="<span class='success' style='position: relative;left: 98px;top: 11px; '>Data Update Successfully. </span>";
				 	return $msg;
				 }
				 else{
				 	$msg ="<span class='success' style='position: relative;left: 98px;top: 11px;'>Fail to Data Update . </span>";
				 	return $msg;
				 }
			}
		}

		public function dltCatById($dltId)
		{
			$query = "DELETE FROM tbl_catagory WHERE catId = $dltId ";
			$result = $this->db->delete($query);
			if($result != FALSE)
				 {
				 	$msg ="<span class='success succerror'>Data Delete Successfully. </span>";
				 	return $msg;
				 }
				 else{
				 	$msg ="<span class='error succerror' >Fail to Data Delete . </span>";
				 	return $msg;
				 }
		}
	}
?>