<?php

abstract class ContentManager {

  protected $elements = array ();
  protected $data = array ();
  protected $template = 'default';
  protected $params = array ();

  public function __construct ($params) {
    $this->params = $params;
  }

  abstract public function route ();

  public function getElement ($element) {
    if (isset ($this->elements[$element])) {
      return $this->elements[$element];
    }
    else {
      return null;
    }
  }

  public function getTemplate () {
    return $this->template;
  }

  public function getData () {
    return $this->data;
  }

  /**
   * Checks if maximum number of URI parameters is exceeded,
   * language parameter is not included in check.
   */
  protected function _checkParams ($length, $continue = FALSE) {
    if (is_array ($length)) {
      $result = false;
      foreach ($length as $len) {
        if (count ($this->params) == $len) {
          $result = true;
          break;
        }
      }
      if (!$result && !$continue) {
        $this->set404 ();
      }
      return $result;
    }
    else {
      if (count ($this->params) != $length) {
        if (!$continue) {
          $this->set404 ();
        }
        return false;
      }
      return true;
    }
  }

  /**
   * Sets the content for invalid requests.
   */
  protected function set404 () {
    $this->_setTemplate ('404');
  }

  /**
   * Maps elements to element files.
   */
  protected function _setElements ($elements, $route = null) {
    foreach ($elements as $name => $data) {
      if ($route != null) {
        $data['filename'] = $route .'/'. $data['filename'];
      }
      $this->elements[$name] = $data;
    }
  }

  protected function _setData ($data) {
    foreach ($data as $name => $value) {
      $this->data[$name] = $value;
    }
  }

  /**
   * Sets the template for output.
   */
  protected function _setTemplate ($filename) {
    $this->template = $filename;
  }

  protected function _removeFirstParameter () {
    if (count ($this->params) == 1) {
      $this->params[0] = '';
    }
    else {
      unset ($this->params[0]);
      $this->params = array_values ($this->params);
    }
  }

  protected function _setErrorMessage ($message) {
    $this->data['errorMessage'] = $message;
  }

}
?>
