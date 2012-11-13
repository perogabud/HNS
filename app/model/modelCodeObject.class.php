<?php

class ModelCodeObject extends ModelObject {

  protected $_name;

  public function __construct ($data) {
    parent::__construct ($data);
    $this->_setMember ('_name', $data, 'name');
  }

  public function getName () {
    return $this->_name;
  }

}

?>