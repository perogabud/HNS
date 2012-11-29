<?php
class NewsCategory extends ModelObject {

  protected $_title;

  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'newsCategoryId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
  }

  public function getTitle () {
    return $this->_title;
  }

}
?>