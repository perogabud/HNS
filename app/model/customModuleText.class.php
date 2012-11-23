<?php
class CustomModuleText extends ModelObject {

  protected $_content;
  protected $_footnote;
  
  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'customModuleTextId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
  }

  
  public function getContent () {
    return $this->_content;
  }

  public function getFootnote () {
    return $this->_footnote;
  }

  
}
?>