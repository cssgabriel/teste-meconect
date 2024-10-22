<?php

namespace Project\Meconect\Controllers;

use Project\Meconect\Helpers\FlashMessage;
use Project\Meconect\Interfaces\ControllerInterface;
use Project\Meconect\Resources\Account\AccountRepository;

class HomeController extends Controller implements ControllerInterface
{
  public function __construct()
  {
    parent::__construct();
  }
  public function index(\PDO $pdo)
  {
    $flashMessage = FlashMessage::getMessage();

    echo $this->templates->render("home", [
      "flashMessage" => $flashMessage,
    ]);
  }

  public function login(\PDO $pdo) {
    $email = filter_input(INPUT_POST, 'email');
    $password = $_POST['password'];

    if (!$email || !$password) {
      FlashMessage::setMessage("Dados inválidos. Tente novamente!");
      return redirect("/");
    };

    $accountRepo = new AccountRepository($pdo);
    $user = $accountRepo->find('email_user', $email);
    $isCorrectPassword = password_verify($password, $user['password_user'] ?? password_hash(' ', PASSWORD_ARGON2ID));

    if (!$isCorrectPassword) {
      FlashMessage::setMessage("Dados inválidos. Tente novamente!");
      return redirect("/");
    }

    $this->session->set("logged", true);
    return redirect("/protected-route");
  }

  public function create(\PDO $pdo) {}
  public function update(\PDO $pdo) {}
  public function save(\PDO $pdo) {}
  public function delete(\PDO $pdo) {}
}
