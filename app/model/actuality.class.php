<?php
class Actuality extends ModelObject {

  protected $_language;
  protected $_title;
  protected $_slug;
  protected $_rootUrl;
  protected $_lead;
  protected $_content;
  protected $_isPublished;
  protected $_publishDate;

  protected $_coverImage;

  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'actualityId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
  }

  public function getLanguage () {
    return $this->_language;
  }

  public function getSlug () {
    return $this->_slug;
  }

  public function getUrl () {
    return $this->_rootUrl . Dict::read ('slug_infoCenter') . '/' . Dict::read ('slug_actualities') . '/' . $this->_slug;
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

  public function getCoverImage () {
    return $this->_coverImage;
  }

  public function setCoverImage ($coverImage) {
    $this->_coverImage = $coverImage;
  }


}
?>