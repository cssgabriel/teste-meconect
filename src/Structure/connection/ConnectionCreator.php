<?php

namespace Project\Meconect\Structure\Connection;

use PDO;

class ConnectionCreator
{
  public static function connect(): PDO
  {
    try {
      $pdo = new PDO("mysql:host=" . env('DB_HOST') . ";dbname=" . env('DB_NAME'), env('DB_USER'), env('DB_PASS'));
      // $pdo = new PDO("sqlite:" . __DIR__ . "/../../../db.sqlite");
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
      throw new $th;
    }
    return $pdo;
  }
}
