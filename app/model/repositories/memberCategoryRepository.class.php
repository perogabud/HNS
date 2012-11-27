<?php
class MemberCategoryRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single MemberCategory object.
   * @param array $params An array of parameters for query generation.
   * @return MemberCategory The requested MemberCategory object or NULL if none found.
   */
  public function getMemberCategory ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }
    
    $query = "
      SELECT *
      FROM ". DBP ."memberCategory AS m
      JOIN ". DBP ."memberCategoryI18n AS mi18n
        ON m.memberCategoryId = mi18n.memberCategoryId
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('memberCategoryId', $params)) {
      $query .= "
        AND m.memberCategoryId = :memberCategoryId
      ";
      $queryParams[':memberCategoryId'] = array (intval ($params['memberCategoryId']), PDO::PARAM_INT);
    }
    
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching member category record';
      throw new Exception ($message . $e->getMessage());
    }

    if (!$results || empty ($results)) {
      return NULL;
    }
    
    $memberCategory = Factory::getMemberCategory ($results);
      
    return $memberCategory;
  }

  /**
   * Method returns a count of MemberCategory records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of MemberCategory records in the database.
   */
  public function getMemberCategoryCount ($params = array ()) {
    
    $query = "
      SELECT COUNT(memberCategoryId) AS memberCategoryCount
      FROM ". DBP ."vw_memberCategory AS m
      WHERE languageId = :languageId
    ";
    $queryParams = array (
      ':languageId' => Config::read ('lang')
    );
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('name'))) {
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
      $message = 'An error occurred while fething a count of member category records';
      throw new Exception ($message . $e->getMessage());
    }

    return intval ($results[0]['memberCategoryCount']);
  }
  /**
   * Method returns an array of MemberCategory objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of MemberCategory objects.
   */
  public function getMemberCategorys ($params = array ()) {
    
    $query = "
      SELECT *
      FROM ". DBP ."vw_memberCategory
      WHERE languageId = :languageId
    ";
    $queryParams = array (
      ':languageId' => Config::read ('lang')
    );
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('name'))) {
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

		$memberCategorys = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching member category records';
      throw new Exception ($message . $e->getMessage());
    }

    foreach ($results as &$result) {
      
    }

    return Factory::getMemberCategorys ($results);
  }

  /**
   * Method inserts a new memberCategory into the database.
   * @param array $data Data for the new memberCategory.
   * @return integer memberCategoryId of the newly inserted memberCategory.
   */
  public function addMemberCategory ($data) {
    if (empty ($data) || !$this->_validateMemberCategoryData ($data)) {
      throw new Exception ('Member Category did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();
    
      $query = "
        INSERT INTO " . DBP . "memberCategory
        SET 
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $memberCategoryId = $this->lastInsertId ();

      foreach (Config::read ('supportedLangs') as $lang) {
        $query = "
          INSERT INTO " . DBP . "memberCategoryI18n
          SET `name` = :name,
              `slug` = :slug,
              `created` = NOW(),
              `modified` = NOW(),
              `languageId` = :languageId,
              `memberCategoryId` = :memberCategoryId
        ";
        $queryParams = array (
          ':name' => Tools::stripTags (trim ($data['name_' . $lang])),
          ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['name_' . $lang]))),
          ':languageId' => $lang,
          ':memberCategoryId' => $memberCategoryId
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
    
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding member category record';
      throw new Exception ($message . $e->getMessage());
    }
    return $this->getMemberCategory (array ('memberCategoryId' => $memberCategoryId));
  }

  /**
   * Method edits an existing memberCategory database record.
   * @param array $data New data for the memberCategory.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editMemberCategory ($memberCategoryId, $data) {
    if (empty ($data) || !$this->_validateMemberCategoryData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      $query = "
        UPDATE " . DBP . "memberCategory
        SET 
            `modified` = NOW()
        WHERE `memberCategoryId` = :memberCategoryId
      ";
      $queryParams = array (
        ':memberCategoryId' => array ($memberCategoryId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      foreach (Config::read ('supportedLangs') as $lang) {
        $query = "
          INSERT INTO " . DBP . "memberCategoryI18n
          SET `name` = :name,
              `slug` = :slug,
              `modified` = NOW(),
              `memberCategoryId` = :memberCategoryId,
              `languageId` = :languageId,
              `created` = NOW()
          ON DUPLICATE KEY UPDATE
              `name` = :name,
              `slug` = :slug,
              `modified` = NOW()
        ";
        $queryParams = array (
          ':name' => Tools::stripTags (trim ($data['name_' . $lang])),
          ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['name_' . $lang]))),
          ':memberCategoryId' => array ($memberCategoryId, PDO::PARAM_INT),
          ':languageId' => $lang
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating member category record';
      throw new Exception ($message . $e->getMessage());
    }

    return TRUE;
  }

  /**
   * Method deletes an existing memberCategory database record.
   * @param integer $memberCategoryId memberCategory database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteMemberCategory ($memberCategoryId) {
    try {
      $this->startTransaction ();
      $query = "
        DELETE FROM " . DBP . "memberCategory
        WHERE `memberCategoryId` = :memberCategoryId
      ";
      $queryParams = array (
        ':memberCategoryId' => array ($memberCategoryId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    
      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting member category record';
        throw new Exception ($message . $e->getMessage());
      }
  }
  

  private function _validateMemberCategoryData ($input) {
    if (!$this->checkSetData (
        $input,
        array (),
        array ('name')
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
            
          ),
          'notEmptyLang' => array (
            'name' => 'Name cannot be empty.'
          )
        )
      )
    );
  }

}
?>