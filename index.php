<?php
	class fci{
		private $conn;
		public function __construct($host,$user,$pass,$db){
			$this->conn=new mysqli($host,$user,$pass,$db);
			if($this->conn->connect_errno>0){
				die("connect faild".$this->conn->connect_errno);
			}
		}
		public function getAll($table,$cols){
			$sql="SELECT $cols FROM $table";
			$result=$this->conn->query($sql);
			if($result->num_rows>0){
				return $result->fetch_all(MYSQLI_ASSOC);
			}
			return false;
		}
		public function getById($table,$cols,$condition){
			$sql="SELECT $cols FROM $table WHERE $condition";
			$result=$this->conn->query($sql);
			if($result->num_rows>0){
				return $result->fetch_assoc();
			}
			return false;
		}
		public function getallById($table,$cols,$condition){
			$sql="SELECT $cols FROM $table WHERE $condition";
			$result=$this->conn->query($sql);
			if($result->num_rows>0){
				return $result->fetch_all(MYSQLI_ASSOC);
			}
			return false;
		}
		public function insert($table,$cols){
			$sql="INSERT INTO $table SET $cols";
			$result=$this->conn->query($sql);
			if ($this->conn->affected_rows>0) {
				return true;
			}
			return false;
		}
		public function update($table,$cols,$condition){
			$sql="UPDATE  $table SET $cols WHERE $condition";
			$result=$this->conn->query($sql);
			if ($this->conn->affected_rows>0) {
				return true;
			}
			return false;
		}
		public function delete($table,$condition){
			$sql="DELETE  FROM $table WHERE $condition";
			$result=$this->conn->query($sql);
			if ($this->conn->affected_rows>0) {
				return true;
			}
			return false;
		}
	}



	$obj=new fci("localhost","root","","feroz");
	if ($obj->getAll("students","*")!=false) {
		echo "<pre>";
		print_r($obj->getAll("students","*"));
	}


	if ($obj->getById("students","*","id=1")!=false) {
		echo "<pre>";
		print_r($obj->getById("students","*","id=1"));
	}
	echo "<pre>";
	print_r($obj->getallById("students","*","id in(2,3)"));
	echo "<pre>";
	if($obj->insert("students","name='tarek',phone='657657',address='jamader bazar'")!=false){
		echo "insert success";
	}
	else{
		echo "insert faild";
	}

	echo "<pre>";
	if($obj->update("students","name='robin'","id=4")!=false){
		echo "update success";
	}
	else{
		echo "update faild";
	}
	echo "<pre>";
	if($obj->delete("students","id=4")!=false){
		echo "delete success";
	}
	else{
		echo "delete faild";
	}

?>
	