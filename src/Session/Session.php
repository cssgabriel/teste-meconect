<?php

namespace Project\Meconect\Session;

class Session
{
  private array $session = [];

  public function __construct(bool $initSession = true)
  {
    if ($initSession) session_start();
    $this->synchronize();
  }

  public function set(string $key, mixed $value)
  {
    $this->session[$key] = $value;
    $this->synchronize();
  }

  public function get(string $key)
  {
    return $this->hasKeys($key) ? $this->session[$key] : null;
  }

  private function synchronize($unset = false)
  {
    empty($this->session) && !$unset
      ? $this->session = $_SESSION
      : $_SESSION = $this->session;
  }

  public function unset(string ...$keys): void
  {
    foreach ($keys as $key) unset($this->session[$key]);
    $this->synchronize(true);
  }

  public function hasKeys(string ...$keys): bool
  {
    $sessionKeys = array_keys($this->session);
    foreach ($keys as $key) {
      if (!in_array($key, $sessionKeys)) return false;
    }

    return true;
  }

  public function getAll(): array
  {
    return $this->session;
  }

  public function isLogged(): bool
  {
    $isLogged = $this->get('logged');
    
    if (!empty($isLogged)) {
      $originalInfo = $this->get('logged');
      $this->unset($this->session['logged']);
      $this->regenerateId();
      $this->set('logged', $originalInfo);
    }
    return $isLogged ? true : false;
  }

  public function regenerateId()
  {
    session_regenerate_id();
  }
}
