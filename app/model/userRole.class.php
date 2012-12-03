<?php
class UserRole extends ModelObject {

  protected $_name;
  protected $_slug;
  protected $_rootUrl;
  
  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'userRoleId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
  }

  public static function getLanguageFields () {
    return array (
      'slug'
    );
  }
  
  public function getSlug ($lang = NULL) {
    return $this->_getLanguageMember ($this->_slug, $lang);
  }

  public function getUrl () {
    return $this->_rootUrl . 'userRole' . '/' . $this->_slug;
  }

  public function getName () {
    return $this->_name;
  }

  
}
?>