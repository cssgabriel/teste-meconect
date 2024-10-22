<?php

namespace Project\Meconect\Facades;

use Project\Meconect\Route\Route as RouteClass;

class Route
{
  private static RouteClass $instance;
  private static bool $initialized = false;

  public static function initialize()
  {
    self::$instance = new RouteClass;
    self::$initialized = true;
  }

  public static function get(string $path, array $class)
  {
    if (!self::$initialized) self::initialize();

    return self::$instance->get($path, $class);
  }

  public static function post(string $path, array $class)
  {
    if (!self::$initialized) self::initialize();

    return self::$instance->post($path, $class);
  }

  public static function middleware(string|array $middleware)
  {
    if (!self::$initialized) self::initialize();

    return self::$instance->middleware($middleware);
  }
  public static function watch()
  {
    if (!self::$initialized) self::initialize();

    return self::$instance->watch();
  }
}
