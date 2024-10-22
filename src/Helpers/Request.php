<?php

namespace Project\Meconect\Helpers;

use stdClass;

class Request extends stdClass
{
  private string $url;
  private string $scheme = "";
  private string $host = "";
  private string $port = "";
  private string $path = "";
  private string $query = "";
  private array $queries = [];

  public function __construct()
  {
    $this->url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

    foreach (parse_url($this->url) as $key => $value) {
      $this->{$key} = $value;
    }

    if ($this->query) parse_str($_SERVER["QUERY_STRING"], $this->queries);
  }

  public function __get(string $name)
  {
    if (!isset($this->$name)) return;

    return $this->$name;
  }
}
