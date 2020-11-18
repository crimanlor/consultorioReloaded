<?php

namespace App;

use PDO;
use PDOException;

class DbSession
{

  public $mysql;

  public function __construct()
  {
    try {
      $this->mysql = $this->getConnection();
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }

  private function getConnection()
  {
    if (!getenv('CLEARDB_DATABASE_URL')) {
      $host = "localhost";
      $user = "root";
      $pass = "root";
      $database = "citas";
      $charset = "utf-8";
      $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
      $pdo = new pdo("mysql:host={$host};dbname={$database};charset{$charset}", $user, $pass, $options);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $pdo;
    } else {
      $dbopts = parse_url(getenv('CLEARDB_DATABASE_URL'));
      $host = $dbopts["host"];
      $user = $dbopts["user"];
      $pass = $dbopts["pass"];
      $database = "citas";
      $charset = "utf-8";
      $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
      $pdo = new pdo("mysql:host={$host};dbname={$database};charset{$charset}", $user, $pass, $options);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
  }
}
