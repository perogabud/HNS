<?php

abstract class ModelObject {

  protected $_id;
  protected $_created;
  protected $_modified;
  protected $_language;

  protected function __construct ($data) {
    if (!is_array ($data)) {
      throw new Exception ('ModelObject construct method must get array as a parameter.');
    }
    $this->_setMembers ($data);
  }

  public static function getLanguageDependantFields () {

  }

  /**
   *  Getter
   *  @param string $name Property name
   *  @return mixed Property value
   */
  public function __get ($name) {
    $method = 'get' . $name;
    if (method_exists ($this, $method)) {
      return $this->$method ();
    }
  }

  /**
   *  Setter
   *  @param string $name Property name
   *  @param mixed $value New value
   *  @return mixed Property value
   */
  public function __set ($name, $value) {
    $method = 'set' . $name;
    if (method_exists ($this, $method)) {
      return $this->$method ($value);
    }
  }

  /**
   * Isset
   * @param string $name Member name
   * @return boolean TRUE if member exists, FALSE if not
   */
  public function __isset ($name) {
    $memberName = $name;
    $memberName[0] = strtolower ($memberName[0]);
    $memberName = '_' . $memberName;
    return isset ($this->$memberName);
  }

  /**
   * Id getter
   * @return mixed Id
   */
  public function getId () {
    return $this->_id;
  }

  public function getCreated ($format = NULL) {
    return $this->_getDateByFormat ($this->_created, $format);
  }

  public function getModified ($format = NULL) {
    return $this->_getDateByFormat ($this->_modified, $format);
  }

  public function deleteFiles () {

  }

  /**
   * Returns a value of a language dependant member
   * @param string $memberName member name
   * @param string $lang language
   * @return mixed member value
   */
  protected function _getLanguageMember ($member, $lang) {
    if (is_null ($lang)) {
      $lang = Config::read ('lang');
    }
    if (isset ($member[$lang])) {
      return $member[$lang];
    }
    return NULL;
  }

  protected function _setMembers ($data) {
    foreach ($data as $key => $value) {
      $memberName = '_' . $key;
      $this->$memberName = $value;
    }
  }

  protected function _setMember ($memberName, $data, $dataName) {
    if (isset ($data[$dataName])) {
      $this->$memberName = $data[$dataName];
    }
    else {
      $this->$memberName = NULL;
    }
  }

  protected function _setLanguageMembers ($dataLang) {
    foreach ($dataLang as $lang => $fields) {
      foreach ($fields as $name => $value) {
        $memberName = '_' . $name;
        $this->{$memberName}[$lang] = $value;
      }
    }
  }

  protected function _getDateByFormat ($date, $format) {
    if (!$date)
      return NULL;
    if (is_null ($format)) {
      // return $date;
      if (strpos ($date, ':') === FALSE) {
        return date ("Y-m-d", strtotime ($date));
      }
      else {
        return date ("Y-m-d H:i:s", strtotime ($date));
      }
    }
    else {
      switch ($format) {
        case 'date':
          return date ("j F Y", strtotime ($date));
          break;
        default:
          return date ($format, strtotime ($date));
      }
      return $date;
    }
  }

}

?>
