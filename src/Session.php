<?php
 
namespace App;
 
class Session
{
  public static function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }
 
  public static function get($key)
  {
    return $_SESSION[$key] ?? null;
  }
 
  public static function destroy()
  {
    session_destroy();
  }
 
  public static function isLoggedIn()
  {
    return self::get('user') !== null;
  }
}