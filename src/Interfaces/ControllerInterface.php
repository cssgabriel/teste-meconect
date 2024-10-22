<?php

namespace Project\Meconect\Interfaces;

interface ControllerInterface
{
  public function index(\PDO $pdo);
  public function update(\PDO $pdo);
  public function create(\PDO $pdo);
  public function save(\PDO $pdo);
  public function delete(\PDO $pdo);
}
