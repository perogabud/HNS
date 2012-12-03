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
  protected $_content;
  protected $_lead;
  protected $_metaTitle;
  protected $_metaDescription;
  protected $_metaKeywords;
  protected $_isException;
  protected $_isVisible;
  protected $_isEditable;
  protected $_isPublished;
  protected $_canAddChildren;
  protected $_canBeDeleted;
  protected $_class;
  protected $_navigationDescription;
  protected $_coverImage;
  protected $_customModules;

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
      'content',
      'lead',
      'metaTitle',
      'metaDescription',
      'metaKeywords',
      'navigationDescription'
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

  public function getContent ($lang = NULL, $includeModule = FALSE) {
    $content = $this->_getLanguageMember ($this->_content, $lang);
    if ($includeModule && $this->_customModules)
      foreach ($this->_customModules as $customModule) {
        $selector = '{{module'. $customModule->getId () .'}}';
        $content = str_replace ('<p>'. $selector .'</p>', $selector, $content);
        $content = str_replace ($selector, FrontHelper::printCustomModuleHtml ($customModule, FALSE, TRUE), $content);
      }
    return $content;
    FrontHelper::printCustomModuleHtml ($customModule);
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

  public function getCanBeDeleted () {
    return $this->_canBeDeleted;
  }

  public function getClass () {
    return $this->_class;
  }

  public function getNavigationDescription ($lang = NULL) {
    return $this->_getLanguageMember ($this->_navigationDescription, $lang);
  }

  public function getCoverImage () {
    return $this->_coverImage;
  }

  public function setCoverImage ($coverImage) {
    $this->_coverImage = $coverImage;
  }

  public function getCustomModules () {
    return $this->_customModules;
  }

  public function setCustomModules ($customModules) {
    $this->_customModules = $customModules;
  }

  public function getCustomModule ($customModuleId) {
    if ($this->_customModules) foreach ($this->_customModules as $customModule) {
      if ($customModule->getId () == $customModuleId) {
        return $customModule;
      }
    }
    return NULL;
  }
}
?>