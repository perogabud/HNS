<?php
class CustomModuleItemSizeRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single CustomModuleItemSize object.
   * @param array $params An array of parameters for query generation.
   * @return CustomModuleItemSize The requested CustomModuleItemSize object or NULL if none found.
   */
  public function getCustomModuleItemSize ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }
    
    $query = "
      SELECT *
      FROM ". DBP ."customModuleItemSize AS c
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('customModuleItemSizeId', $params)) {
      $query .= "
        AND c.customModuleItemSizeId = :customModuleItemSizeId
      ";
      $queryParams[':customModuleItemSizeId'] = array (intval ($params['customModuleItemSizeId']), PDO::PARAM_INT);
    }
    
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching custom module item size record';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }

    if (!$results || empty ($results)) {
      return NULL;
    }
    
    $customModuleItemSize = Factory::getCustomModuleItemSize ($results[0]);
      
    return $customModuleItemSize;
  }

  /**
   * Method returns a count of CustomModuleItemSize records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of CustomModuleItemSize records in the database.
   */
  public function getCustomModuleItemSizeCount ($params = array ()) {
    
    $query = "
      SELECT COUNT(customModuleItemSizeId) AS customModuleItemSizeCount
      FROM ". DBP ."customModuleItemSize AS c
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('name', 'key'))) {
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
      $message = 'An error occurred while fething a count of custom module item size records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    return intval ($results[0]['customModuleItemSizeCount']);
  }
  /**
   * Method returns an array of CustomModuleItemSize objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of CustomModuleItemSize objects.
   */
  public function getCustomModuleItemSizes ($params = array ()) {
    
    $query = "
      SELECT *
      FROM ". DBP ."customModuleItemSize AS c
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('name', 'key'))) {
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

		$customModuleItemSizes = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching custom module item size records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    foreach ($results as &$result) {
      
    }

    return Factory::getCustomModuleItemSizes ($results);
  }

  /**
   * Method inserts a new customModuleItemSize into the database.
   * @param array $data Data for the new customModuleItemSize.
   * @return integer customModuleItemSizeId of the newly inserted customModuleItemSize.
   */
  public function addCustomModuleItemSize ($data) {
    if (empty ($data) || !$this->_validateCustomModuleItemSizeData ($data)) {
      throw new Exception ('Custom Module Item Size did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();
    
      $query = "
        INSERT INTO " . DBP . "customModuleItemSize
        SET `name` = :name,
            `key` = :key,
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':name' => Tools::stripTags (trim ($data['name'])),
        ':key' => Tools::stripTags (trim ($data['key']))
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $customModuleItemSizeId = $this->lastInsertId ();
      
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding custom module item size record';
      throw new Exception ($message . ': ' . $e->getMessage(), 3, $e);
    }
    return $this->getCustomModuleItemSize (array ('customModuleItemSizeId' => $customModuleItemSizeId));
  }

  /**
   * Method edits an existing customModuleItemSize database record.
   * @param array $data New data for the customModuleItemSize.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editCustomModuleItemSize ($customModuleItemSizeId, $data) {
    if (empty ($data) || !$this->_validateCustomModuleItemSizeData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      $query = "
        UPDATE " . DBP . "customModuleItemSize
        SET `name` = :name,
            `key` = :key,
            `modified` = NOW(),
            modified = NOW()
        WHERE `customModuleItemSizeId` = :customModuleItemSizeId
      ";
      $queryParams = array (
        ':name' => Tools::stripTags (trim ($data['name'])),
        ':key' => Tools::stripTags (trim ($data['key'])),
        ':customModuleItemSizeId' => array ($customModuleItemSizeId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating custom module item size record';
      throw new Exception ($message . ': ' . $e->getMessage(), 4, $e);
    }

    return TRUE;
  }

  /**
   * Method deletes an existing customModuleItemSize database record.
   * @param integer $customModuleItemSizeId customModuleItemSize database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteCustomModuleItemSize ($customModuleItemSizeId) {
    try {
      $this->startTransaction ();
      $query = "
        DELETE FROM " . DBP . "customModuleItemSize
        WHERE `customModuleItemSizeId` = :customModuleItemSizeId
      ";
      $queryParams = array (
        ':customModuleItemSizeId' => array ($customModuleItemSizeId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    
      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting custom module item size record';
        throw new Exception ($message . ': ' . $e->getMessage(), 5, $e);
      }
  }
  

  private function _validateCustomModuleItemSizeData ($input) {
    if (!$this->checkSetData (
        $input,
        array ('name', 'key')
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
            'name' => 'Name cannot be empty.',
              'key' => 'Key cannot be empty.'
          ),
          'notEmptyLang' => array (
            
          )
        )
      )
    );
  }

}
?>