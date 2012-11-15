<?php
class NewsItemCoverImage extends ModelObject {

  
  protected $_newsItem;
  protected $_filename;
  protected $_width;
  protected $_height;
  
  public function __construct ($data, $config = array ()) {
    parent::__construct ($data);
    $this->_setMember ('_id', $data, 'coverImageId');
    $this->_setMember ('_rootUrl', $config, 'rootUrl');
    $this->_setMember ('_uriSeparator', $config, 'uriSeparator');
    $this->_setMembers ($data);
  }

  public function getNewsItem () {
    return $this->_newsItem;
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
    return Config::read ('sitePath') . 'img/newsItem/coverImage/' . $this->_filename;
  }

  public function getUrl () {
    return $this->_rootUrl . '/img/newsItem/coverImage/' . $this->_filename;
  }

  public function getLargeThumbnailUrl () {
    return $this->_rootUrl . '/img/newsItem/coverImage/largeThumbnail/' . $this->_filename;
  }

  public function getLargeThumbnailPath () {
    return Config::read ('sitePath') . 'img/newsItem/coverImage/largeThumbnail/' . $this->_filename;
  }  

  public function getSmallThumbnailUrl () {
    return $this->_rootUrl . '/img/newsItem/coverImage/smallThumbnail/' . $this->_filename;
  }

  public function getSmallThumbnailPath () {
    return Config::read ('sitePath') . 'img/newsItem/coverImage/smallThumbnail/' . $this->_filename;
  }  

  public function deleteFiles () {
    if (is_file ($this->getPath ()))
      if (!unlink ($this->getPath ()))
        throw new Exception ('An error occurred while deleting file "' . $this->getPath () . '"');
    if (is_file ($this->getLargeThumbnailPath ()))
      if (!unlink ($this->getLargeThumbnailPath ()))
        throw new Exception ('An error occurred while deleting file "' . $this->getLargeThumbnailPath () . '"');
    if (is_file ($this->getSmallThumbnailPath ()))
      if (!unlink ($this->getSmallThumbnailPath ()))
        throw new Exception ('An error occurred while deleting file "' . $this->getSmallThumbnailPath () . '"');
  }
  
}
?>