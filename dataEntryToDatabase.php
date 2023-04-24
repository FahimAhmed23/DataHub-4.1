<?php
    Class dataEntry{
        private $conn;

        public function __construct(){
            $HOSTNAME = 'localhost';
            $USERNAME = 'root';
            $PASSWORD = '';
            $DATABASE = 'datahub';

            $this->conn = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

            if (!$this->conn) {
                die("Database Connection Error!");
            }
        }

        public function insertIntoTable ($table, $col, $value ) {
            $query = "INSERT INTO $table ($col) VALUES ($value)";

            if (mysqli_query($this->conn, $query)) {
                return true;
            }
            else {
                echo 'fails';
            }
        }

        public function closeMYSQL () {
            mysqli_close($this->conn);
        }
    }
?>

