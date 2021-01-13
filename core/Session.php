<?php

namespace app\core;

class Session
{

     const TIME_SESSION = 86400;

    public function __construct()
    {
        session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function getUser()
    {
         if(!isset($_SESSION['user']))
               return false;

          $inactivity = self::TIME_SESSION;
          $sessionTTL = time() - $_SESSION['timeout'];
          
          if($sessionTTL > $inactivity)
          {
               unset($_SESSION['user'] );
               unset($_SESSION['timeout'] );
               return false;
          }
          else 
          {
               return $_SESSION['user'];
          }
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }
}
