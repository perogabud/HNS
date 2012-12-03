<?php
class Member extends ModelObject {

  const LAST_NAME_FIRST = TRUE;

  protected $_firstName;
  protected $_slug;
  protected $_rootUrl;
  protected $_lastName;
  protected $_position;
  protected $_birthDate;
  protected $_birthPlace;
  protected $_height;
  protected $_club;
  protected $_pastClubs;
  protected $_playCount;
  protected $_firstPlayDate;
  protected $_biography;
  protected $_image;
  protected $_memberCategory;
  protected $_team;

  public function __construct ($data, $dataLang, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'memberId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
    $this->_setLanguageMembers ($dataLang);
  }

  public static function getLanguageFields () {
    return array (
      'biography'
    );
  }

  public function getSlug () {
    return $this->_slug;
  }

  public function getUrl () {
    /** @todo hack :/ */
    return isset ($this->_team) ?
      $this->_rootUrl . Dict::read ('slug_selections') .'/' . $this->_team->getSlug () . '/' . $this->_slug :
      $this->_rootUrl . Dict::read ('slug_selections') .'/a-reprezentacija/' . $this->_slug;
  }

  public function getName ($lastFirst = FALSE) {
    return $lastFirst ?
    $this->_lastName . ' ' . $this->_firstName :
    $this->_firstName . ' ' . $this->_lastName;
  }

  public function getFirstName () {
    return $this->_firstName;
  }

  public function getLastName () {
    return $this->_lastName;
  }

  public function getPosition () {
    return $this->_position;
  }

  public function getBirthDate ($format = NULL) {
    return $this->_getDateByFormat ($this->_birthDate, $format);
  }

  public function getBirthPlace () {
    return $this->_birthPlace;
  }

  public function getHeight () {
    return $this->_height;
  }

  public function getClub () {
    return $this->_club;
  }

  public function getPastClubs () {
    return $this->_pastClubs;
  }

  public function getPlayCount () {
    return $this->_playCount;
  }

  public function getFirstPlayDate ($format = NULL) {
    return $this->_getDateByFormat ($this->_firstPlayDate, $format);
  }

  public function getBiography ($lang = NULL) {
    return $this->_getLanguageMember ($this->_biography, $lang);
  }

  public function getImage () {
    return $this->_image;
  }

  public function setImage ($image) {
    $this->_image = $image;
  }


  public function getMemberCategory () {
    return $this->_memberCategory;
  }

  public function setMemberCategory ($memberCategory) {
    $this->_memberCategory = $memberCategory;
  }


  public function getTeam () {
    return $this->_team;
  }


}
?>