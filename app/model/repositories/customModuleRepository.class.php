<?php
class CustomModuleRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single CustomModule object.
   * @param array $params An array of parameters for query generation.
   * @return CustomModule The requested CustomModule object or NULL if none found.
   */
  public function getCustomModule ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }

    $query = "
      SELECT *
      FROM ". DBP ."customModule AS c
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('customModuleId', $params)) {
      $query .= "
        AND c.customModuleId = :customModuleId
      ";
      $queryParams[':customModuleId'] = array (intval ($params['customModuleId']), PDO::PARAM_INT);
    }


    if (array_key_exists ('newsItemId', $params)
      && is_numeric ($params['newsItemId'])) {
      $query = "
        SELECT DISTINCT c.*
          FROM ". DBP ."customModule AS c
          JOIN ". DBP ."customModuleHasNewsItem AS nRel
            ON c.customModuleId = nRel.customModuleId
          WHERE nRel.`newsItemId` = :newsItemId
       ";
      $queryParams[':newsItemId'] = array ($params['newsItemId'], PDO::PARAM_INT);
    }

    if (array_key_exists ('pageId', $params)
      && is_numeric ($params['pageId'])) {
      $query = "
        SELECT DISTINCT c.*
          FROM ". DBP ."customModule AS c
          JOIN ". DBP ."customModuleHasPage AS pRel
            ON c.customModuleId = pRel.customModuleId
          WHERE pRel.`pageId` = :pageId
       ";
      $queryParams[':pageId'] = array ($params['pageId'], PDO::PARAM_INT);
    }

    if (array_key_exists ('actualityId', $params)
      && is_numeric ($params['actualityId'])) {
      $query = "
        SELECT DISTINCT c.*
          FROM ". DBP ."customModule AS c
          JOIN ". DBP ."actualityHasCustomModule AS aRel
            ON c.customModuleId = aRel.customModuleId
          WHERE aRel.`actualityId` = :actualityId
       ";
      $queryParams[':actualityId'] = array ($params['actualityId'], PDO::PARAM_INT);
    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching custom module record';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }

    if (!$results || empty ($results)) {
      return NULL;
    }

    $customModule = Factory::getCustomModule ($results[0]);

    $customModuleItemRepository = new CustomModuleItemRepository ();
    $customModuleItems = $customModuleItemRepository->getCustomModuleItems (
      array (
        'customModuleId' => $customModule->getId (),
        'relationName' => 'customModuleItem'
      )
    );
    $customModule->setCustomModuleItems ($customModuleItems);

    return $customModule;
  }

  /**
   * Method returns a count of CustomModule records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of CustomModule records in the database.
   */
  public function getCustomModuleCount ($params = array ()) {

    $query = "
      SELECT COUNT(customModuleId) AS customModuleCount
      FROM ". DBP ."customModule AS c
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('class'))) {
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


    if (array_key_exists ('newsItemId', $params)
      && is_numeric ($params['newsItemId'])) {
      $query = "
        SELECT DISTINCT c.*
          FROM ". DBP ."customModule AS c
          JOIN ". DBP ."customModuleHasNewsItem AS nRel
            ON c.customModuleId = nRel.customModuleId
          WHERE nRel.`newsItemId` = :newsItemId
       ";
      $queryParams[':newsItemId'] = array ($params['newsItemId'], PDO::PARAM_INT);
    }

    if (array_key_exists ('pageId', $params)
      && is_numeric ($params['pageId'])) {
      $query = "
        SELECT DISTINCT c.*
          FROM ". DBP ."customModule AS c
          JOIN ". DBP ."customModuleHasPage AS pRel
            ON c.customModuleId = pRel.customModuleId
          WHERE pRel.`pageId` = :pageId
       ";
      $queryParams[':pageId'] = array ($params['pageId'], PDO::PARAM_INT);
    }

    if (array_key_exists ('actualityId', $params)
      && is_numeric ($params['actualityId'])) {
      $query = "
        SELECT DISTINCT c.*
          FROM ". DBP ."customModule AS c
          JOIN ". DBP ."actualityHasCustomModule AS aRel
            ON c.customModuleId = aRel.customModuleId
          WHERE aRel.`actualityId` = :actualityId
       ";
      $queryParams[':actualityId'] = array ($params['actualityId'], PDO::PARAM_INT);
    }

    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fething a count of custom module records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    return intval ($results[0]['customModuleCount']);
  }
  /**
   * Method returns an array of CustomModule objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of CustomModule objects.
   */
  public function getCustomModules ($params = array ()) {

    $query = "
      SELECT *
      FROM ". DBP ."customModule AS c
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('class'))) {
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


    if (array_key_exists ('newsItemId', $params)
      && is_numeric ($params['newsItemId'])) {
      $query = "
        SELECT DISTINCT c.*
          FROM ". DBP ."customModule AS c
          JOIN ". DBP ."customModuleHasNewsItem AS nRel
            ON c.customModuleId = nRel.customModuleId
          WHERE nRel.`newsItemId` = :newsItemId
       ";
      $queryParams[':newsItemId'] = array ($params['newsItemId'], PDO::PARAM_INT);
    }

    if (array_key_exists ('pageId', $params)
      && is_numeric ($params['pageId'])) {
      $query = "
        SELECT DISTINCT c.*
          FROM ". DBP ."customModule AS c
          JOIN ". DBP ."customModuleHasPage AS pRel
            ON c.customModuleId = pRel.customModuleId
          WHERE pRel.`pageId` = :pageId
       ";
      $queryParams[':pageId'] = array ($params['pageId'], PDO::PARAM_INT);
    }

    if (array_key_exists ('actualityId', $params)
      && is_numeric ($params['actualityId'])) {
      $query = "
        SELECT DISTINCT c.*
          FROM ". DBP ."customModule AS c
          JOIN ". DBP ."actualityHasCustomModule AS aRel
            ON c.customModuleId = aRel.customModuleId
          WHERE aRel.`actualityId` = :actualityId
       ";
      $queryParams[':actualityId'] = array ($params['actualityId'], PDO::PARAM_INT);
    }

    }
    ;
		$query .= $this->_getOrderAndLimit ($params);

		$customModules = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching custom module records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    foreach ($results as &$result) {
      $result = $this->getCustomModule (array ('customModuleId' => $result['customModuleId']));
    }

    return $results;
  }

  /**
   * Method inserts a new customModule into the database.
   * @param array $data Data for the new customModule.
   * @return integer customModuleId of the newly inserted customModule.
   */
  public function addCustomModule ($data) {
    if (!$this->_validateCustomModuleData ($data)) {
      throw new Exception ('Custom Module did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();

      $query = "
        INSERT INTO " . DBP . "customModule
        SET `class` = :class,
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':class' => empty ($data['class']) ? NULL : Tools::stripTags (trim ($data['class']))
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $customModuleId = $this->lastInsertId ();

      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding custom module record';
      throw new Exception ($message . ': ' . $e->getMessage(), 3, $e);
    }
    return $this->getCustomModule (array ('customModuleId' => $customModuleId));
  }

  /**
   * Method edits an existing customModule database record.
   * @param array $data New data for the customModule.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editCustomModule ($customModuleId, $data) {
    if (empty ($data) || !$this->_validateCustomModuleData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      $query = "
        UPDATE " . DBP . "customModule
        SET `class` = :class,
            `modified` = NOW(),
            modified = NOW()
        WHERE `customModuleId` = :customModuleId
      ";
      $queryParams = array (
        ':class' => empty ($data['class']) ? NULL : Tools::stripTags (trim ($data['class'])),
        ':customModuleId' => array ($customModuleId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating custom module record';
      throw new Exception ($message . ': ' . $e->getMessage(), 4, $e);
    }

    return TRUE;
  }

  /**
   * Method deletes an existing customModule database record.
   * @param integer $customModuleId customModule database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteCustomModule ($customModuleId) {
    try {
      $this->startTransaction ();
      $query = "
        DELETE FROM " . DBP . "customModule
        WHERE `customModuleId` = :customModuleId
      ";
      $queryParams = array (
        ':customModuleId' => array ($customModuleId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting custom module record';
        throw new Exception ($message . ': ' . $e->getMessage(), 5, $e);
      }
  }


  private function _validateCustomModuleData ($input) {
    if (!$this->checkSetData (
        $input,
        array ()
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

          )
        )
      )
    );
  }

}
?>