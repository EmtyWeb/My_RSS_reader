<?php
class DB extends PDO {
    protected $host = 'localhost';
    protected $dbname = 'reader';
    protected $user = 'Ruslan';
    protected $pass = '1';
    public function __construct() {
        try {
            parent::__construct("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
        } catch (PDOException $e) {
            throw new Error_Exception("Ошибка: " . $e->getMessage());
        }
    }
}
$DBH = new DB();
?>