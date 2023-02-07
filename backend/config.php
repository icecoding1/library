<?php
class Config
{
  private const HOST = 'localhost';
  private const USER = 'root';
  private const PASS = '';
  private const DB = 'db_library';

  private $dns = "mysql:host=" . self::HOST . ";dbname=" . self::DB . "";
  public $conn = null;


  public function __construct()
  {
    try {
      $this->conn = new PDO($this->dns, self::USER, self::PASS);
      $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      // echo "success";
    } catch (PDOException $e) {
      die("ERROR" . $e->getMessage());
    }

    return $this->conn;
  }
}
