<?php

namespace Project\Meconect\Helpers;

use Project\Meconect\Session\Session;
use stdClass;

class FlashMessage extends stdClass
{
  public static function setMessage(
    string $message = "Erro. Tente novamente!",
  ): void {
    self::sessionHandler()->set("message", $message);
  }

  public static function getMessage(): string
  {
    $message = self::hasMessage();
    if (!$message) return "";

    self::sessionHandler()->unset("message");
    return $message;
  }

  // public static function render(): string
  // {
  //   $message = self::getMessage();
  //   self::sessionHandler()->unset("message");
  //   return $message;
  // }

  public static function hasMessage(): mixed
  {
    return self::sessionHandler()->get("message");
  }

  private static function sessionHandler()
  {
    $session = new Session(false);
    return $session;
  }
}
