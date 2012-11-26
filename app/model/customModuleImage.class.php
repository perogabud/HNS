<?php
class CustomModuleImage extends ModelObject {

  protected $_title;
  protected $_image;
  
  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'customModuleImageId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
  }

  
  public function getTitle () {
    return $this->_title;
  }

  public function getImage () {
    return $this->_image;
  }

  public function setImage ($image) {
    $this->_image = $image;
  }

  
}
?>