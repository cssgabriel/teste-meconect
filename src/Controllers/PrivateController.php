<?php

namespace Project\Meconect\Controllers;

use Project\Meconect\Interfaces\ControllerInterface;
use Project\Meconect\Resources\Account\AccountRepository;

class PrivateController extends Controller implements ControllerInterface
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index(\PDO $pdo)
  {
    echo $this->templates->render('protected');
  }

  public function create(\PDO $pdo) {}
  public function update(\PDO $pdo) {}
  public function save(\PDO $pdo) {}
  public function delete(\PDO $pdo) {}
}
