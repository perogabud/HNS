<?php

class _P {

  static public function get ($param = NULL) {
    if (is_null ($param)) {
      $param = array_keys ($_POST);
    }
    if (is_array ($param)) {
      $posted = array ();
      foreach ($param as $key) {
        if (key_exists ($key, $_POST)) {
          $posted[$key] = $_POST[$key];
        }
        else {
          $posted[$key] = NULL;
        }
      }
      return $posted;
    }
    if (key_exists ($param, $_POST)) {
      return $_POST[$param];
    }
    return NULL;
  }

}

?>
