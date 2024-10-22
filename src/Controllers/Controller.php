<?php

namespace Project\Meconect\Controllers;

use League\Plates\Engine;
use Project\Meconect\Helpers\Errors;
use Project\Meconect\Helpers\Request;
use Project\Meconect\Session\Session;

abstract class Controller
{
  protected Session $session;
  protected Errors $errors;
  protected Request $request;
  protected Engine $templates;

  public function __construct()
  {
    $this->session = new Session;
    $this->errors = new Errors;
    $this->request = new Request;
    $this->templates = new Engine(__DIR__ . "/../../views");
  }
}
