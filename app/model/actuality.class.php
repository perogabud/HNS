<?php
class Actuality extends ModelObject {

  protected $_languageId;
  protected $_title;
  protected $_slug;
  protected $_rootUrl;
  protected $_lead;
  protected $_content;
  protected $_isPublished;
  protected $_publishDate;
  
  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'actualityId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
  }

  public static function getLanguageFields () {
    return array (
      'slug'
    );
  }
  
  public function getLanguageId () {
    return $this->_languageId;
  }

  public function getSlug ($lang = NULL) {
    return $this->_getLanguageMember ($this->_slug, $lang);
  }

  public function getUrl () {
    return $this->_rootUrl . 'actuality' . '/' . $this->_slug;
  }

  public function getTitle () {
    return $this->_title;
  }

  public function getLead () {
    return $this->_lead;
  }

  public function getContent () {
    return $this->_content;
  }

  public function getIsPublished () {
    return $this->_isPublished;
  }

  public function getPublishDate ($format = NULL) {
    return $this->_getDateByFormat ($this->_publishDate, $format);
  }

  
}
?>