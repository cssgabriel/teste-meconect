<?php

namespace Project\Meconect\Resources\Account;

use Project\Meconect\Interfaces\RepositoryInterface;
use Project\Meconect\Resources\Account\Account;

class AccountRepository implements RepositoryInterface
{
  public function __construct(private \PDO $pdo) {}

  public function create(array $args): bool
  {
    extract($args);
    try {
      $stmt = $this->pdo->prepare("INSERT INTO users (name_user, code_user, email_user, title_user, password_user) VALUES (:name_user, :code_user, :email_user, :title_user, :password_user);");
      $stmt->bindValue(":name_user", $name_user);
      $stmt->bindValue(":code_user", $code_user);
      $stmt->bindValue(":email_user", $email_user);
      $stmt->bindValue(":title_user", $title_user);
      $stmt->bindValue(":password_user", $password_user);
      $stmt->execute();
    } catch (\DomainException $e) {
      throw new $e("Erro ao criar usuário");
    }

    return true;
  }

  public function delete(string $id): bool
  {
    try {
      $stmt = $this->pdo->prepare("DELETE FROM users WHERE user_id = :user_id;");
      $stmt->bindValue(":user_id", $id);
      $stmt->execute();
    } catch (\DomainException $e) {
      throw new $e("Erro ao deletar usuário");
    }

    return true;
  }

  public function find(string $key, mixed $value)
  {
    try {
      $stmt = $this->pdo->prepare("SELECT * FROM users WHERE {$key} = :{$key};");
      $stmt->bindValue(":{$key}", $value);
      $stmt->execute();
      $res = $stmt->fetch();
    } catch (\DomainException $e) {
      throw new $e("Erro ao consultar se o produto [{$key} => {$value}] existe.");
    }
    return $res ?? null;
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
      throw new $e("Erro ao atualizar usuário");
    }

    return true;
  }

  public function hydrate(array $args)
  {
    extract($args);
    if (!isset($code_user) || !isset($name_user) || !isset($email_user) || !isset($title_user)) return null;

    $account = new Account($code_user, $name_user, $email_user, $title_user);
    return $account ?? null;
  }

  public function getAll(): array
  {
    try {
      $stmt = $this->pdo->query("SELECT * FROM users");
      $stmt->execute();
      $res = $stmt->fetchAll();
      // while ($res = $stmt->fetch()) {
      //   yield $this->hydrate($res);
      // }
      return array_map(fn($data) => $this->hydrate($data), $res);
    } catch (\Throwable $th) {
      throw new $th("Erro ao criar usuário");
    }
  }

  private function updateStatmentConstruct(array $args, array $needle): string
  {
    $sql = "UPDATE users SET ";
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
