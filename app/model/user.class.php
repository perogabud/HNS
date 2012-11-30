<?php
class User extends ModelObject {

  protected $_username;
  protected $_slug;
  protected $_rootUrl;
  protected $_password;
  protected $_userRoles;
  
  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'userId');
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
    return $this->_rootUrl . 'user' . '/' . $this->_slug;
  }

  public function getUsername () {
    return $this->_username;
  }

  public function getPassword () {
    return $this->_password;
  }

  public function getUserRoles () {
    return $this->_userRoles;
  }

  public function setUserRoles ($userRoles) {
    $this->_userRoles = $userRoles;
  }

  
}
?>