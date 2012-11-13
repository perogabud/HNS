<?php
class Page extends ModelObject {

  protected $_lft;
  protected $_rgt;
  protected $_depth;
  protected $_parentId;
  protected $_subpages;
  protected $_title;
  protected $_navigationName;
  protected $_slug;
  protected $_rootUrl;
  protected $_fullUri;
  protected $_lead;
  protected $_content;
  protected $_metaTitle;
  protected $_metaDescription;
  protected $_metaKeywords;
  protected $_isException;
  protected $_isVisible;
  protected $_isEditable;
  protected $_isPublished;
  protected $_canAddChildren;
  protected $_tags;

  public function __construct ($data, $dataLang, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'pageId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
    $this->_setLanguageMembers ($dataLang);
  }

  public static function getLanguageFields () {
    return array (
      'title',
      'slug',
      'fullUri',
      'navigationName',
      'lead',
      'content',
      'metaTitle',
      'metaDescription',
      'metaKeywords'
    );
  }

  public function getLft () {
    return $this->_lft;
  }

  public function getRgt () {
    return $this->_rgt;
  }

  public function getDepth () {
    return $this->_depth;
  }

  public function getParentId () {
    return $this->_parentId;
  }

  public function getSubpages () {
    return $this->_subpages;
  }

  public function setSubpages ($subpages) {
    $this->_subpages = $subpages;
  }

  public function getTitle ($lang = NULL) {
    return $this->_getLanguageMember ($this->_title, $lang);
  }

  public function getSlug ($lang = NULL) {
    return $this->_getLanguageMember ($this->_slug, $lang);
  }

  public function getUrl ($lang = NULL) {
    return substr ($this->_rootUrl, 0, -1) . $this->_getLanguageMember ($this->_fullUri, $lang);
  }

  public function getNavigationName ($lang = NULL) {
    return $this->_getLanguageMember ($this->_navigationName, $lang);
  }

  public function getContent ($lang = NULL) {
    return $this->_getLanguageMember ($this->_content, $lang);
  }

  public function getLead ($lang = NULL) {
    return $this->_getLanguageMember ($this->_lead, $lang);
  }

  public function getMetaTitle ($lang = NULL) {
    return $this->_getLanguageMember ($this->_metaTitle, $lang);
  }

  public function getMetaDescription ($lang = NULL) {
    return $this->_getLanguageMember ($this->_metaDescription, $lang);
  }

  public function getMetaKeywords ($lang = NULL) {
    return $this->_getLanguageMember ($this->_metaKeywords, $lang);
  }

  public function getIsException () {
    return $this->_isException;
  }

  public function getIsVisible () {
    return $this->_isVisible;
  }

  public function getIsEditable () {
    return $this->_isEditable;
  }

  public function getIsPublished () {
    return $this->_isPublished;
  }

  public function getCanAddChildren () {
    return $this->_canAddChildren;
  }

  public function getTags () {
    return $this->_tags;
  }

  public function setTags ($tags) {
    $this->_tags = $tags;
  }


}
?>