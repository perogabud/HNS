<?php
class Gallery extends ModelObject {

  protected $_title;
  protected $_slug;
  protected $_rootUrl;
  protected $_category;
  protected $_images;

  public function __construct ($data, $dataLang, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'galleryId');
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

  public function getSlug ($lang = NULL) {
    return $this->_getLanguageMember ($this->_slug, $lang);
  }

  public function getUrl ($lang = NULL) {
    return $this->_rootUrl . Dict::read ('slug_infoCenter') . '/' . Dict::read ('slug_galleries') . '/' . $this->_getLanguageMember ($this->_slug, $lang);
  }

  public function getTitle ($lang = NULL) {
    return $this->_getLanguageMember ($this->_title, $lang);
  }

  public function getCategory ($lang = NULL) {
    return $this->_getLanguageMember ($this->_category, $lang);
  }

  public function getImages () {
    return $this->_images;
  }

  public function setImages ($image) {
    $this->_images = $image;
  }

  public function getCoverImage () {
    return $this->_images ? $this->_images[0] : NULL;
  }


}
?>