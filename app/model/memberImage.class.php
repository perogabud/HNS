<?php
class MemberImage extends ModelObject {

  
  protected $_member;
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

  public function getMember () {
    return $this->_member;
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
    return Config::read ('sitePath') . 'img/member/image/' . $this->_filename;
  }

  public function getUrl () {
    return $this->_rootUrl . '/img/member/image/' . $this->_filename;
  }

  public function getThumbnailUrl () {
    return $this->_rootUrl . '/img/member/image/thumbnail/' . $this->_filename;
  }

  public function getThumbnailPath () {
    return Config::read ('sitePath') . 'img/member/image/thumbnail/' . $this->_filename;
  }  

  public function deleteFiles () {
    if (is_file ($this->getPath ()))
      if (!unlink ($this->getPath ()))
        throw new Exception ('An error occurred while deleting file "' . $this->getPath () . '"');
    if (is_file ($this->getThumbnailPath ()))
      if (!unlink ($this->getThumbnailPath ()))
        throw new Exception ('An error occurred while deleting file "' . $this->getThumbnailPath () . '"');
  }
  
}
?>