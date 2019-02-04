<?php 
	
	class Database{

		public $host = DB_HOST;
		public $user = DB_USER;
		public $pass = DB_PASS;
		public $dbname = DB_NAME;

		public $conn;
		public $error;

		public function __construct()
		{
			$this->connectDB();
		}

		public function connectDB()
		{
			// Database Start.........
			$this->conn = new mysqli($this->host,$this->user,$this->pass,$this->dbname);
			if(!$this->conn)
			{
				echo "DB connection fail".$this->conn->connect_error;
				return false;
			}
		}

		public function select($query)
		{
			$result = $this->conn->query($query) or die($this->conn->error.__LINE__);
			if($result->num_rows > 0)
			{
				return $result;
			}
			else{
				return false;
			}
		}

		public function insert($query)
		{
			$insert_reslt = $this->conn->query($query) or die($this->conn->error.__LINE__);
			if($insert_reslt )
			{
				return $insert_reslt;
			}
			else{
				return false;
			}
		}

		public function update($query)
		{
			$update_reslt = $this->conn->query($query) or die($this->conn->error.__LINE__);
			if($update_reslt )
			{
				return $update_reslt;
			}
			else{
				return false;
			}
		}

		public function delete($query)
		{
			$dlt_reslt = $this->conn->query($query) or die($this->conn->error.__LINE__);
			if($dlt_reslt)
			{
				return $dlt_reslt;
			}
			else{
				return false;
			}
		}


	}
?>