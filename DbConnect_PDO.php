<?php 
	/**
	* Database Connection
	*/
	class DbConnect_PDO {

		private $server = 'localhost';
		private $dbname = 'database';
		private $user = 'user';
		private $pass = 'password';

		private $conn;

		public function connect() {

			try {

				$this->conn = new PDO('mysql:host=' .$this->server .';dbname=' . $this->dbname, $this->user, $this->pass);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $this->conn;

			} catch (Exception $e) {

				echo "Connect to database error: " . $e->getMessage();
			}
		}

		public function query($query, $params = array()) {

			try {

				$conn = $this->connect();
				$stmt = $conn->prepare($query);
				$stmt->execute($params);
				$data = $stmt->fetchAll();
				return $data;

			} catch(Exception $e) {

				echo "Query error. Connection does not exist: " . $e->getMessage();
			}
		}
	}