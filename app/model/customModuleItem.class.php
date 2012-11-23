<?php
class CustomModuleItem extends ModelObject {

  protected $_class;
  protected $_position;
  protected $_positionInCustomModule;
  protected $_customModuleItemSize;
  protected $_customModuleImage;
  protected $_customModuleText;
  protected $_customModule;

  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'customModuleItemId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
  }


  public function getClass () {
    return $this->_class;
  }

  public function getPosition () {
    return $this->_position;
  }

  public function getPositionInCustomModule () {
    return $this->_positionInCustomModule;
  }


  public function getCustomModuleItemSize () {
    return $this->_customModuleItemSize;
  }

  public function setCustomModuleItemSize ($customModuleItemSize) {
    $this->_customModuleItemSize = $customModuleItemSize;
  }

  public function getCustomModuleImage () {
    return $this->_customModuleImage;
  }

  public function setCustomModuleImage ($customModuleImage) {
    $this->_customModuleImage = $customModuleImage;
  }

  public function getCustomModuleText () {
    return $this->_customModuleText;
  }

  public function setCustomModuleText ($customModuleText) {
    $this->_customModuleText = $customModuleText;
  }


  public function getCustomModule () {
    return $this->_customModule;
  }


}
?>