<?php

// get_called_class() is only in PHP >= 5.3.
if (!function_exists('get_called_class'))
{
    function get_called_class()
    {
        $bt = debug_backtrace();
        $l = 0;
        do
        {
            $l++;
            $lines = file($bt[$l]['file']);
            $callerLine = $lines[$bt[$l]['line']-1];
            preg_match('/([a-zA-Z0-9\_]+)::'.$bt[$l]['function'].'/', $callerLine, $matches);
        } while ($matches[1] === 'parent' && $matches[1]);

        return $matches[1];
    }
}

abstract class Controller {

  protected $_repository;

  final public static function getInstance ($calledClass = NULL) {
    static $instances = array ();
    if (!$calledClass) $calledClass = get_called_class();
    if (!isset ($instances[$calledClass])) {
      $instances[$calledClass] = new $calledClass();
    }
    return $instances[$calledClass];
  }

  final public function __clone () {}

  function __call ($methodName, $args) {
    if (!method_exists ($this, $methodName)
      && method_exists ($this->_repository, $methodName)) {
      // Debug
      if (Config::read ('debug')) {
        FB::group ('Controller ['. get_class ($this) .'] ' . get_class ($this) . '->' . $methodName);
        FB::info ($methodName, 'Delegated method');
        FB::info ($args, 'Arguments');
        FB::groupEnd ();
      }
      switch (count ($args)) {
        case 0:
          return $this->_repository->$methodName ();
          break;
        case 1:
          return $this->_repository->$methodName ($args[0]);
          break;
        case 2:
          return $this->_repository->$methodName ($args[0], $args[1]);
          break;
        case 3:
          return $this->_repository->$methodName ($args[0], $args[1], $args[2]);
          break;
        case 4:
          return $this->_repository->$methodName ($args[0], $args[1], $args[2], $args[3]);
          break;
        case 5:
          return $this->_repository->$methodName ($args[0], $args[1], $args[2], $args[3], $args[4]);
          break;
        case 6:
          return $this->_repository->$methodName ($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]);
          break;
      }
    }
    else {
      // Debug
      if (Config::read ('debug')) {
        throw new Exception ('Calling non-existing method ' . $methodName . ' with arguments {' . print_r ($args, TRUE) . '}');
      }
    }
  }

}

?>
