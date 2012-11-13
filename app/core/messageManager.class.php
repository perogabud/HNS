<?php

class MessageManager {

  public static function setGlobalMessage ($message) {
    if (!isset ($_SESSION['message']) || empty ($_SESSION['message'])) {
      $_SESSION['message'] = $message;
    }
    else {
      $_SESSION['message'] .= '<br />' . $message;
    }
  }

  public static function getGlobalMessage () {
    return $_SESSION['message'];
  }

  public static function globalMessageIsSet () {
    return isset ($_SESSION['message']) && !empty ($_SESSION['message']);
  }

  public static function setInputMessage ($name, $message) {
    if (!isset ($_SESSION['messages'][$name]) || empty ($_SESSION['messages'][$name])) {
      $_SESSION['messages'][$name] = $message;
    }
    else {
      $_SESSION['messages'][$name] .= '<br />' . $message;
    }
  }

  public static function getInputMessage ($name) {
    return $_SESSION['messages'][$name];
  }

  public static function inputMessageIsSet ($name) {
    return isset ($_SESSION['messages'][$name]) && !empty ($_SESSION['messages'][$name]);
  }

  public static function setSuccessMessage ($message) {
    $_SESSION['successMessage'] = $message;
  }

  public static function getSuccessMessage () {
    return $_SESSION['successMessage'];
  }

  public static function successMessageIsSet () {
    return isset ($_SESSION['successMessage']) && !empty ($_SESSION['successMessage']);
  }

  public static function clearMessages () {
    if (isset ($_SESSION['message'])) {
      unset ($_SESSION['message']);
    }
    if (isset ($_SESSION['messages'])) {
      unset ($_SESSION['messages']);
    }
    if (isset ($_SESSION['successMessage'])) {
      unset ($_SESSION['successMessage']);
    }
  }

}

?>
