<?php
class CustomModuleTextRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single CustomModuleText object.
   * @param array $params An array of parameters for query generation.
   * @return CustomModuleText The requested CustomModuleText object or NULL if none found.
   */
  public function getCustomModuleText ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }

    $query = "
      SELECT *
      FROM ". DBP ."customModuleText AS c
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('customModuleTextId', $params)) {
      $query .= "
        AND c.customModuleTextId = :customModuleTextId
      ";
      $queryParams[':customModuleTextId'] = array (intval ($params['customModuleTextId']), PDO::PARAM_INT);
    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching custom module text record';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }

    if (!$results || empty ($results)) {
      return NULL;
    }

    $customModuleText = Factory::getCustomModuleText ($results[0]);

    return $customModuleText;
  }

  /**
   * Method returns a count of CustomModuleText records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of CustomModuleText records in the database.
   */
  public function getCustomModuleTextCount ($params = array ()) {

    $query = "
      SELECT COUNT(customModuleTextId) AS customModuleTextCount
      FROM ". DBP ."customModuleText AS c
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('content', 'footnote'))) {
          if (in_array ($attrName, array ())) {
            $query .= "
              AND $attrName = :$attrName
            ";
            $queryParams[":$attrName"] = isset ($params['filterParams'][$attrName]) ? '1' : '0';
          }
          elseif (isset ($params['filterParams'][$attrName])) {
            $query .= "
              AND $attrName LIKE :$attrName
            ";
            $queryParams[":$attrName"] = '%'. $params['filterParams'][$attrName] .'%';
          }
        }
      }
    }
    else {
      // Handle parameters

    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fething a count of custom module text records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    return intval ($results[0]['customModuleTextCount']);
  }
  /**
   * Method returns an array of CustomModuleText objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of CustomModuleText objects.
   */
  public function getCustomModuleTexts ($params = array ()) {

    $query = "
      SELECT *
      FROM ". DBP ."customModuleText AS c
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('content', 'footnote'))) {
          if (in_array ($attrName, array ())) {
            $query .= "
              AND $attrName = :$attrName
            ";
            $queryParams[":$attrName"] = isset ($params['filterParams'][$attrName]) ? '1' : '0';
          }
          elseif (isset ($params['filterParams'][$attrName])) {
            $query .= "
              AND $attrName LIKE :$attrName
            ";
            $queryParams[":$attrName"] = '%'. $params['filterParams'][$attrName] .'%';
          }
        }
      }
    }
    else {
      // Handle parameters

    }
    ;
		$query .= $this->_getOrderAndLimit ($params);

		$customModuleTexts = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching custom module text records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    foreach ($results as &$result) {

    }

    return Factory::getCustomModuleTexts ($results);
  }

  /**
   * Method inserts a new customModuleText into the database.
   * @param array $data Data for the new customModuleText.
   * @return integer customModuleTextId of the newly inserted customModuleText.
   */
  public function addCustomModuleText ($data) {
    if (empty ($data) || !$this->_validateCustomModuleTextData ($data)) {
      throw new Exception ('Custom Module Text did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();

      $query = "
        INSERT INTO " . DBP . "customModuleText
        SET `customModuleItemId` = :customModuleItemId,
            `content` = :content,
            `footnote` = :footnote,
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':content' => Tools::stripTags (trim ($data['content'])),
        ':footnote' => empty ($data['footnote']) ? NULL : Tools::stripTags (trim ($data['footnote'])),
        ':customModuleItemId' => array ($data['customModuleItemId'], PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $customModuleTextId = $this->lastInsertId ();

      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding custom module text record';
      throw new Exception ($message . ': ' . $e->getMessage(), 3, $e);
    }
    return $this->getCustomModuleText (array ('customModuleTextId' => $customModuleTextId));
  }

  /**
   * Method edits an existing customModuleText database record.
   * @param array $data New data for the customModuleText.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editCustomModuleText ($customModuleTextId, $data) {
    if (empty ($data) || !$this->_validateCustomModuleTextData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      $query = "
        UPDATE " . DBP . "customModuleText
        SET `customModuleItemId` = :customModuleItemId,
            `content` = :content,
            `footnote` = :footnote,
            `modified` = NOW(),
            modified = NOW()
        WHERE `customModuleTextId` = :customModuleTextId
      ";
      $queryParams = array (
        ':content' => Tools::stripTags (trim ($data['content'])),
        ':footnote' => empty ($data['footnote']) ? NULL : Tools::stripTags (trim ($data['footnote'])),
        ':customModuleTextId' => array ($customModuleTextId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating custom module text record';
      throw new Exception ($message . ': ' . $e->getMessage(), 4, $e);
    }

    return TRUE;
  }

  /**
   * Method deletes an existing customModuleText database record.
   * @param integer $customModuleTextId customModuleText database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteCustomModuleText ($customModuleTextId) {
    try {
      $this->startTransaction ();
      $query = "
        DELETE FROM " . DBP . "customModuleText
        WHERE `customModuleTextId` = :customModuleTextId
      ";
      $queryParams = array (
        ':customModuleTextId' => array ($customModuleTextId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting custom module text record';
        throw new Exception ($message . ': ' . $e->getMessage(), 5, $e);
      }
  }


  private function _validateCustomModuleTextData ($input) {
    if (!$this->checkSetData (
        $input,
        array ('content')
      )
    ) {
      return FALSE;
    }
    return $this->validateData (
      $input,
       array (
        'message' => 'Not all required fields have been filled in.',
        'rules' => array (
          'notEmpty' => array (
            'content' => 'Content cannot be empty.'
          ),
          'notEmptyLang' => array (

          )
        )
      )
    );
  }

}
?>