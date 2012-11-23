<?php
class CustomModule extends ModelObject {

  protected $_class;
  protected $_customModuleItems;
  
  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'customModuleId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
  }

  
  public function getClass () {
    return $this->_class;
  }

  public function getCustomModuleItems () {
    return $this->_customModuleItems;
  }

  public function setCustomModuleItems ($customModuleItems) {
    $this->_customModuleItems = $customModuleItems;
  }

  
}
?>