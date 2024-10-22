<?php

namespace Project\Meconect\Middlewares;

use Project\Meconect\Helpers\FlashMessage;
use Project\Meconect\Session\Session;

class Auth
{
  protected Session $session;

  public function run()
  {
    $this->session = new Session(false);

    if (!$this->session->isLogged()) {
      FlashMessage::setMessage('Não autenticado');
      return redirect('/');
    }
  }
}
