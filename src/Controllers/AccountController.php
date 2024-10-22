<?php

namespace Project\Meconect\Controllers;

use DateInterval;
use DateTime;
use Project\Meconect\Helpers\FlashMessage;
use Project\Meconect\Interfaces\ControllerInterface;
use Project\Meconect\Resources\Account\AccountRepository;

class AccountController extends Controller implements ControllerInterface
{
  public function __construct()
  {
    parent::__construct();
  }
  public function index(\PDO $pdo)
  {
    if (!$this->session->get("newAccount")) redirect("/");

    $this->session->unset("newAccount");
    echo $this->templates->render("obrigado");
  }

  public function create(\PDO $pdo)
  {
    $flashMessage = FlashMessage::getMessage();

    echo $this->templates->render("cadastro", [
      "flashMessage" => $flashMessage,
      "formErrors" => null
    ]);
  }

  public function update(\PDO $pdo) {}

  public function save(\PDO $pdo)
  {
    verifyCsfrToken();
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $uuid = filter_input(INPUT_POST, "uuid", FILTER_SANITIZE_SPECIAL_CHARS);
    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, "password");

    $error = false;
    foreach ([$name, $uuid, $title, $email, $password] as $field) {
      if (!$field) {
        FlashMessage::setMessage("Campo inválido: {$field}");
        $error = true;
      }
    }

    if ($error) {
      return redirect("/register");
    }

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = password_hash($password, PASSWORD_ARGON2ID);

    $accountRepo = new AccountRepository($pdo);

    if ($accountRepo->find('email_user', $email)) {
      FlashMessage::setMessage("Dados inválidos. Tente novamente!");
      return redirect("/register");
    }

    $accountRepo->create([
      "name_user" => $name,
      "code_user" => $uuid,
      "email_user" => $email,
      "title_user" => $title,
      "password_user" => $password,
    ]);

    return redirect("/");
  }

  public function delete(\PDO $pdo) {}
}
