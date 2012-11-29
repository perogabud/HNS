<?php
class Video extends ModelObject {

  protected $_title;
  protected $_slug;
  protected $_rootUrl;
  protected $_category;
  protected $_youtubeUrl;
  protected $_isPublished;
  protected $_publishDate;
  
  public function __construct ($data, $dataLang, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'videoId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
    $this->_setLanguageMembers ($dataLang);
  }

  public static function getLanguageFields () {
    return array (
      'slug',
      'title',
      'category'
    );
  }
  
  public function getSlug () {
    return $this->_slug;
  }

  public function getUrl ($lang = NULL) {
    return $this->_rootUrl . 'video' . '/' . $this->_getLanguageMember ($this->_slug, $lang);
  }

  public function getTitle ($lang = NULL) {
    return $this->_getLanguageMember ($this->_title, $lang);
  }

  public function getCategory ($lang = NULL) {
    return $this->_getLanguageMember ($this->_category, $lang);
  }

  public function getYoutubeUrl () {
    return $this->_youtubeUrl;
  }
  
  public function getIsPublished() {
    return $this->_isPublished;
  }
  
  public function getPublishDate() {
    return $this->_publishDate;
  }

  
}
?>