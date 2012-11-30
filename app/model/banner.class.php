<?php
class Banner extends ModelObject {

  protected $_name;
  protected $_link;
  protected $_position;
  protected $_image;
  
  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'bannerId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
  }

  
  public function getName () {
    return $this->_name;
  }

  public function getLink () {
    return $this->_link;
  }

  public function getPosition () {
    return $this->_position;
  }

  public function getImage () {
    return $this->_image;
  }

  public function setImage ($image) {
    $this->_image = $image;
  }

  
}
?>