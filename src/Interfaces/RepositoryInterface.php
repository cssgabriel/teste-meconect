<?php

namespace Project\Meconect\Interfaces;

interface RepositoryInterface
{
  public function create(array $args): bool;
  public function delete(string $arg): bool;
  public function update(array $args, array $needle): bool;
  public function find(string $key, mixed $value);
  public function getAll(): array;
  public function hydrate(array $args);
}
