<?php
class CustomModuleImageImage extends ModelObject {

  
  protected $_customModuleImage;
  protected $_filename;
  protected $_width;
  protected $_height;
  
  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'imageId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
  }

  public function getCustomModuleImage () {
    return $this->_customModuleImage;
  }

  public function getFilename () {
    return $this->_filename;
  }

  public function getWidth () {
    return $this->_width;
  }

  public function getHeight () {
    return $this->_height;
  }

  public function getPath () {
    return Config::read ('sitePath') . 'img/customModuleImage/image/' . $this->_filename;
  }

  public function getUrl () {
    return $this->_rootUrl . '/img/customModuleImage/image/' . $this->_filename;
  }

  public function getSmallImageUrl () {
    return $this->_rootUrl . '/img/customModuleImage/image/smallImage/' . $this->_filename;
  }

  public function getSmallImagePath () {
    return Config::read ('sitePath') . 'img/customModuleImage/image/smallImage/' . $this->_filename;
  }  

  public function getThumbnailUrl () {
    return $this->_rootUrl . '/img/customModuleImage/image/thumbnail/' . $this->_filename;
  }

  public function getThumbnailPath () {
    return Config::read ('sitePath') . 'img/customModuleImage/image/thumbnail/' . $this->_filename;
  }  

  public function getSmallThumbnailUrl () {
    return $this->_rootUrl . '/img/customModuleImage/image/smallThumbnail/' . $this->_filename;
  }

  public function getSmallThumbnailPath () {
    return Config::read ('sitePath') . 'img/customModuleImage/image/smallThumbnail/' . $this->_filename;
  }  

  public function deleteFiles () {
    if (is_file ($this->getPath ()))
      if (!unlink ($this->getPath ()))
        throw new Exception ('An error occurred while deleting file "' . $this->getPath () . '"');
    if (is_file ($this->getSmallImagePath ()))
      if (!unlink ($this->getSmallImagePath ()))
        throw new Exception ('An error occurred while deleting file "' . $this->getSmallImagePath () . '"');
    if (is_file ($this->getThumbnailPath ()))
      if (!unlink ($this->getThumbnailPath ()))
        throw new Exception ('An error occurred while deleting file "' . $this->getThumbnailPath () . '"');
    if (is_file ($this->getSmallThumbnailPath ()))
      if (!unlink ($this->getSmallThumbnailPath ()))
        throw new Exception ('An error occurred while deleting file "' . $this->getSmallThumbnailPath () . '"');
  }
  
}
?>