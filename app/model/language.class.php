<?php
class Language extends ModelObject {

  protected $_languageId;
  protected $_name;
  protected $_code2;

  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'languageId');
    $this->_setMembers ($data);
  }

  public function getLanguageId () {
    return $this->_languageId;
  }

  public function getName () {
    return $this->_name;
  }



}
?>