<?php
class Team extends ModelObject {

  protected $_name;
  protected $_slug;
  protected $_rootUrl;
  protected $_members;
  
  public function __construct ($data, $dataLang, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'teamId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
    $this->_setLanguageMembers ($dataLang);
  }

  public static function getLanguageFields () {
    return array (
      'slug',
      'name'
    );
  }
  
  public function getSlug () {
    return $this->_slug;
  }

  public function getUrl ($lang = NULL) {
    return $this->_rootUrl . 'team' . '/' . $this->_getLanguageMember ($this->_slug, $lang);
  }

  public function getName ($lang = NULL) {
    return $this->_getLanguageMember ($this->_name, $lang);
  }

  public function getMembers () {
    return $this->_members;
  }

  public function setMembers ($members) {
    $this->_members = $members;
  }

  
}
?>