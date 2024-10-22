<?php

namespace Project\Meconect\Helpers;

class Errors
{
  private array $errors = [];

  public function __construct() {}

  public function setError(array $error): self
  {
    $this->errors[] = $error;
    return $this;
  }

  public function getErrors(): array
  {
    return $this->errors;
  }
}
