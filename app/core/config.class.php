<?php

class Config {

    static private $configs = Array ();

    static public function write ($name, $value) {
      self::$configs[$name] = $value;
    }

    static public function read ($name, $key = NULL) {
      if ($key == NULL) {
        if (isset (self::$configs[$name])) {
          return self::$configs[$name];
        }
        else {
          return NULL;
        }
      }
      else {
        if (!is_array (self::$configs[$name])) {
          return NULL;
        }
        else {
          return self::$configs[$name][$key];
        }
      }
    }
}
?>
