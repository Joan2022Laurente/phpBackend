<?php
class Database {
    private $host = "db4free.net";
    private $dbname = "asdaosdkas51sdf5";
    private $username = "counprob0";
    private $password = "935348536ceviche";
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";port=3306;dbname=" . $this->dbname . ";charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "❌ Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
