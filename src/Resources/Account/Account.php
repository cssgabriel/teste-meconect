<?php

namespace Project\Meconect\Resources\Account;

class Account
{
  public function __construct(
    private string $id,
    private string $name,
    private string $email,
    private string $title,
  ) {}
  public function setName(string $name): self
  {
    $this->name = $name;
    return $this;
  }
  public function setEmail(string $email): self
  {
    $this->email = $email;
    return $this;
  }
  public function getName(): string
  {
    return $this->name;
  }
  public function getEmail(): string
  {
    return $this->email;
  }
  public function __get(string $name)
  {
    if (!isset($this->$name)) return;

    return $this->$name;
  }
}
