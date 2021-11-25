<?php 
    class Database {
        //db param
        private $host = 'localhost';
        private $db_name = 'myblog';
        private $username = 'root';
        private $password = '';
        private $conn;

        // db connect
        public function connect() {
            $this->conn = null;

            //connect through PDO
            try {
                $this->conn = new PDO('mysql:localhost='.$this->host . 'dbname=' . $this->db_name,
                 $this->username, $this->password);
                 $this->conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection error: ' .$e->getMessage();
            }

            return $this->conn;
        }
    }


?>