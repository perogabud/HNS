<?php
class CustomModuleItemSize extends ModelObject {

  protected $_name;
  protected $_key;
  
  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'customModuleItemSizeId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
  }

  
  public function getName () {
    return $this->_name;
  }

  public function getKey () {
    return $this->_key;
  }

  
}
?>