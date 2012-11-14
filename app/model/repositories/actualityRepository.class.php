<?php
class ActualityRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single Actuality object.
   * @param array $params An array of parameters for query generation.
   * @return Actuality The requested Actuality object or NULL if none found.
   */
  public function getActuality ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }
    
    $query = "
      SELECT *
      FROM ". DBP ."actuality AS a
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('actualityId', $params)) {
      $query .= "
        AND a.actualityId = :actualityId
      ";
      $queryParams[':actualityId'] = array (intval ($params['actualityId']), PDO::PARAM_INT);
    }
    
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching actuality record';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }

    if (!$results || empty ($results)) {
      return NULL;
    }
    
    $actuality = Factory::getActuality ($results[0]);
      
    return $actuality;
  }

  /**
   * Method returns a count of Actuality records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of Actuality records in the database.
   */
  public function getActualityCount ($params = array ()) {
    
    $query = "
      SELECT COUNT(actualityId) AS actualityCount
      FROM ". DBP ."actuality AS a
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('languageId', 'title', 'lead', 'content', 'isPublished', 'publishDate'))) {
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
      $message = 'An error occurred while fething a count of actuality records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    return intval ($results[0]['actualityCount']);
  }
  /**
   * Method returns an array of Actuality objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of Actuality objects.
   */
  public function getActualitys ($params = array ()) {
    
    $query = "
      SELECT *
      FROM ". DBP ."actuality AS a
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('languageId', 'title', 'lead', 'content', 'isPublished', 'publishDate'))) {
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

		$actualitys = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching actuality records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    foreach ($results as &$result) {
      
    }

    return Factory::getActualitys ($results);
  }

  /**
   * Method inserts a new actuality into the database.
   * @param array $data Data for the new actuality.
   * @return integer actualityId of the newly inserted actuality.
   */
  public function addActuality ($data) {
    if (empty ($data) || !$this->_validateActualityData ($data)) {
      throw new Exception ('Actuality did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();
    
      $query = "
        INSERT INTO " . DBP . "actuality
        SET `languageId` = :languageId,
            `title` = :title,
            `slug` = :slug,
            `lead` = :lead,
            `content` = :content,
            `isPublished` = :isPublished,
            `publishDate` = :publishDate,
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':languageId' => Tools::stripTags (trim ($data['languageId'])),
        ':title' => Tools::stripTags (trim ($data['title']), 'strict'),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['title']))),
        ':lead' => Tools::stripTags (trim ($data['lead']), 'loose'),
        ':content' => Tools::stripTags (trim ($data['content']), 'loose'),
        ':isPublished' => empty ($data['isPublished']) ? NULL : array ($data['isPublished'], PDO::PARAM_INT),
        ':publishDate' => array ($data['publishDate'], PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $actualityId = $this->lastInsertId ();
      
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding actuality record';
      throw new Exception ($message . ': ' . $e->getMessage(), 3, $e);
    }
    return $this->getActuality (array ('actualityId' => $actualityId));
  }

  /**
   * Method edits an existing actuality database record.
   * @param array $data New data for the actuality.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editActuality ($actualityId, $data) {
    if (empty ($data) || !$this->_validateActualityData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      $query = "
        UPDATE " . DBP . "actuality
        SET `languageId` = :languageId,
            `title` = :title,
            `slug` = :slug,
            `lead` = :lead,
            `content` = :content,
            `isPublished` = :isPublished,
            `publishDate` = :publishDate,
            `modified` = NOW(),
            modified = NOW()
        WHERE `actualityId` = :actualityId
      ";
      $queryParams = array (
        ':languageId' => Tools::stripTags (trim ($data['languageId'])),
        ':title' => Tools::stripTags (trim ($data['title']), 'strict'),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['title']))),
        ':lead' => Tools::stripTags (trim ($data['lead']), 'loose'),
        ':content' => Tools::stripTags (trim ($data['content']), 'loose'),
        ':isPublished' => empty ($data['isPublished']) ? NULL : array ($data['isPublished'], PDO::PARAM_INT),
        ':publishDate' => array ($data['publishDate'], PDO::PARAM_INT),
        ':actualityId' => array ($actualityId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating actuality record';
      throw new Exception ($message . ': ' . $e->getMessage(), 4, $e);
    }

    return TRUE;
  }

  /**
   * Method deletes an existing actuality database record.
   * @param integer $actualityId actuality database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteActuality ($actualityId) {
    try {
      $this->startTransaction ();
      $query = "
        DELETE FROM " . DBP . "actuality
        WHERE `actualityId` = :actualityId
      ";
      $queryParams = array (
        ':actualityId' => array ($actualityId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    
      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting actuality record';
        throw new Exception ($message . ': ' . $e->getMessage(), 5, $e);
      }
  }
  

  private function _validateActualityData ($input) {
    if (!$this->checkSetData (
        $input,
        array ('languageId', 'title', 'lead', 'content', 'publishDate')
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
            'languageId' => 'Language cannot be empty.',
              'title' => 'Title cannot be empty.',
              'lead' => 'Lead cannot be empty.',
              'content' => 'Content cannot be empty.',
              'publishDate' => 'Publish Date cannot be empty.'
          ),
          'notEmptyLang' => array (
            
          )
        )
      )
    );
  }

}
?>