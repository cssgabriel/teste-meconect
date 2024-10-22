<?php

function view(string $view, array $context = [])
{
  $pathView = __DIR__ . "/../../views/{$view}.php";
  
  if (!file_exists($pathView)) return;
  
  ob_start();
  extract($context);
  require __DIR__ . "/../../views/template.php";
  $html = ob_get_clean();
  echo($html);
}

function component(string $component, array $context = [])
{
  if (str_contains($component, ".")) $component = str_replace(".", "/", $component);
  
  $pathComponent = __DIR__ . "/../../views/Components/{$component}.php";
  if (!file_exists($pathComponent)) return;
  
  ob_start('renderComponent');
  extract($context);

  require $pathComponent;
  $html = ob_get_clean();
  echo($html);
}

function dd(mixed ...$args) {
  if (count($args) === 0) return;
  echo "<pre>";
  var_dump(...$args);
  echo "</pre>";
  die;
}

function getCsfrToken() {
  return $_SESSION["csfr_token"]  ?? "";
}
function setCsfrToken() {
  $_SESSION["csfr_token"] = bin2hex(random_bytes(35));
}
function verifyCsfrToken() {
  $token = filter_input(INPUT_POST, "csfr_token", FILTER_SANITIZE_SPECIAL_CHARS);

  if (!$token || $token !== getCsfrToken()) {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed");
    exit;
  } 
}

function csfr() {
  setCsfrToken();
  return getCsfrToken();
}

function redirect($path, $status = 302) {
  header("Location: {$path}", false, $status);
  exit;
}

function uuid($data = null) {
  // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
  $data = $data ?? random_bytes(16);
  assert(strlen($data) == 16);

  // Set version to 0100
  $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
  // Set bits 6-7 to 10
  $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

  // Output the 36 character UUID.
  return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function env(string $key) {
  return $_ENV[$key] ?? null;
}