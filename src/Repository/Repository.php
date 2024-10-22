<?php

namespace Project\Meconect\Repository;

use Project\Meconect\Interfaces\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
  public function __construct(private \PDO $pdo) {}

  public function create(array $args): bool
  {
    extract($args);
    try {
      $stmt = $this->pdo->prepare("INSERT INTO markets (user_id, name, email, password, is_admin) VALUES (:user_id, :name, :email, :password, :is_admin);");
      $stmt->bindValue(":user_id", $userId);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":password", password_hash($password, PASSWORD_ARGON2ID));
      $stmt->bindValue(":is_admin", $isAdmin ?? 0);
      $stmt->execute();
    } catch (\DomainException $e) {
      throw new $e("Erro ao criar usuário");
    }

    return true;
  }

  public function delete(string $email): bool
  {
    try {
      $stmt = $this->pdo->prepare("DELETE FROM markets WHERE email = :email;");
      $stmt->bindValue(":email", $email);
      $stmt->execute();
    } catch (\DomainException $e) {
      throw new $e("Erro ao criar usuário");
    }

    return true;
  }

  public function find(string $key, mixed $value)
  {
    try {
      $stmt = $this->pdo->query("SELECT * FROM markets WHERE {$key} = :{$key}");
      $stmt->bindValue(":{$key}", $value);
      $stmt->execute();
      $res = $stmt->fetch();
    } catch (\DomainException $e) {
      throw new $e("Erro ao consultar se o produto [{$key} => {$value}] existe.");
    }
    return $res ? $this->hydrate($res) : null;
  }

  public function update(array $args, array $needle): bool
  {
    $sql = $this->updateStatmentConstruct($args, $needle);
    try {
      $stmt = $this->pdo->prepare($sql);
      foreach ($args as $k => $v) {
        $stmt->bindValue(":{$k}", $v);
      }
      foreach ($needle as $k => $v) {
        $stmt->bindValue(":{$k}", $v);
      }
      $stmt->execute();
    } catch (\DomainException $e) {
      throw new $e("Erro ao criar usuário");
    }

    return true;
  }

  public function hydrate(array $args)
  {
    extract($args);
    if (!isset($ownerId) || !isset($name) || !isset($id) || !isset($address)) return null;

    // $market = new Market($ownerId, $name, $id, $address, $products ?? []);
    // return $market ?? null;
  }

  public function getAll(): \Generator
  {
    try {
      $stmt = $this->pdo->query("SELECT * FROM markets");
      $stmt->execute();
      while ($res = $stmt->fetch()) {
        yield $this->hydrate($res);
      }
    } catch (\Throwable $th) {
      throw new $th("Erro ao criar usuário");
    }
  }

  private function updateStatmentConstruct(array $args, array $needle): string
  {
    $sql = "UPDATE markets SET ";
    foreach ($args as $key => $_) {
      $sql .= "{$key} = :{$key}, ";
    }

    $sql = substr($sql, 0, -2) . " WHERE ";

    foreach ($needle as $key => $_) {
      $sql .= "{$key} = :{$key}, ";
    }

    $sql = substr($sql, 0, -2) . ";";
    return $sql;
  }
}
